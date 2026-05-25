<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('admin.dashboard', compact('menus'));
        // return view('admin.menu', compact('menus'));
    }

    public function showMenu()
    {
        $menus = Menu::all();
        return view('admin.menu', compact('menus'));
    }
    public function create()
    {
        return view('admin.tambahMenu');
    }

public function store(Request $request)
{
    $request->validate([
        'nama_menu' => 'required|string|max:45',
        'url' => 'required|in:profil_desa',
    ]);

    Menu::create([
        'nama_menu' => $request->nama_menu,
        'url' => $request->url,  // HARUS cocok dengan ENUM
    ]);

    return redirect()->route('menu.index')->with('success', 'Menu berhasil ditambahkan!');
}

    public function edit($id_menu)
    {
        $menu = Menu::findOrFail($id_menu);
        return view('admin.editMenu', compact('menu'));
    }

    // Update menu
    public function update(Request $request, $id_menu)
    {
        $request->validate([
            'nama_menu' => 'required|string|max:45',
            'url' => 'required|string|in:profil_desa',
        ]);

        $menu = Menu::findOrFail($id_menu);
        $menu->update($request->only(['nama_menu', 'url']));

        return redirect()->route('menu.index')->with('success', 'Menu berhasil diperbarui!');
    }

    // Hapus menu
    public function destroy($id_menu)
    {
        $menu = Menu::findOrFail($id_menu);
        $menu->delete();

        return redirect()->route('menu.index')->with('success', 'Menu berhasil dihapus!');
    }
}