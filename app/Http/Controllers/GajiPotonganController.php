<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\GajiPotongan;
use Illuminate\Http\Request;

class GajiPotonganController extends Controller
{
    public function index($gaji_uuid)
    {
        $gaji = Gaji::where('uuid', $gaji_uuid)->firstOrFail();
        $items = GajiPotongan::where('gaji_id', $gaji->id)->latest()->get();
        return view('pages.gaji-potongan.index', [
            'title' => 'Data Gaji Potongan',
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
        return view('pages.gaji-potongan.create', [
            'title' => 'Tambah Gaji Potongan',
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
            'nama' => ['required'],
            'nominal' => ['required']
        ]);

        $gaji = Gaji::where('uuid', $gaji_uuid)->firstOrFail();
        $data = request()->all();
        $data['uuid'] = \Str::uuid();
        $data['gaji_id'] = $gaji->id;
        GajiPotongan::create($data);
        return redirect()->route('gaji-potongan.index', $gaji->uuid)->with('success', 'Gaji Potongan berhasil ditambahkan.');
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
        $item = GajiPotongan::where('uuid', $uuid)->firstOrFail();
        return view('pages.gaji-potongan.edit', [
            'title' => 'Edit Gaji Potongan',
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
            'nama' => ['required'],
            'nominal' => ['required']
        ]);

        $item = GajiPotongan::where('uuid', $uuid)->firstOrFail();
        $data = request()->all();
        $item->update($data);
        return redirect()->route('gaji-potongan.index', $item->gaji->uuid)->with('success', 'Gaji Potongan berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $item = GajiPotongan::where('uuid', $uuid)->firstOrFail();
        $item->delete();
        return redirect()->route('gaji-potongan.index', $item->gaji->uuid)->with('success', 'Gaji Potongan berhasil dihapus.');
    }
}
