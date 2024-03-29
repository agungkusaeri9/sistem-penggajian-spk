<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpkKriteria extends Model
{
    use HasFactory;
    protected $table = 'spk_kriteria';
    protected $guarded = ['id'];

    public function details()
    {
        return $this->hasMany(SpkKriteriaDetail::class, 'spk_kriteria_id', 'id');
    }

    public static function countBobot()
    {
        return self::sum('bobot');
    }

    public function bobotSederhana()
    {
        $hasil = number_format($this->bobot / $this->countBobot(), 3);
        return $hasil;
    }

    public static function totalIsi()
    {
        self::sum()
    }

    public function pembagi()
    {
        $arr = $this->alternatif_kriteria();
    }

    public function alternatif_kriteria()
    {
        return $this->hasMany(SpkAlternatifKriteria::class,'spk_alternatif_kriteria_id','id');
    }
}
