<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JudulPPID;
use App\Models\JenisPPID;

class JudulPPIDController extends Controller
{
    public function index($id_jenis_ppid)
    {
        $jenis = JenisPPID::findOrFail($id_jenis_ppid);
        $juduls = JudulPPID::where('id_jenis_ppid', $id_jenis_ppid)->get();

        return view('admin.ppid.judulPpid', compact('jenis', 'juduls'));
    }

    public function create($id_jenis_ppid)
    {
        $jenis = JenisPPID::findOrFail($id_jenis_ppid);
        return view('admin.ppid.tambahJudulPpid', compact('jenis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:100',
            'id_jenis_ppid' => 'required'
        ]);

        JudulPPID::create($request->only(['judul', 'id_jenis_ppid']));

        return redirect()->route('judul-ppid.index', $request->id_jenis_ppid)
                         ->with('success', 'Judul PPID berhasil ditambahkan!');
    }
    public function edit($id)
    {
        $judul = JudulPPID::findOrFail($id);
        $jenis = $judul->jenis; // untuk breadcrumb

        return view('admin.ppid.editJudulPpid', compact('judul', 'jenis'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:100',
        ]);

        $judul = JudulPPID::findOrFail($id);
        $judul->update($request->only('judul'));

        return redirect()->route('judul-ppid.index', $judul->id_jenis_ppid)
                        ->with('success', 'Judul PPID berhasil diperbarui!');
    }
    public function destroy($id)
    {
        $judul = JudulPPID::findOrFail($id);
        
        // Hapus dokumen terkait
        $judul->dokumens()->delete();
        
        $judul->delete();

        return redirect()->route('judul-ppid.index', $judul->id_jenis_ppid)
                        ->with('success', 'Judul PPID berhasil dihapus!');
    }
}
