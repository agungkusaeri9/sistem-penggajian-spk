<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GolonganGaji extends Model
{
    use HasFactory;
    protected $table = 'golongan_gaji';
    protected $guarded = ['id'];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }

    public function tunjangans()
    {
        return $this->hasMany(GolonganGajiTunjangan::class, 'golongan_gaji_id', 'id');
    }
}
