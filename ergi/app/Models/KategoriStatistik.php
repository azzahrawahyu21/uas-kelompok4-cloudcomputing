<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriStatistik extends Model
{
    use HasFactory;

    protected $table = 'kategori_statistik';
    protected $primaryKey = 'id_kategori';
    public $timestamps = false;
    protected $fillable = ['nama_kategori'];

   public function subkategoris()
{
    return $this->hasMany(SubkategoriStatistik::class, 'id_kategori', 'id_kategori');
}

}
