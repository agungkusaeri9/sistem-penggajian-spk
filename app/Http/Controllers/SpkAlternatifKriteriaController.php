<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\SpkAlternatifKriteria;
use App\Models\SpkKriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpkAlternatifKriteriaController extends Controller
{
    public function index()
    {
        $data_karyawan = Karyawan::orderBy('nama', 'ASC')->get();
        $data_kriteria = SpkKriteria::orderBy('nama', 'ASC')->get();
        return view('pages.alternatif-kriteria.index', [
            'title' => 'Alternatif Kriteria',
            'data_karyawan' => $data_karyawan,
            'data_kriteria' => $data_kriteria
        ]);
    }

    public function store()
    {
        DB::beginTransaction();

        try {
            $data_karyawan = request('karyawan_id');
            foreach ($data_karyawan as $karyawan) {
                $data_kriteria_karyawan = request("spk_kriteria_id_karawan_id_$karyawan");
                $data_kriteria_detail_karyawan = request("spk_kriteria_detail_id_karyawan_$karyawan");
                foreach ($data_kriteria_karyawan as $key => $kriteria_karyawan) {
                    SpkAlternatifKriteria::create([
                        'uuid' => \Str::uuid(),
                        'karyawan_id' => $karyawan,
                        'spk_kriteria_id' => $kriteria_karyawan,
                        'spk_kriteria_detail_id' => $data_kriteria_detail_karyawan[$key]
                    ]);
                }
            }
            DB::commit();
            return redirect()->back()->with('success', 'Berhasil dinormalisasi.');
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
