<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GolonganGajiTunjangan extends Model
{
    use HasFactory;
    protected $table = 'golongan_gaji_tunjangan';
    protected $guarded = ['id'];

    public function golongan_gaji()
    {
        return $this->belongsTo(GolonganGaji::class, 'golongan_gaji_id', 'id');
    }

    public function tunjangan()
    {
        return $this->belongsTo(Tunjangan::class, 'tunjangan_id', 'id');
    }
}
