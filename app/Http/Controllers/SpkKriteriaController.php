<?php

namespace App\Http\Controllers;

use App\Models\SpkKriteria;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SpkKriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = SpkKriteria::orderBy('nama', 'ASC')->get();
        return view('pages.spk-kriteria.index', [
            'title' => 'Data Kriteria',
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
        return view('pages.spk-kriteria.create', [
            'title' => 'Tambah Kriteria'
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
            'kode' => ['required', 'unique:spk_kriteria'],
            'nama' => ['required'],
            'jenis' => ['required'],
            'bobot' => ['required']
        ]);
        $data = request()->all();

        // hitung bobot sederhana
        $total_bobot = SpkKriteria::sum('bobot') + request('bobot');
        $data['bobot_sederhana'] = request('bobot') / $total_bobot;
        SpkKriteria::create($data);
        return redirect()->route('spk-kriteria.index')->with('success', 'SPK Kriteria berhasil ditambahkan.');
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
        $item = SpkKriteria::findOrFail($id);
        return view('pages.spk-kriteria.edit', [
            'title' => 'Edit Kriteria',
            'item' => $item
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
            'kode' => ['required', Rule::unique('spk_kriteria', 'kode')->ignore($id)],
            'nama' => ['required'],
            'jenis' => ['required'],
            'bobot' => ['required']
        ]);

        $data = request()->all();
        $data['bobot_sederhana'] = request('bobot') / 100;
        $data = request()->all();
        $item = SpkKriteria::findOrFail($id);
        $item->update($data);
        return redirect()->route('spk-kriteria.index')->with('success', 'SPK Kriteria berhasil disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = SpkKriteria::findOrFail($id);
        $item->delete();
        return redirect()->route('spk-kriteria.index')->with('success', 'SPK Kriteria berhasil dihapus.');
    }
}
