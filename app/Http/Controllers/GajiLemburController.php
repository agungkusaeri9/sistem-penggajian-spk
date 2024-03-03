<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\GajiLembur;
use Illuminate\Http\Request;

class GajiLemburController extends Controller
{
    public function index($gaji_uuid)
    {
        $gaji = Gaji::where('uuid', $gaji_uuid)->firstOrFail();
        $items = GajiLembur::where('gaji_id', $gaji->id)->latest()->get();
        return view('pages.gaji-lembur.index', [
            'title' => 'Data Gaji Lembur',
            'items' => $items,
            'gaji' => $gaji
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($gaji_uuid)
    {
        $gaji = Gaji::where('uuid', $gaji_uuid)->firstOrFail();
        return view('pages.gaji-lembur.create', [
            'title' => 'Tambah Gaji Lembur',
            'gaji' => $gaji
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($gaji_uuid)
    {
        request()->validate([
            'tanggal' => ['required'],
            'durasi' => ['required'],
            'nominal_perjam' => ['required']
        ]);

        $gaji = Gaji::where('uuid', $gaji_uuid)->firstOrFail();
        $data = request()->all();
        $data['uuid'] = \Str::uuid();
        $data['gaji_id'] = $gaji->id;
        $data['total'] = request('durasi') * request('nominal_perjam');
        GajiLembur::create($data);
        return redirect()->route('gaji-lembur.index', $gaji->uuid)->with('success', 'Gaji Lembur berhasil ditambahkan.');
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
    public function edit($uuid)
    {
        $item = GajiLembur::where('uuid', $uuid)->firstOrFail();
        return view('pages.gaji-lembur.edit', [
            'title' => 'Edit Gaji Lembur',
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
    public function update(Request $request, $uuid)
    {
        request()->validate([
            'tanggal' => ['required'],
            'durasi' => ['required'],
            'nominal_perjam' => ['required']
        ]);

        $item = GajiLembur::where('uuid', $uuid)->firstOrFail();
        $data = request()->all();
        $data['total'] = request('durasi') * request('nominal_perjam');
        $item->update($data);
        return redirect()->route('gaji-lembur.index', $item->gaji->uuid)->with('success', 'Gaji Lembur berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $item = GajiLembur::where('uuid', $uuid)->firstOrFail();
        $item->delete();
        return redirect()->route('gaji-lembur.index', $item->gaji->uuid)->with('success', 'Gaji Lembur berhasil dihapus.');
    }
}
