<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\JenisPPID;
use App\Models\KategoriStatistik;

class UserMenuController extends Controller 
{
    public function showMenu($kategori, $menuSlug)
    {
        $menu = Menu::where('url', $kategori)
            ->whereRaw('LOWER(REPLACE(nama_menu, " ", "-")) = ?', [strtolower($menuSlug)])
            ->firstOrFail();

        $submenus = $menu->submenus;

        // Data untuk menu statis (statistik & PPID)
        $kategoris = KategoriStatistik::all();
        $jenisPpids = JenisPPID::all();

        // Grouping semua menu untuk navbar (dipakai di layout)
        $allMenus = Menu::with('submenus')->get()->groupBy('url');

        return view('user.menu.show', compact(
            'menu',
            'submenus',
            'kategoris',
            'jenisPpids',
            'allMenus'
        ));
    }

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
