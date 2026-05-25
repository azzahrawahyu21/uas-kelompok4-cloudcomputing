<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $table = 'jabatan';
    protected $primaryKey = 'id_jabatan';
    protected $fillable = ['nama_jabatan', 'tipe'];

    public function subJabatan()
    {
        return $this->hasMany(SubJabatan::class, 'id_jabatan');
    }

    public function pejabat()
    {
        return $this->hasMany(Pejabat::class, 'id_jabatan', 'id_jabatan');
    }

    public $timestamps = false;
}
