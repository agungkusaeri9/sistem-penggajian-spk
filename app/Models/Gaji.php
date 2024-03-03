<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;
    protected $table = 'gaji';
    protected $guarded = ['id'];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function lembur()
    {
        return $this->hasMany(GajiLembur::class);
    }
    public function potongans()
    {
        return $this->hasMany(GajiPotongan::class, 'gaji_id', 'id');
    }

    public function scopeGetByKaryawan($q)
    {
        $q->where('karyawan_id', auth()->user()->karyawan->id);
    }

    public function status()
    {
        switch ($this->status) {
            case 0:
                return '<span class="badge badge-secondary">Menunggu</span>';
            case 1:
                return '<span class="badge badge-info">Diproses</span>';
            case 2:
                return '<span class="badge badge-primary">Diverifikasi</span>';
            case 3:
                return '<span class="badge badge-success">Dibayar</span>';
            case 4:
                return '<span class="badge badge-danger">Gagal</span>';
            case 5:
                return '<span class="badge badge-warning">Ditahan</span>';
            case 6:
                return '<span class="badge badge-dark">Dibatalkan</span>';
            case 7:
                return '<span class="badge badge-light">Dikembalikan</span>';
            default:
                return '<span class="badge badge-secondary">Tidak Diketahui</span>';
        }
    }
}
