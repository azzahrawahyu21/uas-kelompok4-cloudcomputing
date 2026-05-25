<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::orderBy('tanggal', 'desc')->get();
        return view('admin.berita.berita', compact('beritas'));
    }

    public function create()
    {
        return view('admin.berita.tambahBerita');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'   => 'required|string|max:100',
            'foto'     => 'nullable|string|max:255',   // path file dari ElFinder
            'isi'     => 'required|string',
            'tanggal' => 'required|date',
        ]);

        Berita::create([
            'judul'   => $request->judul,
            'foto'     => $request->foto,  // hanya simpan nama file / path
            'isi'     => $request->isi,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan!');
    }

    public function edit($id_berita)
    {
        $berita = Berita::findOrFail($id_berita);
        return view('admin.berita.editBerita', compact('berita'));
    }

    public function update(Request $request, $id_berita)
    {
        $request->validate([
            'judul'   => 'required|string|max:100',
            'foto'     => 'nullable|string|max:255',
            'isi'     => 'required|string',
            'tanggal' => 'required|date',
        ]);

        $berita = Berita::findOrFail($id_berita);

        $namaFoto = $request->foto ?: $berita->foto;

        $berita->update([
            'judul'   => $request->judul,
            'foto'     => $namaFoto,
            'isi'     => $request->isi,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy($id_berita)
    {
        $berita = Berita::findOrFail($id_berita);
        $berita->delete();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus!');
    }

    public function detail($id_berita)
    {
        $berita = Berita::findOrFail($id_berita);
        return view('admin.berita.detail', compact('berita'));
    }

    // user
    public function show($id_berita)
    {
        $berita = Berita::findOrFail($id_berita);
        $rekomendasi = Berita::where('id_berita', '!=', $id_berita)
                            ->orderBy('tanggal', 'desc')
                            ->take(5)
                            ->get();

        return view('user.media.beritaShow', compact('berita', 'rekomendasi'));
    }
    public function list()
    {
        $beritas = Berita::orderBy('tanggal', 'desc')->get();
        return view('user.media.beritaIndex', compact('beritas'));
    }
}
