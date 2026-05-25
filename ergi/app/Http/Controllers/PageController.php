<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submenu;

class PageController extends Controller
{
    public function index()
    {
        $submenus = Submenu::whereHas('menu', function ($q) {
            $q->where('nama_menu', 'Profil Desa');
        })->get();

        return view('profil.profil_desa', compact('submenus'));
    }

    public function create()
    {
        return view('profil.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:45',
            'isi' => 'required',
            'foto' => 'nullable|string|max:30',
        ]);

        Submenu::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'foto' => $request->foto, // nanti ini bisa diambil dari ElFinder URL
            'id_menu' => 1, // misalnya id_menu untuk 'Profil Desa'
            'id_pengguna' => auth()->id(),
        ]);

        return redirect()->route('profil_desa')->with('success', 'Submenu berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $submenu = Submenu::findOrFail($id);
        return view('profil.edit', compact('submenu'));
    }

    public function update(Request $request, $id)
    {
        $submenu = Submenu::findOrFail($id);

        $submenu->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'foto' => $request->foto,
        ]);

        return redirect()->route('profil_desa')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Submenu::destroy($id);
        return redirect()->route('profil_desa')->with('success', 'Submenu berhasil dihapus.');
    }
}
