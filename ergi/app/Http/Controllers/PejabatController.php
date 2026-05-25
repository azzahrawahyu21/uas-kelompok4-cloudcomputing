<?php

namespace App\Http\Controllers;

use App\Models\Pejabat;
use App\Models\Jabatan;
use App\Models\SubJabatan;
use Illuminate\Http\Request;

class PejabatController extends Controller
{
    public function index($id_jabatan, $id_sub = null)
    {
        $jabatan = Jabatan::findOrFail($id_jabatan);
        $subjabatan = $id_sub ? SubJabatan::findOrFail($id_sub) : null;

        $pejabats = Pejabat::where('id_jabatan', $id_jabatan)
            ->when($id_sub, fn($q) => $q->where('id_sub', $id_sub))
            ->when(!$id_sub, fn($q) => $q->whereNull('id_sub'))
            ->get();

        return view('admin.jabatan.pejabat', compact('jabatan','subjabatan','pejabats','id_sub'));
    }

    public function create($id_jabatan, $id_sub = null)
    {
        $jabatan = Jabatan::findOrFail($id_jabatan);
        $subjabatan = $id_sub ? SubJabatan::findOrFail($id_sub) : null;

        return view('admin.jabatan.tambahPejabat', compact('jabatan','subjabatan','id_sub'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pejabat' => 'required|string|max:50',
            'id_jabatan'   => 'required|integer',
            'id_sub'       => 'nullable|integer',
            'deskripsi'    => 'nullable|string',
            'foto'         => 'nullable|string|max:255', // nama file saja
            'foto_url'     => 'nullable|string|max:255', // URL lengkap dari ElFinder
        ]);

        Pejabat::create([
            'id_jabatan'   => $request->id_jabatan,
            'id_sub'       => $request->id_sub ?: null,
            'nama_pejabat' => $request->nama_pejabat,
            'deskripsi'    => $request->deskripsi ?: null,
            'foto'         => $request->foto, // simpan hanya nama file
        ]);

        return redirect()->route('pejabat.index', [$request->id_jabatan, $request->id_sub])
                        ->with('success', 'Pejabat berhasil ditambahkan!');
    }


    public function update(Request $request, $id_pejabat, $id_sub = null)
    {
        $request->validate([
            'nama_pejabat' => 'required|string|max:50',
            'deskripsi'    => 'nullable|string',
            'foto'         => 'nullable|string|max:255', // nama file saja
            'foto_url'     => 'nullable|string|max:255', // untuk preview saja
        ]);

        $pejabat = Pejabat::findOrFail($id_pejabat);

        // Simpan nama file saja
        $namaFile = $request->foto ?: $pejabat->foto;

        $pejabat->update([
            'nama_pejabat' => $request->nama_pejabat,
            'deskripsi'    => $request->deskripsi,
            'foto'         => $namaFile,
        ]);

        return redirect()
            ->route('pejabat.index', [$pejabat->id_jabatan, $id_sub])
            ->with('success', 'Pejabat berhasil diperbarui!');
    }

    public function edit($id_pejabat, $id_sub = null)
    {
        $pejabat = Pejabat::findOrFail($id_pejabat);
        $jabatan = Jabatan::findOrFail($pejabat->id_jabatan);
        $subjabatan = $id_sub ? SubJabatan::findOrFail($id_sub) : null;

        return view('admin.jabatan.editPejabat', compact('pejabat','jabatan','subjabatan','id_sub'));
    }

    public function destroy($id_pejabat, $id_sub = null)
    {
        $pejabat = Pejabat::findOrFail($id_pejabat);
        $id_jabatan = $pejabat->id_jabatan;
        $pejabat->delete();

        return redirect()->route('pejabat.index', array_filter([$id_jabatan, $id_sub]))
                         ->with('success', 'Pejabat berhasil dihapus!');
    }

    public function show($id_pejabat, $id_sub = null)
    {
        $pejabat = Pejabat::findOrFail($id_pejabat);
        $jabatan = Jabatan::findOrFail($pejabat->id_jabatan);
        $subjabatan = $pejabat->id_sub ? SubJabatan::findOrFail($pejabat->id_sub) : null;
        $id_sub = $pejabat->id_sub;
    
        return view('admin.jabatan.showPejabat', compact('pejabat','jabatan','subjabatan','id_sub'));
    }
}
