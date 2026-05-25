<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rt;
use App\Models\Rw;
use Illuminate\Support\Facades\Auth;

class RtController extends Controller
{
    public function index($id_rw)
    {
        $rw = Rw::findOrFail($id_rw);
        $rts = Rt::where('id_rw', $id_rw)->get();
        return view('admin.RtRw.rt', compact('rw', 'rts'));
    }

    public function create($id_rw)
    {
        $rw = Rw::findOrFail($id_rw);
        return view('admin.RtRw.tambahRt', compact('rw'));
    }

    public function store(Request $request, $id_rw)
    {
        $request->validate([
            'no_rt' => 'required|string|max:10',
            'nama_rt' => 'required|string|max:45',
        ]);

        $lastRt = Rt::orderBy('id_rt', 'desc')->first();
        $newId = $lastRt ? $lastRt->id_rt + 1 : 1;

        $rt = new Rt();
        $rt->id_rt = $newId;
        $rt->no_rt = $request->no_rt;
        $rt->nama_rt = $request->nama_rt;
        $rt->id_rw = $id_rw;
        $rt->id_pengguna = 1; // pastikan ID pengguna valid
        $rt->save();

        return redirect()->route('rw.show', $id_rw)
            ->with('success', 'Data RT berhasil ditambahkan!');
    }

    public function edit($id_rw, $id_rt)
    {
        $rw = Rw::findOrFail($id_rw);
        $rt = Rt::findOrFail($id_rt);
        return view('admin.RtRw.editRt', compact('rw', 'rt'));
    }

    public function update(Request $request, $id_rw, $id_rt)
    {
        $request->validate([
            'no_rt' => 'required|string|max:10',
            'nama_rt' => 'required|string|max:45',
            'id_pengguna' => 'nullable|integer',
        ]);

        $rt = Rt::findOrFail($id_rt);
        $rt->update($request->only(['no_rt', 'nama_rt', 'id_pengguna']));

        // arahkan kembali ke halaman detail RW
        return redirect()->route('rw.show', $id_rw)
            ->with('success', 'Data RT berhasil diperbarui!');
    }

    public function destroy($id_rw, $id_rt)
    {
        $rt = Rt::findOrFail($id_rt);
        $rt->delete();

        // arahkan kembali ke halaman detail RW
        return redirect()->route('rw.show', $id_rw)
            ->with('success', 'Data RT berhasil dihapus!');
    }
}
