<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Bank::orderBy('nama', 'ASC')->get();
        return view('pages.bank.index', [
            'title' => 'Data Bank',
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
        return view('pages.bank.create', [
            'title' => 'Tambah Bank',
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
            'nama' => ['required'],
            'karyawan_id' => ['required'],
            'nomor_rekening' => ['required'],
            'pemilik' => ['required']
        ]);

        $data = request()->all();
        Bank::create($data);
        return redirect()->route('bank.index')->with('success', 'Bank berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Bank::findOrFail($id);
        return view('pages.bank.edit', [
            'title' => 'Edit Bank',
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
    public function update(Request $request, $id)
    {
        request()->validate([
            'nama' => ['required'],
            'karyawan_id' => ['required'],
            'nomor_rekening' => ['required'],
            'pemilik' => ['required']
        ]);

        $data = request()->all();
        $item  = Bank::findOrFail($id);
        $item->update($data);
        return redirect()->route('bank.index')->with('success', 'Bank berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Bank::findOrFail($id);
        $item->delete();
        return redirect()->route('bank.index')->with('success', 'Bank berhasil dihapus.');
    }

    public function getbykaryawanid()
    {
        request()->validate([
            'karyawan_id' => ['required']
        ]);

        $banks = Bank::where('karyawan_id', request('karyawan_id'))->get();
        if ($banks) {
            return response()->json([
                'code' => 200,
                'data' => $banks
            ]);
        } else {
            return response()->json([
                'code' => 200,
                'data' => NULL
            ]);
        }
    }
}
