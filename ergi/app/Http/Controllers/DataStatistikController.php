<?php

namespace App\Http\Controllers;

use App\Models\DataStatistik;
use App\Models\SubkategoriStatistik;
use App\Models\KategoriStatistik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataStatistikController extends Controller
{
    public function index()
    {
        $dataStatistik = DataStatistik::with('subkategori.kategori')->get();
        $subkategori = SubkategoriStatistik::all();
        return view('admin.dataStatistik.dataStatistik', compact('dataStatistik', 'subkategori'));
    }

    public function create()
    {
        $kategori = KategoriStatistik::with('subkategori')->get();
        return view('admin.dataStatistik', compact('kategori'))->with('mode', 'create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jumlah' => 'required|integer',
            'tahun' => 'required|digits:4',
            'id_subkategori' => 'required|exists:subkategori_statistik,id_subkategori',
        ]);

        DataStatistik::create([
            'jumlah' => $request->jumlah,
            'tahun' => $request->tahun. '-01-01',
            'id_subkategori' => $request->id_subkategori,
            'id_pengguna' => auth()->id(),
        ]);

        return redirect()->route('subkategori-statistik.show', $request->id_subkategori)
                        ->with('success', 'Data statistik berhasil ditambahkan!');
    }

    public function edit($id)
    {
        // $data = DataStatistik::findOrFail($id);
        $data = DataStatistik::with('subkategori.kategori')->findOrFail($id);
        $subkategori = SubkategoriStatistik::all(); 
        return view('admin.dataStatistik.editData', compact('data', 'subkategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|integer',
            'tahun' => 'required|digits:4',
            'id_subkategori' => 'required|exists:subkategori_statistik,id_subkategori',
        ]);

        $data = DataStatistik::findOrFail($id);
        $updateData = $request->only('jumlah', 'id_subkategori');
        $updateData['tahun'] = $request->tahun . '-01-01';

        $data->update($updateData);

        return redirect()->route('subkategori-statistik.show', $data->id_subkategori)
                        ->with('success', 'Data statistik berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $data = DataStatistik::findOrFail($id);
        $subkategoriId = $data->id_subkategori;
        $data->delete();

        return redirect()->route('subkategori-statistik.show', $subkategoriId)
                        ->with('success', 'Data statistik berhasil dihapus!');
    }
}