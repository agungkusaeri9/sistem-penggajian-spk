<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function gaji_index()
    {
        $data_karyawan = Karyawan::get();
        return view('pages.laporan.gaji.index', [
            'title' => 'Laporan Gaji',
            'data_karyawan' => $data_karyawan
        ]);
    }
}
