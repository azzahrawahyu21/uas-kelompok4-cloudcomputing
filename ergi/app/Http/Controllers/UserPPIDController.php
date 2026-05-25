<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisPPID;

class UserPPIDController extends Controller
{
    public function index()
    {
        $jenisPpids = JenisPPID::all();
        return view('user.ppid.show-ppid', compact('jenisPpids'));
    }

    // Halaman detail jenis + daftar dokumen
    public function showDetail($id)
    {
        $jenis = JenisPPID::with('juduls.dokumens')->findOrFail($id);
        // $jenis->juduls = koleksi JudulPPID yang punya relasi ke PPID (dokumen)
        return view('user.ppid.show-detail', compact('jenis'));
    }
}
