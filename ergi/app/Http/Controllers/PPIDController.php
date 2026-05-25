<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;use App\Models\PPID;
use App\Models\JenisPPID;
use App\Models\JudulPPID;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PPIDController extends Controller
{
    // Daftar dokumen PPID per jenis
    public function index($id_judul)
    {
        $judul = JudulPPID::findOrFail($id_judul);
        $jenis = $judul->jenis;
        $dokumens = PPID::where('id_judul', $id_judul)
                        ->orderBy('tanggal', 'desc')
                        ->get();

        return view('admin.ppid.detailPpid', compact('judul', 'jenis', 'dokumens'));
    }

    // Tambah dokumen
    public function create($id_judul)
    {
        $judul = JudulPPID::findOrFail($id_judul);
        $jenis = $judul->jenis;
        return view('admin.ppid.tambahDokumen', compact('judul', 'jenis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tentang' => 'required|string',
            'tanggal' => 'required|date',
            'file_url' => 'required|string',
            'id_judul' => 'required|exists:judul_ppid,id_judul'
        ]);

        $fileUrl = $request->file_url; // AMBIL DARI REQUEST

        // Validasi PDF
        if (!str_ends_with(strtolower($fileUrl), '.pdf')) {
            return back()->with('error', 'File harus berformat PDF!');
        }

        PPID::create([
            'tentang' => $request->tentang,
            'tanggal' => $request->tanggal,
            'file' => $fileUrl,
            'id_judul' => $request->id_judul,
            'id_pengguna' => Auth::id()
        ]);

        $judul = JudulPPID::find($request->id_judul);
        return redirect()->route('ppid.index', $judul->id_judul)
                        ->with('success', 'Dokumen berhasil ditambahkan!');
    }

    public function edit($id_ppid)
    {
        $ppid = PPID::with('judul.jenis')->findOrFail($id_ppid);
        return view('admin.ppid.editPpid', compact('ppid'));
    }

    public function update(Request $request, $id_ppid)
    {
        $request->validate([
            'tentang' => 'required|string',
            'tanggal' => 'required|date',
            'file_url' => 'nullable|url',
        ]);

        $ppid = PPID::findOrFail($id_ppid);
        $data = $request->only(['tentang', 'tanggal']);

        if ($request->filled('file_url')) {
            $newUrl = $request->file_url;

            if (!str_ends_with(strtolower($newUrl), '.pdf')) {
                return back()->with('error', 'File harus PDF!');
            }

            // Hapus file lama
            if ($ppid->file) {
                $oldPath = parse_url($ppid->file, PHP_URL_PATH);
                $oldPath = ltrim($oldPath, '/');
                if (str_starts_with($oldPath, 'storage/')) {
                    $oldPath = substr($oldPath, 8);
                }
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            $data['file'] = $newUrl;
        }

        $ppid->update($data);

        return redirect()->route('ppid.index', $ppid->id_judul)
                        ->with('success', 'Dokumen berhasil diperbarui!');
    }

    public function destroy($id_ppid)
    {
        $ppid = PPID::findOrFail($id_ppid);

        // Ambil URL file dari DB
        $fileUrl = $ppid->file;

        if ($fileUrl) {
            $parsed = parse_url($fileUrl);
            $path = isset($parsed['path']) ? ltrim($parsed['path'], '/') : '';

            // Hapus bagian 'storage/' kalau ada
            if (str_starts_with($path, 'storage/')) {
                $path = substr($path, 8); // Hapus 'storage/'
            }

            // Cek apakah file ada di storage
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }

        $id_judul = $ppid->id_judul;
        $ppid->delete();

        return redirect()->route('ppid.index', $id_judul)
                        ->with('success', 'Dokumen dan file berhasil dihapus!');
    }
}
