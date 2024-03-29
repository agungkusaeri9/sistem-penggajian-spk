<?php

namespace App\Http\Controllers;

use App\Models\SpkKriteria;
use App\Models\SpkKriteriaDetail;
use Illuminate\Http\Request;

class SpkKriteriaDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_kriteria = SpkKriteria::orderBy('nama', 'ASC')->get();
        if (request('spk_kriteria_id'))
            $items = SpkKriteriaDetail::where('spk_kriteria_id', request('spk_kriteria_id'))->orderBy('nama', 'ASC')->get();
        else
            $items = SpkKriteriaDetail::orderBy('nama', 'ASC')->get();
        return view('pages.spk-kriteria-detail.index', [
            'title' => 'Data Kriteria',
            'items' => $items,
            'data_kriteria' => $data_kriteria
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data_kriteria = SpkKriteria::orderBy('nama', 'ASC')->get();
        return view('pages.spk-kriteria-detail.create', [
            'title' => 'Tambah Kriteria',
            'data_kriteria' => $data_kriteria
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
            'spk_kriteria_id' => ['required'],
            'nama' => ['required'],
            'nilai' => ['required'],
        ]);

        $data = request()->all();
        SpkKriteriaDetail::create($data);
        return redirect()->route('spk-kriteria-detail.index')->with('success', 'SPK Detail Kriteria berhasil ditambahkan.');
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
        $item = SpkKriteriaDetail::findOrFail($id);
        return view('pages.spk-kriteria-detail.edit', [
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
            'nama' => ['required'],
            'nilai' => ['required'],
        ]);

        $data = request()->all();
        $item = SpkKriteriaDetail::findOrFail($id);
        $item->update($data);
        return redirect()->route('spk-kriteria-detail.index')->with('success', 'SPK Detail Kriteria berhasil disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = SpkKriteriaDetail::findOrFail($id);
        $item->delete();
        return redirect()->route('spk-kriteria-detail.index')->with('success', 'SPK Detail Kriteria berhasil dihapus.');
    }
}
