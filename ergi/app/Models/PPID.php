<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PPID extends Model
{
    protected $table = 'ppid';
    protected $primaryKey = 'id_ppid';
    public $timestamps = false;

    protected $fillable = [
        'tanggal', 'tentang', 'file', 'id_judul', 'id_pengguna'
    ];

    public function judul()
    {
        return $this->belongsTo(JudulPPID::class, 'id_judul');
    }

    public function pengguna()
    {
        return $this->belongsTo(User::class, 'id_pengguna');
    }
}
