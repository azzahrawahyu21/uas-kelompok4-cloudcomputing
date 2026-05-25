<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rt extends Model
{
    use HasFactory;

    protected $table = 'rt';
    protected $primaryKey = 'id_rt';
    public $timestamps = false;

    protected $fillable = [
        'no_rt',
        'nama_rt',
        'id_pengguna',
        'id_rw',
    ];

    // Relasi ke pengguna
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna', 'id_pengguna');
    }

    // Relasi ke RW
    public function rw()
    {
        return $this->belongsTo(Rw::class, 'id_rw', 'id_rw');
    }
}