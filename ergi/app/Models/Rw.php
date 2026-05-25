<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rw extends Model
{
    use HasFactory;

    protected $table = 'rw';
    protected $primaryKey = 'id_rw';
    public $timestamps = false;

    protected $fillable = [
        'no_rw',
        'nama_rw',
        'id_pengguna',
    ];

    // Relasi ke pengguna
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna', 'id_pengguna');
    }

    // Relasi ke RT
    public function rt()
    {
        return $this->hasMany(Rt::class, 'id_rw', 'id_rw');
    }
}
