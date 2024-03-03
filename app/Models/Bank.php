<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;
    protected $table = 'bank';
    protected $guarded = ['id'];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    public function getFull()
    {
        $bank = $this->nama . ' - ' . $this->nomor_rekening . ' a.n ' . $this->pemilik;
        return $bank;
    }
}
