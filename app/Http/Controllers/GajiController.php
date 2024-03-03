<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class GajiController extends Controller
{
    public function index()
    {
        $items = Gaji::latest()->get();
        return view('pages.gaji.index', [
            'title' => 'Data Gaji',
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.gaji.create', [
            'title' => 'Tambah Gaji',
            'data_karyawan' => Karyawan::orderBy('nama', 'ASC')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'karyawan_id' => ['required', 'numeric'],
            'bulan' => ['required', 'numeric'],
            'tahun' => ['required', 'numeric'],
            'tipe_pembayaran' => ['required'],
            'status' => ['required', 'numeric'],
            'bukti' => ['image', 'mimes:jpg,png,jpeg'],
            'bank_id' => [Rule::when(request('tipe_pembayaran') === 'transfer', ['required'])]
        ]);

        DB::beginTransaction();
        try {
            // cek gaji karyawan
            $cekGaji = Gaji::where([
                'karyawan_id' => request('karyawan_id'),
                'bulan' => request('bulan'),
                'tahun' => request('tahun')
            ]);
            if ($cekGaji->count() > 0) {
                return redirect()->back()->with('error', 'Gaji karyawan tersebut sudah diberikan.');
            }
            $karyawan = Karyawan::findOrFail(request('karyawan_id'));
            $tunjangan = $karyawan->golongan_gaji->tunjangans->sum('nominal');
            $gaji_pokok = $karyawan->golongan_gaji->gaji_pokok;
            $data = request()->all();
            if (request()->file('bukti')) {
                $data['bukti'] = request()->file('bukti')->store('penggajian', 'public');
            }
            $data['uuid'] = \Str::uuid();
            $data['golongan_gaji_id'] = $karyawan->golongan_gaji_id;
            $data['gaji_pokok'] = $gaji_pokok;
            $data['tunjangan'] = $tunjangan;
            $data['gaji_bersih'] = $gaji_pokok + $tunjangan;
            Gaji::create($data);
            DB::commit();
            return redirect()->route('gaji.index')->with('success', 'Gaji berhasil ditambahkan.');
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jabatan_id = request('jabatan_id');
        $golongan_gaji = Gaji::where('jabatan_id', $jabatan_id)->with('tunjangans.tunjangan')->find($id);
        if ($golongan_gaji) {
            return response()->json([
                'code' => 200,
                'data' => $golongan_gaji
            ]);
        } else {
            return response()->json([
                'code' => 400,
                'data' => NULL
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $item = Gaji::where('uuid', $uuid)->firstOrFail();
        return view('pages.gaji.edit', [
            'title' => 'Edit Gaji',
            'item' => $item,
            'data_karyawan' => Karyawan::orderBy('nama', 'ASC')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        request()->validate([
            'bulan' => ['required', 'numeric'],
            'tahun' => ['required', 'numeric'],
            'tipe_pembayaran' => ['required'],
            'status' => ['required', 'numeric'],
            'bukti' => ['image', 'mimes:jpg,png,jpeg'],
            'bank_id' => [Rule::when(request('tipe_pembayaran') === 'transfer', ['required'])]
        ]);

        DB::beginTransaction();
        try {
            // cek gaji karyawan
            $cekGaji = Gaji::where([
                'karyawan_id' => request('karyawan_id'),
                'bulan' => request('bulan'),
                'tahun' => request('tahun')
            ])->whereNot('uuid', $uuid);
            if ($cekGaji->count() > 0) {
                return redirect()->back()->with('error', 'Gaji karyawan tersebut sudah diberikan.');
            }
            $item = Gaji::where('uuid', $uuid)->firstOrFail();
            $data = request()->all();
            if (request()->file('bukti')) {
                if ($item->bukti) {
                    Storage::disk('public')->delete($item->bukti);
                }
                $data['bukti'] = request()->file('bukti')->store('penggajian', 'public');
            }
            $item->update($data);
            DB::commit();
            return redirect()->route('gaji.index')->with('success', 'Gaji berhasil diupdate.');
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $item = Gaji::where('uuid', $uuid)->firstOrFail();
        $item->delete();
        return redirect()->route('gaji.index')->with('success', 'Gaji berhasil dihapus.');
    }

    public function update_lembur($uuid)
    {
        $item = Gaji::where('uuid', $uuid)->firstOrFail();
        $total = $item->lembur->sum('total');
        $gaji_bersih = $item->gaji_pokok + $item->tunjangan + $total - ($item->potongan);
        $item->update([
            'gaji_lembur' => $total,
            'gaji_bersih' => $gaji_bersih
        ]);

        return redirect()->route('gaji.index')->with('success', 'Gaji berhasil diupdate.');
    }

    public function update_potongan($uuid)
    {
        $item = Gaji::with('potongans')->where('uuid', $uuid)->firstOrFail();
        $total = $item->potongans->sum('nominal');
        $gaji_bersih = $item->gaji_pokok + $item->tunjangan + $item->lembur->sum('total') - ($total);
        $item->update([
            'potongan' => $total,
            'gaji_bersih' => $gaji_bersih
        ]);

        return redirect()->route('gaji.index')->with('success', 'Gaji berhasil diupdate.');
    }
}
