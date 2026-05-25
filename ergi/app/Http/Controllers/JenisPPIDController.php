<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisPPID;

class JenisPPIDController extends Controller
{
    public function index()
    {
        $jenisPpids = JenisPPID::all();
        return view('admin.ppid.jenisPpid', compact('jenisPpids'));
    }

    public function create()
    {
        return view('admin.ppid.tambahJenisPpid');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis_ppid' => 'required|string|max:45|unique:jenis_ppid,nama_jenis_ppid'
        ]);

        JenisPPID::create($request->only('nama_jenis_ppid'));

        return redirect()->route('jenis-ppid.index')
                         ->with('success', 'Jenis PPID berhasil ditambahkan!');
    }

    public function edit($id_jenis_ppid)
    {
        $jenis = JenisPPID::findOrFail($id_jenis_ppid);
        return view('admin.ppid.editJenisPpid', compact('jenis'));
    }

    public function update(Request $request, $id_jenis_ppid)
    {
        $request->validate([
            'nama_jenis_ppid' => 'required|string|max:45|unique:jenis_ppid,nama_jenis_ppid,' . $id_jenis_ppid . ',id_jenis_ppid'
        ]);

        $jenis = JenisPPID::findOrFail($id_jenis_ppid);
        $jenis->update($request->only('nama_jenis_ppid'));

        return redirect()->route('jenis-ppid.index')
                         ->with('success', 'Jenis PPID berhasil diperbarui!');
    }

    public function destroy($id_jenis_ppid)
    {
        $jenis = JenisPPID::findOrFail($id_jenis_ppid);

        // Hapus semua dokumen terkait
        $jenis->ppids()->delete();

        // Hapus semua judul terkait
        $jenis->juduls()->delete();

        // Hapus jenis
        $jenis->delete();

        return redirect()->route('jenis-ppid.index')
                        ->with('success', 'Jenis PPID dan semua data terkait berhasil dihapus!');
    }
}
