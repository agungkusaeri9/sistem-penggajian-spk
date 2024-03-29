<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpkKriteriaDetail extends Model
{
    use HasFactory;
    protected $table = 'spk_kriteria_detail';
    protected $guarded = ['id'];

    public function kriteria()
    {
        return $this->belongsTo(SpkKriteria::class, 'spk_kriteria_id', 'id');
    }
}
