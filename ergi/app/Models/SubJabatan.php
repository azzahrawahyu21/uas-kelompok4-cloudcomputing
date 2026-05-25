<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubJabatan extends Model
{
    protected $table = 'subjabatan';
    protected $primaryKey = 'id_sub';
    protected $fillable = ['id_jabatan', 'parent_id', 'nama_sub'];
    public $timestamps = false;
    
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan');
    }

    public function parent()
    {
        return $this->belongsTo(SubJabatan::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(SubJabatan::class, 'parent_id');
    }
}