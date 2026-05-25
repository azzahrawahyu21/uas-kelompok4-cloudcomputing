<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Submenu;
use Illuminate\Support\Facades\Auth;

class SubmenuController extends Controller
{
    public function index($id_menu)
    {
        $menu = Menu::findOrFail($id_menu);
        $submenus = Submenu::where('id_menu', $id_menu)->get();
        // return view('admin.submenu', compact('menu', 'submenus'));
        return view('admin.kelolaSubmenu', compact('menu', 'submenus'));
    }

public function create($id_menu)
{
    $menu = Menu::findOrFail($id_menu);
    $submenus = Submenu::where('id_menu', $id_menu)->get(); // 🔹 tambahkan ini
    return view('admin.submenu', compact('menu', 'submenus'));
}

    public function store(Request $request, $id_menu)
    {
        $request->validate([
            'judul' => 'required|string|max:45',
            'isi'   => 'nullable|string',
            'foto'  => 'nullable|string|max:255',
        ]);

        // Ambil pengguna yang sedang login
        $pengguna = Auth::user();

        if (!$pengguna) {
            return redirect()->back()->withErrors(['auth' => 'Anda harus login terlebih dahulu.']);
        }

        $fotoUrl = $request->input('foto') ?: null;

        Submenu::create([
            'judul'       => $request->judul,
            'isi'         => $request->isi,
            'foto'        => $fotoUrl, // ini nanti hasil URL dari ElFinder
            'id_menu'     => $id_menu,
            'id_pengguna' => $pengguna->id_pengguna,
        ]);

        return redirect()
            ->route('submenu.index', $id_menu)
            ->with('success', 'Submenu berhasil ditambahkan!');
    }

    public function kelola($id_menu)
    {
        $menu = Menu::findOrFail($id_menu);
        $submenus = Submenu::where('id_menu', $id_menu)->get();
        return view('admin.kelolaSubmenu', compact('menu', 'submenus'));
    }

    public function edit($id_menu, $id_submenu)
    {
        $menu = Menu::findOrFail($id_menu);
        $submenu = Submenu::findOrFail($id_submenu);
        return view('admin.editSubmenu', compact('menu', 'submenu'));
    }

    public function update(Request $request, $id_menu, $id_submenu)
    {
        $request->validate([
            'judul' => 'required|string|max:45',
            'isi'   => 'nullable|string',
            'foto'  => 'nullable|string|max:255',
        ]);

        $submenu = Submenu::findOrFail($id_submenu);
        $submenu->update($request->only(['judul', 'isi', 'foto']));

        return redirect()->route('submenu.kelola', $id_menu)
                        ->with('success', 'Submenu berhasil diperbarui!');
    }

    public function destroy($id_menu, $id_submenu)
    {
        $submenu = Submenu::findOrFail($id_submenu);
        $submenu->delete();

        return redirect()->route('submenu.kelola', $id_menu)
                        ->with('success', 'Submenu berhasil dihapus!');
    }
}
