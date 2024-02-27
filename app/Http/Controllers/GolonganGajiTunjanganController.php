<?php

namespace App\Http\Controllers;

use App\Models\GolonganGaji;
use App\Models\GolonganGajiTunjangan;
use App\Models\Tunjangan;
use Illuminate\Http\Request;

class GolonganGajiTunjanganController extends Controller
{
    public function index($golongan_gaji_id)
    {
        $item = GolonganGaji::findOrFail($golongan_gaji_id);
        $items = GolonganGajiTunjangan::where('golongan_gaji_id', $golongan_gaji_id)->get();
        return view('pages.golongan-gaji-tunjangan.index', [
            'title' => 'Golongan Gaji Tunjangan',
            'items' => $items,
            'item' => $item
        ]);
    }

    public function create($golongan_gaji_id)
    {
        $data_tunjangan = Tunjangan::orderBy('nama', 'ASC')->get();
        $item = GolonganGaji::findOrFail($golongan_gaji_id);
        return view('pages.golongan-gaji-tunjangan.create', [
            'title' => 'Tambah Tunjangan Golongan Gaji',
            'data_tunjangan' => $data_tunjangan,
            'item' => $item
        ]);
    }

    public function store($golongan_gaji_id)
    {
        request()->validate([
            'tunjangan_id' => ['required'],
            'nominal' => ['required']
        ]);


        // cek golongan dan tunjangan
        $cekKetersediaan = GolonganGajiTunjangan::where([
            'tunjangan_id' => request('tunjangan_id'),
            'golongan_gaji_id' => $golongan_gaji_id
        ])->count();

        if ($cekKetersediaan > 0) {
            return redirect()->route('golongan-gaji-tunjangan.index', $golongan_gaji_id)->with('error', 'Tunjangan dari gaji tersebut sudah ada.');
        }

        GolonganGajiTunjangan::create([
            'golongan_gaji_id' => $golongan_gaji_id,
            'tunjangan_id' => request('tunjangan_id'),
            'nominal' => request('nominal')
        ]);

        return redirect()->route('golongan-gaji-tunjangan.index', $golongan_gaji_id)->with('success', 'Tunjangan gaji berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $item = GolonganGajiTunjangan::findOrFail($id);
        return view('pages.golongan-gaji-tunjangan.edit', [
            'title' => 'Edit Tunjangan Golongan Gaji',
            'item' => $item
        ]);
    }

    public function update($id)
    {
        request()->validate([
            'nominal' => ['required']
        ]);

        $item = GolonganGajiTunjangan::findOrFail($id);

        $item->update([
            'nominal' => request('nominal')
        ]);

        return redirect()->route('golongan-gaji-tunjangan.index', $item->golongan_gaji_id)->with('success', 'Tunjangan gaji berhasil diupdate.');
    }

    public function destroy($id)
    {
        $item = GolonganGajiTunjangan::findOrFail($id);
        $golongan_gaji_id = $item->golongan_gaji_id;
        $item->delete();
        return redirect()->route('golongan-gaji-tunjangan.index', $golongan_gaji_id)->with('success', 'Tunjangan gaji berhasil dihapus.');
    }
}
