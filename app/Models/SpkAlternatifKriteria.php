<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpkAlternatifKriteria extends Model
{
    use HasFactory;
    protected $table = 'spk_alternatif_kriteria';
    protected $guarded = ['id'];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    public function spk_kriteria()
    {
        return $this->belongsTo(SpkKriteria::class);
    }

    public function spk_kriteria_detail()
    {
        return $this->belongsTo(SpkKriteriaDetail::class);
    }
}
