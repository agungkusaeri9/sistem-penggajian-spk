<?php

namespace App\Http\Controllers;

use App\Models\GolonganGaji;
use App\Models\Jabatan;
use Illuminate\Http\Request;

class GolonganGajiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = GolonganGaji::latest()->get();
        return view('pages.golongan-gaji.index', [
            'title' => 'Data Golongan Gaji',
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
        return view('pages.golongan-gaji.create', [
            'title' => 'Tambah Golongan Gaji',
            'data_jabatan' => Jabatan::orderBy('nama', 'ASC')->get()
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
            'kode' => ['required', 'unique:golongan_gaji,kode'],
            'jabatan_id' => ['required', 'numeric'],
            'gaji_pokok' => ['required', 'numeric']
        ]);

        $data = request()->all();
        GolonganGaji::create($data);
        return redirect()->route('golongan-gaji.index')->with('success', 'Golongan Gaji berhasil ditambahkan.');
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
        $item = GolonganGaji::findOrFail($id);
        return view('pages.golongan-gaji.edit', [
            'title' => 'Edit Golongan Gaji',
            'item' => $item,
            'data_jabatan' => Jabatan::orderBy('nama', 'ASC')->get()
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
            'kode' => ['required', 'unique:golongan_gaji,kode,' . $id],
            'jabatan_id' => ['required', 'numeric'],
            'gaji_pokok' => ['required', 'numeric']
        ]);

        $data = request()->all();
        $item = GolonganGaji::findOrFail($id);
        $item->update($data);
        return redirect()->route('golongan-gaji.index')->with('success', 'Golongan Gaji berhasil disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = GolonganGaji::findOrFail($id);
        $item->delete();
        return redirect()->route('golongan-gaji.index')->with('success', 'Golongan Gaji berhasil dihapus.');
    }
}
