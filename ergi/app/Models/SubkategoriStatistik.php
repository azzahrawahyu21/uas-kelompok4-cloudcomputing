<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubkategoriStatistik extends Model
{
    use HasFactory;

    protected $table = 'subkategori_statistik';
    protected $primaryKey = 'id_subkategori';
    public $timestamps = false;
    protected $fillable = ['nama_subkategori', 'id_kategori'];

    public function kategori()
{
    return $this->belongsTo(KategoriStatistik::class, 'id_kategori', 'id_kategori');
}

    public function dataStatistik()
    {
        return $this->hasMany(DataStatistik::class, 'id_subkategori', 'id_subkategori');
    }
}
