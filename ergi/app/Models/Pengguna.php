<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pengguna extends Authenticatable
{
    use HasFactory;

    protected $table = 'pengguna';
    protected $primaryKey = 'id_pengguna';
    public $timestamps = false;
    protected $fillable = [
        'nama_pengguna',
        'email',
        'kata_sandi',
        'peran',
        'status',
        'reset_code',
        'reset_code_expires_at',
    ];

    protected $hidden = [
        'kata_sandi',
        'reset_code',
    ];

    const STATUS_AKTIF = 'Aktif';
    const STATUS_TIDAK_AKTIF = 'Tidak Aktif';

    // Supaya Eloquent menggunakan kata_sandi untuk login
    public function getAuthPassword()
    {
        return $this->kata_sandi;
    }
}