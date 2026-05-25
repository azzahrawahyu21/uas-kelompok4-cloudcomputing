<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submenu extends Model
{
    protected $table = 'submenu';
    protected $primaryKey = 'id_submenu';
    public $timestamps = false; 

    protected $fillable = [
        'judul',
        'isi',
        'foto',
        'id_menu',
        'id_pengguna',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'id_menu');
    }
}
