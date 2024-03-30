<?php

use App\Models\SpkAlternatifKriteria;
use App\Models\SpkKriteria;
use Carbon\Carbon;

function getMonthName($monthNumber)
{
    switch ($monthNumber) {
        case 1:
            return "Januari";
        case 2:
            return "Februari";
        case 3:
            return "Maret";
        case 4:
            return "April";
        case 5:
            return "Mei";
        case 6:
            return "Juni";
        case 7:
            return "Juli";
        case 8:
            return "Agustus";
        case 9:
            return "September";
        case 10:
            return "Oktober";
        case 11:
            return "November";
        case 12:
            return "Desember";
        default:
            return false; // Bulan tidak valid
    }
}


function formatRupiah($angka)
{
    if (intval($angka)) {
        return "Rp " . number_format($angka, 0, ',', '.');
    } else {
        return 'Rp 0';
    }
}


function formatTanggal($date, $format = 'd-m-Y')
{
    return Carbon::parse($date)->format($format);
}

function is_admin()
{
    if (auth()->user()->role === 'admin') {
        return true;
    } else {
        return false;
    }
}

function is_karyawan()
{
    if (auth()->user()->role === 'karyawan') {
        return true;
    } else {
        return false;
    }
}

function is_pimpinan()
{
    if (auth()->user()->role === 'pimpinan') {
        return true;
    } else {
        return false;
    }
}

function getNilai($karyawan_id, $kriteria_id)
{
    $item = SpkAlternatifKriteria::where('karyawan_id', $karyawan_id)->where('spk_kriteria_id', $kriteria_id)->first();
    return $item->spk_kriteria_detail->nilai;
}

function getNormalisasi($karyawan_id, $kriteria_id)
{
    $jenis = getJenis($kriteria_id);
    $nilai = getNilai($karyawan_id, $kriteria_id);
    $pembagi = getPembagi($kriteria_id);
    if ($jenis === 'cost') {
        $hasil = $pembagi / $nilai;
    } else {
        $hasil = $nilai / $pembagi;
    }
    return $hasil;
}

function getJenis($kriteria_id)
{
    $kriteria = SpkKriteria::findOrFail($kriteria_id);
    return $kriteria->jenis;
}

function getPembagi($kriteria_id)
{
    $kriteria = SpkKriteria::findOrFail($kriteria_id);
    $arr_nilai = SpkAlternatifKriteria::where('spk_kriteria_id', $kriteria_id)->get()->pluck('spk_kriteria_detail.nilai');
    if ($kriteria->jenis === 'cost') {
        //cari yang terkecil
        $data = $arr_nilai->min();
    } else {
        // cari yang terbesar
        $data = $arr_nilai->max();
    }

    return $data;
}

function getTotalNilai($karyawan_id)
{
    $arr_jumlah = [];
    $data_kriteria = SpkKriteria::get();
    $jumlah = 0;
    foreach ($data_kriteria as $kriteria) {
        $jumlah =  $jumlah + (getNormalisasi($karyawan_id, $kriteria->id) * $kriteria->bobotSederhana());
    }
    array_push($arr_jumlah, $jumlah);
    return $jumlah;
}

function getRankingNumber()
{
    $data_kriteria = SpkKriteria::get();
    $data_normalisasi = SpkAlternatifKriteria::with(['karyawan', 'spk_kriteria', 'spk_kriteria_detail'])
        ->select('karyawan_id')
        ->groupBy('karyawan_id')
        ->get();
    $jumlah = 0;
    foreach ($data_normalisasi as $normalisasi) {
        foreach ($data_kriteria as $kriteria) {
            $jumlah =  $jumlah + (getNormalisasi($normalisasi->karyawan_id, $kriteria->id) * $kriteria->bobotSederhana());
        }
    }
    return $jumlah;
}
