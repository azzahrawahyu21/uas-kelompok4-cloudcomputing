<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JudulPPID extends Model
{
    protected $table = 'judul_ppid';
    protected $primaryKey = 'id_judul';
    protected $fillable = ['judul', 'id_jenis_ppid'];

    public $timestamps = false;

    public function jenis()
    {
        return $this->belongsTo(JenisPPID::class, 'id_jenis_ppid');
    }

    public function dokumens()
    {
        return $this->hasMany(PPID::class, 'id_judul');
    }
}
