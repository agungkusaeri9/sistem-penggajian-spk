<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $table = 'karyawan';
    protected $guarded = ['id'];

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status_karyawan()
    {
        // 1 aktif
        // 2 Cuti
        // 3 Resign
        // 4 Kontrak
        // 5 Tidak Aktif
        switch ($this->status_karyawan) {
            case 1:
                return '<span class="badge badge-success">Aktif</span>';
                break;
            case 2:
                return '<span class="badge badge-info">Cuti</span>';
                break;
            case 3:
                return '<span class="badge badge-warning">Resgin</span>';
                break;
            case 4:
                return '<span class="badge badge-secondary">Kontrak</span>';
                break;
            case 5:
                return '<span class="badge badge-danger">Tidak Aktif</span>';
                break;
            default:
                return 'Tidak Valid!';
                break;
        }
    }
}
