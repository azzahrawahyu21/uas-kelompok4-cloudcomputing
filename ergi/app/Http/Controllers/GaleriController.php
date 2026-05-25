<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Galeri;

class GaleriController extends Controller
{
    public function index()
    {
        $galeris = Galeri::orderBy('tanggal', 'desc')->get();
        return view('admin.galeri.galeri', compact('galeris'));
    }

    public function create()
    {
        return view('admin.galeri.tambahgaleri');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'   => 'required|string|max:100',
            'foto'     => 'nullable|string|max:255',   // path file dari ElFinder
            'tanggal' => 'required|date',
        ]);

        Galeri::create([
            'judul'   => $request->judul,
            'foto'     => $request->foto,  // hanya simpan nama file / path
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('galeri.index')->with('success', 'galeri berhasil ditambahkan!');
    }

    public function edit($id_galeri)
    {
        $galeri = Galeri::findOrFail($id_galeri);
        return view('admin.galeri.editgaleri', compact('galeri'));
    }

    public function update(Request $request, $id_galeri)
    {
        $request->validate([
            'judul'   => 'required|string|max:100',
            'foto'     => 'nullable|string|max:255',
            'tanggal' => 'required|date',
        ]);

        $galeri = Galeri::findOrFail($id_galeri);

        $namaFoto = $request->foto ?: $galeri->foto;

        $galeri->update([
            'judul'   => $request->judul,
            'foto'     => $namaFoto,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('galeri.index')->with('success', 'galeri berhasil diperbarui!');
    }

    public function destroy($id_galeri)
    {
        $galeri = Galeri::findOrFail($id_galeri);
        $galeri->delete();

        return redirect()->route('galeri.index')->with('success', 'galeri berhasil dihapus!');
    }

    public function detail($id_galeri)
    {
        $galeri = Galeri::findOrFail($id_galeri);
        return view('admin.galeri.detail', compact('galeri'));
    }

    public function show($id_galeri)
    {
        $galeri = Galeri::findOrFail($id_galeri);
        return view('user.galeri.show', compact('galeri'));
    }
    public function list()
    {
        $galeris = Galeri::orderBy('tanggal', 'desc')->get();
        return view('user.media.galeriIndex', compact('galeris'));
    }
}