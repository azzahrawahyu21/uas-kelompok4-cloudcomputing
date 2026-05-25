<?php

namespace App\Http\Controllers;

use App\Models\Submenu;
use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Str;
use App\Models\KategoriStatistik;
use App\Models\JenisPPID;

class UserSubmenuController extends Controller
{
    public function showSubmenu($kategori, $menuSlug, $slug)
    {
        $menu = Menu::where('url', $kategori)
            ->whereRaw('LOWER(REPLACE(nama_menu, " ", "-")) = ?', [strtolower($menuSlug)])
            ->firstOrFail();

        $submenu = Submenu::where('id_menu', $menu->id_menu)
            ->whereRaw('LOWER(REPLACE(judul, " ", "-")) = ?', [strtolower($slug)])
            ->firstOrFail();

        $menus = Menu::with('submenus')->get()->groupBy('url');
        $kategoris = KategoriStatistik::all();
        $jenisPpids = JenisPPID::all();

        return view('user.submenu.show', compact('menu', 'submenu', 'menus', 'kategoris', 'jenisPpids'));
    }
}
