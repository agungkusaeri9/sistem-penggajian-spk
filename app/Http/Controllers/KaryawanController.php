<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\GolonganGaji;
use App\Models\Jabatan;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Karyawan::orderBy('nama', 'ASC')->get();
        return view('pages.karyawan.index', [
            'title' => 'Data Karyawan',
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
        return view('pages.karyawan.create', [
            'title' => 'Tambah Karyawan',
            'data_jabatan' => Jabatan::orderBy('nama', 'ASC')->get(),
            'data_divisi' => Divisi::orderBy('nama', 'ASC')->get(),
            'data_golongan_gaji' => GolonganGaji::get()
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
            'nik' => ['required', 'unique:karyawan,nik'],
            'jenis_kelamin' => ['required'],
            'tempat_lahir' => ['required'],
            'tanggal_lahir' => ['required'],
            'alamat' => ['required'],
            'jabatan_id' => ['required'],
            'divisi_id' => ['required'],
            'golongan_gaji_id' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6', 'confirmed'],
            'password_confirmation' => ['required'],
            'status_karyawan' => ['required'],
            'nomor_telepon' => ['required'],
            'nomor_ktp' => ['required'],
            'tanggal_bergabung' => ['required']
        ]);

        $data_karyawan = request()->except(['email', 'password', 'password_confirmation']);
        $data_user = request()->only(['email']);
        $data_user['name'] = request('nama');
        $data_user['username'] = str_replace(" ", "", request('nama')) . rand(100, 999);
        $data_user['role'] = 'karyawan';
        $data_user['password'] = bcrypt(request('password'));
        // create user
        $user = User::create($data_user);
        $user->karyawan()->create($data_karyawan);
        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil ditambahkan.');
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
        $item = Karyawan::findOrFail($id);
        return view('pages.karyawan.edit', [
            'title' => 'Edit Karyawan',
            'item' => $item,
            'data_jabatan' => Jabatan::orderBy('nama', 'ASC')->get(),
            'data_divisi' => Divisi::orderBy('nama', 'ASC')->get(),
            'data_golongan_gaji' => GolonganGaji::get()
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
        $item = Karyawan::findOrFail($id);
        request()->validate([
            'nama' => ['required'],
            'nik' => ['required', 'unique:karyawan,nik,' . $id],
            'jenis_kelamin' => ['required'],
            'tempat_lahir' => ['required'],
            'tanggal_lahir' => ['required'],
            'alamat' => ['required'],
            'jabatan_id' => ['required'],
            'divisi_id' => ['required'],
            'golongan_gaji_id' => ['required'],
            'email' => ['required', 'email', 'unique:users,email,' . $item->user->id],
            'password' => [Rule::when(request('password'), ['required', 'min:6', 'confirmed'])],
            'password_confirmation' => [Rule::when(request('password'), ['required'])],
            'status_karyawan' => ['required'],
            'nomor_telepon' => ['required'],
            'nomor_ktp' => ['required'],
            'tanggal_bergabung' => ['required']
        ]);

        $data_karyawan = request()->except(['email', 'password', 'password_confirmation']);
        $data_user = request()->only(['email']);
        $data_user['name'] = request('nama');
        if (request('password')) {
            $data_user['password'] = bcrypt(request('password'));
        }
        // create user
        $item->update($data_karyawan);
        $item->user()->update($data_user);
        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Karyawan::findOrFail($id);
        $item->delete();
        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil dihapus.');
    }
}
