<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pejabat extends Model
{
    protected $table = 'pejabat';
    protected $primaryKey = 'id_pejabat';

    protected $fillable = [
        'id_jabatan',
        'id_sub',
        'nama_pejabat',
        'deskripsi',
        'foto',
    ];

    public $timestamps = false;

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan', 'id_jabatan');
    }

    public function subjabatan()
    {
        return $this->belongsTo(SubJabatan::class, 'id_sub');
    }
}
