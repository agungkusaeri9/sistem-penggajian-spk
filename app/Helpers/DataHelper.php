<?php

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
