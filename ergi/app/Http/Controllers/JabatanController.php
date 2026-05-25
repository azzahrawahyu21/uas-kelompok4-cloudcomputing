<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jabatan;

class JabatanController extends Controller
{
    public function index()
    {
        $jabatans = Jabatan::all();
        return view('admin.jabatan.jabatan', compact('jabatans'));
    }

    public function showJabatan()
    {
        $jabatans = Jabatan::all();
        return view('admin.jabatan.jabatan', compact('jabatans'));
    }

    public function create()
    {
        return view('admin.jabatan.tambahJabatan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:50',
            'tipe' => 'required|in:tunggal,multi',
        ]);

        Jabatan::create([
            'nama_jabatan' => $request->nama_jabatan,
            'tipe' => $request->tipe,
        ]);

        return redirect()->route('jabatan.index')->with('success', 'Jabatan berhasil ditambahkan!');
    }

    public function edit($id_jabatan)
    {
        $jabatan = Jabatan::findOrFail($id_jabatan);
        return view('admin.jabatan.editJabatan', compact('jabatan'));
    }

    public function update(Request $request, $id_jabatan)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:50',
            'tipe' => 'required|in:tunggal,multi',
        ]);

        $jabatan = Jabatan::findOrFail($id_jabatan);
        $jabatan->update($request->only(['nama_jabatan', 'tipe']));

        return redirect()->route('jabatan.index')->with('success', 'Jabatan berhasil diperbarui!');
    }

    public function destroy($id_jabatan)
    {
        $jabatan = Jabatan::findOrFail($id_jabatan);
        $jabatan->delete();

        return redirect()->route('jabatan.index')->with('success', 'Jabatan berhasil dihapus!');
    }

    public function detail($id_jabatan)
    {
        $jabatan = Jabatan::findOrFail($id_jabatan);

        if ($jabatan->tipe == 'tunggal') {
            // langsung ke halaman pejabat (tabel pejabat tanpa sub-jabatan)
            return redirect()->route('pejabat.indexTunggal', $id_jabatan);
        }

        // jika multi → masuk ke sub jabatan
        return redirect()->route('subjabatan.index', $id_jabatan);
    }

    public function show($id_jabatan)
    {
        $jabatan = Jabatan::findOrFail($id_jabatan);

        if ($jabatan->tipe == 'multi') {
            // tampilkan sub jabatan
            $subjabatan = $jabatan->subJabatan()->with('pejabat')->get();
            return view('user.struktur.multi', compact('jabatan', 'subjabatan'));
        }

        // jika tunggal
        $pejabat = $jabatan->pejabat()->get();
        return view('user.struktur.show', compact('jabatan', 'pejabat'));
    }

    public function showSemua()
    {
        // Ambil semua jabatan + relasi pejabat
        $jabatans = Jabatan::with('pejabat')->get();

        return view('user.struktur.semua', compact('jabatans'));
    }
}