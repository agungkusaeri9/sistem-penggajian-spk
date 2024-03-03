<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GajiPotongan extends Model
{
    use HasFactory;
    protected $table = 'gaji_potongan';
    protected $guarded = ['id'];

    public function gaji()
    {
        return $this->belongsTo(Gaji::class);
    }
}
