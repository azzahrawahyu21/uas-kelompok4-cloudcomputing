<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengguna;
use App\Models\Menu;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AuthController extends Controller
{
    // 🔐 Tampilkan halaman login
    public function showLogin()
    {
        if (Auth::check()) {
            $role = strtolower(Auth::user()->peran);
            if ($role === 'superadmin') {
                return redirect()->route('addAdmin');
            } elseif ($role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
        }

        return view('login');
    }

    // 🔑 Proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'kata_sandi' => 'required',
        ]);

        $pengguna = Pengguna::where('email', $request->email)->first();

        if (!$pengguna) {
            return back()->withErrors(['email' => 'Akun tidak ditemukan.']);
        }

        if ($pengguna->status !== 'Aktif') {
            return back()->withErrors(['email' => 'Akun Anda tidak aktif.']);
        }

        if (!Hash::check($request->kata_sandi, $pengguna->kata_sandi)) {
            return back()->withErrors(['email' => 'Kata sandi salah.']);
        }

        Auth::login($pengguna);

        $role = strtolower($pengguna->peran);

        if ($role === 'superadmin') {
            return redirect()->route('addAdmin');
        } elseif ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        Auth::logout();
        return back()->withErrors(['email' => 'Akun tidak memiliki akses.']);
    }

    // 🚪 Logout
    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('login');
    }

    // 📊 Dashboard Admin
    public function dashboard()
    {
        $menus = Menu::all()->groupBy('url');
        return view('admin.dashboard', compact('menus'));
    }

    // 👤 Halaman Tambah Admin (khusus superadmin)
    public function addAdmin()
    {
        $penggunas = Pengguna::whereIn('peran', ['Admin', 'Superadmin'])->get();
        return view('superadmin.addAdmin', compact('penggunas'));
    }

    public function storeAdmin(Request $request)
    {
        $request->validate([
            'nama_pengguna' => 'required|string|max:45',
            'email' => 'required|email|unique:pengguna,email',
            'kata_sandi' => 'required|string|min:6',
            'peran' => 'required|in:admin,superadmin',
        ]);

        Pengguna::create([
            'nama_pengguna' => $request->nama_pengguna,
            'email' => $request->email,
            'kata_sandi' => Hash::make($request->kata_sandi),
            'peran' => ucfirst($request->peran),
            'status' => 'Aktif',
        ]);

        return redirect()->back()->with('success', 'Pengguna berhasil ditambahkan!');
    }

    // Toggle status admin/superadmin
    public function toggleAdmin($id_pengguna)
    {
        $pengguna = Pengguna::findOrFail($id_pengguna);

        // Cek apakah superadmin mencoba mengubah statusnya sendiri
        if ($pengguna->id_pengguna === Auth::user()->id_pengguna) {
            return redirect()->back()->with('error', 'Anda tidak dapat mengubah status akun Anda sendiri.');
        }

        if (!in_array(strtolower($pengguna->peran), ['admin', 'superadmin'])) {
            return redirect()->back()->with('error', 'Hanya admin dan superadmin yang dapat diubah statusnya.');
        }

        $pengguna->status = $pengguna->status === 'Aktif' ? 'Tidak Aktif' : 'Aktif';
        $pengguna->save();

        return redirect()->back()->with('success', 'Status ' . $pengguna->peran . ' berhasil diubah.');
    }

    // Toggle status admin/superadmin via AJAX
    public function toggleAdminAjax($id_pengguna)
    {
        $pengguna = Pengguna::findOrFail($id_pengguna);

        // Cek apakah superadmin mencoba mengubah statusnya sendiri
        if ($pengguna->id_pengguna === Auth::user()->id_pengguna) {
            return response()->json(['error' => 'Anda tidak dapat mengubah status akun Anda sendiri.'], 403);
        }

        // Hanya izinkan perubahan status untuk admin dan superadmin
        if (!in_array(strtolower($pengguna->peran), ['admin', 'superadmin'])) {
            return response()->json(['error' => 'Hanya admin dan superadmin yang dapat diubah statusnya.'], 403);
        }

        $pengguna->status = $pengguna->status === 'Aktif' ? 'Tidak Aktif' : 'Aktif';
        $pengguna->save();

        return response()->json([
            'success' => true,
            'status' => $pengguna->status,
            'peran' => $pengguna->peran,
        ]);

        $admin->nama_pengguna = $request->nama_pengguna;
        $admin->email = $request->email;

        if ($request->filled('kata_sandi')) {
            $admin->kata_sandi = Hash::make($request->kata_sandi);
        }

        $admin->save();

        return redirect()->route('admin.profil')->with('success', 'Profil berhasil diperbarui!');
    }

    public function deletePengguna($id_pengguna)
    {
        $pengguna = Pengguna::findOrFail($id_pengguna);

        // Cek apakah superadmin mencoba menghapus dirinya sendiri
        if ($pengguna->id_pengguna === Auth::user()->id_pengguna) {
            return redirect()->back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        // Hanya izinkan penghapusan untuk admin dan superadmin
        if (!in_array(strtolower($pengguna->peran), ['admin', 'superadmin'])) {
            return redirect()->back()->with('error', 'Hanya admin dan superadmin yang dapat dihapus.');
        }

        $pengguna->delete();

        return redirect()->back()->with('success', ucfirst($pengguna->peran) . ' berhasil dihapus.');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama_pengguna' => 'required|string|max:45',
            'kata_sandi' => 'nullable|string|min:6|confirmed',
        ]);

        $user->nama_pengguna = $request->nama_pengguna;
        if ($request->filled('kata_sandi')) {
            $user->kata_sandi = Hash::make($request->kata_sandi);
        }
        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }

    public function updatePengguna(Request $request)
    {
        if (strtolower(Auth::user()->peran) !== 'superadmin') {
            return redirect()->back()->with('error', 'Hanya superadmin yang dapat mengedit pengguna lain.');
        }

        $request->validate([
            'id_pengguna' => 'required|exists:pengguna,id_pengguna',
            'nama_pengguna' => 'required|string|max:45',
            'peran' => 'required|in:admin,superadmin',
            'kata_sandi' => 'nullable|string|min:6',
        ]);

        $pengguna = Pengguna::findOrFail($request->id_pengguna);

        if ($pengguna->id_pengguna === Auth::user()->id_pengguna) {
            return redirect()->back()->with('error', 'Gunakan pengaturan profil untuk mengedit akun Anda sendiri.');
        }

        $pengguna->nama_pengguna = $request->nama_pengguna;
        $pengguna->peran = ucfirst($request->peran);
        if ($request->filled('kata_sandi')) {
            $pengguna->kata_sandi = Hash::make($request->kata_sandi);
        }
        $pengguna->save();

        return redirect()->back()->with('success', 'Pengguna berhasil diperbarui!');
    }

    public function showForgotPassword()
    {
        return view('forgot_password');
    }

    public function sendResetCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:pengguna,email',
        ]);

        $pengguna = Pengguna::where('email', $request->email)->first();

        if ($pengguna->status !== 'Aktif') {
            return back()->withErrors(['email' => 'Akun Anda tidak aktif.']);
        }

        $resetCode = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        $expiresAt = Carbon::now()->addMinutes(10);

        $pengguna->update([
            'reset_code' => $resetCode,
            'reset_code_expires_at' => $expiresAt,
        ]);

        Mail::raw("Kode verifikasi Anda adalah: $resetCode. Kode ini berlaku selama 10 menit.", function ($message) use ($pengguna) {
            $message->to($pengguna->email)
                    ->subject('Kode Verifikasi Lupa Kata Sandi');
        });

        return redirect()->route('verify.code')->with('email', $pengguna->email)->with('success', 'Kode verifikasi telah dikirim ke email Anda.');
    }

    public function showVerifyCode()
    {
        $email = session('email');
        if (!$email) {
            return redirect()->route('forgot.password')->withErrors(['error' => 'Masukkan email terlebih dahulu.']);
        }
        return view('verifikasi_email', compact('email'));
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:pengguna,email',
            'digit1' => 'required|numeric',
            'digit2' => 'required|numeric',
            'digit3' => 'required|numeric',
            'digit4' => 'required|numeric',
        ]);

        $code = $request->digit1 . $request->digit2 . $request->digit3 . $request->digit4;
        $pengguna = Pengguna::where('email', $request->email)->first();

        if ($pengguna->reset_code !== $code || Carbon::now()->gt($pengguna->reset_code_expires_at)) {
            return back()->withErrors(['error' => 'Kode verifikasi salah atau telah kadaluarsa.']);
        }

        return redirect()->route('reset.password')->with('email', $pengguna->email)->with('success', 'Kode verifikasi valid.');
    }

    public function showResetPassword()
    {
        $email = session('email');
        if (!$email) {
            return redirect()->route('forgot.password')->withErrors(['error' => 'Masukkan email dan verifikasi kode terlebih dahulu.']);
        }
        return view('reset_password', compact('email'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:pengguna,email',
            'kata_sandi' => 'required|string|min:6|confirmed',
        ]);

        $pengguna = Pengguna::where('email', $request->email)->first();

        $pengguna->update([
            'kata_sandi' => Hash::make($request->kata_sandi),
            'reset_code' => null,
            'reset_code_expires_at' => null,
        ]);

        return redirect()->route('login')->with('success', 'Kata sandi berhasil direset. Silakan login.');
    }
}