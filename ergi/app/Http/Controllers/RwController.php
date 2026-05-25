<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rw;
use Illuminate\Support\Facades\Auth;
use App\Models\Rt;

class RwController extends Controller
{
    public function index()
    {
        $rws = Rw::all();
        return view('admin.RtRw.rw', compact('rws'));
    }

    public function create()
    {
        return view('admin.RtRw.tambahRw');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_rw' => 'required|string|max:10',
            'nama_rw' => 'required|string|max:45',
        ]);

        $validated['id_pengguna'] = Auth::id();

        Rw::create($validated);

        return redirect()->route('rw.index')->with('success', 'Data RW berhasil ditambahkan.');
    }


    public function edit($id_rw)
    {
        $rw = Rw::findOrFail($id_rw);
        return view('admin.RtRw.editRw', compact('rw'));
    }

    public function update(Request $request, $id_rw)
    {
        $request->validate([
            'no_rw' => 'required|string|max:10',
            'nama_rw' => 'required|string|max:45',
            'id_pengguna' => 'nullable|integer',
        ]);

        $rw = Rw::findOrFail($id_rw);
        $rw->update($request->only(['no_rw', 'nama_rw', 'id_pengguna']));

        return redirect()->route('rw.index')->with('success', 'Data RW berhasil diperbarui!');
    }

    public function destroy($id_rw)
    {
        $rw = Rw::findOrFail($id_rw);

        if ($rw->rt()->count() > 0) {
            return redirect()->route('rw.index')
                ->with('error', 'RW tidak bisa dihapus karena masih memiliki RT terkait. Hapus atau pindahkan RT terlebih dahulu.');
        }

        $rw->delete();
        return redirect()->route('rw.index')->with('success', 'Data RW berhasil dihapus!');
    }


    public function show($id_rw)
    {
        $rw = Rw::findOrFail($id_rw);
        $rts = Rt::where('id_rw', $id_rw)->get();

        return view('admin.RtRw.detail', compact('rw', 'rts'));
    }

}
