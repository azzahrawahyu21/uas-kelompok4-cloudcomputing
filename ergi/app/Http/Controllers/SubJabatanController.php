<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jabatan;
use App\Models\SubJabatan;

class SubJabatanController extends Controller
{
    public function index($id_jabatan)
    {
        $jabatan = Jabatan::findOrFail($id_jabatan);
        $subJabatan = SubJabatan::where('id_jabatan', $id_jabatan)->get();
        return view('admin.jabatan.subJabatan', compact('jabatan','subJabatan'));
    }

    public function create($id_jabatan)
    {
        $jabatan = Jabatan::findOrFail($id_jabatan);
        $subJabatan = SubJabatan::where('id_jabatan', $id_jabatan)->get();
        return view('admin.jabatan.tambahSubJabatan', compact('jabatan','subJabatan'));
    }

    public function store(Request $request, $id_jabatan)
    {
        $request->validate([
            'nama_sub' => 'required|string|max:50',
            'parent_id' => 'nullable|integer',
        ]);

        SubJabatan::create([
            'nama_sub' => $request->nama_sub,
            'parent_id' => $request->parent_id,
            'id_jabatan' => $id_jabatan,
        ]);

        return redirect()->route('subjabatan.index', $id_jabatan)->with('success', 'Sub Jabatan berhasil ditambahkan!');
    }

    public function kelola($id_jabatan)
    {
        $jabatan = Jabatan::findOrFail($id_jabatan);
        $subJabatan = SubJabatan::where('id_jabatan', $id_jabatan)->get();
        return view('admin.jabatan.kelolaSubJabatan', compact('jabatan','subJabatan'));
    }

    public function edit($id_jabatan, $id_subjabatan)
    {
        $jabatan = Jabatan::findOrFail($id_jabatan);
        $subJabatan = SubJabatan::findOrFail($id_subjabatan);
        return view('admin.jabatan.editSubJabatan', compact('jabatan', 'subJabatan'));
    }

    public function update(Request $request, $id_jabatan, $id_subjabatan)
    {
        $request->validate([
            'nama_sub' => 'required|string|max:50',
            'parent_id' => 'nullable|integer',
        ]);

        $subJabatan = SubJabatan::findOrFail($id_subjabatan);
        $subJabatan->update($request->only(['nama_sub', 'parent_id']));

        return redirect()->route('subjabatan.index', $id_jabatan)->with('success', 'Sub Jabatan berhasil diperbarui!');
    }

    public function destroy($id_jabatan, $id_subjabatan)
    {
        $subJabatan = SubJabatan::findOrFail($id_subjabatan);
        $subJabatan->delete();

        return redirect()->route('subjabatan.index', $id_jabatan)->with('success', 'Sub Jabatan berhasil dihapus!');
    }
}
