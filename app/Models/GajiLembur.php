<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GajiLembur extends Model
{
    use HasFactory;
    protected $table = 'gaji_lembur';
    protected $guarded = ['id'];

    public function gaji()
    {
        return $this->belongsTo(Gaji::class);
    }
}
