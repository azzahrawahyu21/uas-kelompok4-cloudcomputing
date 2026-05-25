<?php

namespace App\Http\Controllers;

use App\Models\KategoriStatistik;

class UserStatistikController extends Controller
{
    public function index()
    {
        $kategoris = KategoriStatistik::all();
        return view('user.menu.statistik.index', compact('kategoris'));
    }

    public function showKategori($id_kategori)
    {
        $kategori = KategoriStatistik::with(['subkategoris.dataStatistik'])->findOrFail($id_kategori);
        return view('user.menu.statistik.detail', compact('kategori'));
    }
}
