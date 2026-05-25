<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SubmenuController;
use App\Http\Controllers\KategoriStatistikController;
use App\Http\Controllers\SubkategoriStatistikController;
use App\Http\Controllers\DataStatistikController;
use App\Http\Controllers\JenisPPIDController;
use App\Http\Controllers\JudulPPIDController;
use App\Http\Controllers\PPIDController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserMenuController;
use App\Http\Controllers\UserSubmenuController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\SubJabatanController;
use App\Http\Controllers\PejabatController;
use App\Http\Controllers\RwController;
use App\Http\Controllers\RtController;
use App\Http\Controllers\UserStatistikController;
use Barryvdh\Elfinder\ElfinderController;
use App\Models\Menu;
use App\Http\Controllers\UserPPIDController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GaleriController;

// ROUTE UMUM (TANPA LOGIN)
Route::get('/', function () {
    $menus = Menu::all()->groupBy('url');
    return view('user.utama', compact('menus'));
})->name('home');

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Lupa Password
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('forgot.password');
Route::post('/forgot-password', [AuthController::class, 'sendResetCode'])->name('forgot.password.submit');
Route::get('/verify-code', [AuthController::class, 'showVerifyCode'])->name('verify.code');
Route::post('/verify-code', [AuthController::class, 'verifyCode'])->name('verify.code.submit');
Route::get('/reset-password', [AuthController::class, 'showResetPassword'])->name('reset.password');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('reset.password.submit');

// Navbar & Menu User (publik)
Route::get('/navbar', [UserController::class, 'index'])->name('navbar');
Route::get('/user', function () {return view('user.utama');})->name('user.dashboard');

// User Menu & Submenu
Route::prefix('user')->group(function () {
    Route::get('/menu/{kategori}/{menuSlug}/{slug}', [UserMenuController::class, 'showSubmenu'])
        ->name('user.submenu.show');
    Route::get('/menu/{kategori}/{menuSlug}', [UserMenuController::class, 'showMenu'])
        ->name('user.menu.show');
});

// Profil Desa (publik)
Route::get('/profil', [PageController::class, 'index'])->name('profil_desa');

// Statistik Desa (publik)
Route::get('/statistik', [UserStatistikController::class, 'index'])->name('user.statistik');
Route::get('/statistik/{id_kategori}', [UserStatistikController::class, 'showKategori'])->name('user.statistik.kategori');

// Struktur Jabatan & Pejabat (publik)
// Route::get('/struktur/{id_jabatan}', [JabatanController::class, 'show'])->name('user.struktur.show');
Route::get('/struktur', [JabatanController::class, 'showSemua'])->name('user.struktur.semua');

// PPID (publik)
Route::get('/ppid', [UserPPIDController::class, 'index'])
    ->name('user.ppid.index');
Route::get('/ppid/detail/{id}', [UserPPIDController::class, 'showDetail'])
    ->name('user.ppid.show-detail');

// Berita
Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('user.berita.show');
Route::get('/berita', [BeritaController::class, 'list'])->name('user.berita.index');

// Galeri
Route::get('/galeri/{id}', [GaleriController::class, 'show'])->name('user.galeri.show');
Route::get('/galeri', [GaleriController::class, 'list'])->name('user.galeri.index');

// Elfinder (bisa diakses setelah login)
Route::prefix('elfinder')->group(function () {
    Route::get('/', [ElfinderController::class, 'showIndex'])->name('elfinder.index');
    Route::any('connector', [ElfinderController::class, 'showConnector'])->name('elfinder.connector');
    Route::get('popup/{input_id?}', [ElfinderController::class, 'showPopup'])->name('elfinder.popup');
});

// ROUTE YANG BUTUH LOGIN
Route::middleware(['auth'])->group(function () {

    // === UPDATE PROFIL SENDIRI ===
    Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');

    // === KHUSUS SUPERADMIN ===
    Route::middleware(['role:superadmin'])->group(function () {
        Route::get('/add-admin', [AuthController::class, 'addAdmin'])->name('addAdmin');
        Route::post('/add-admin', [AuthController::class, 'storeAdmin'])->name('superadmin.addAdmin.submit');
        Route::post('/toggle-admin/{id_pengguna}', [AuthController::class, 'toggleAdmin'])->name('superadmin.toggleAdmin');
        Route::post('/toggle-admin-ajax/{id_pengguna}', [AuthController::class, 'toggleAdminAjax'])->name('superadmin.toggleAdminAjax');
        Route::delete('/delete-pengguna/{id_pengguna}', [AuthController::class, 'deletePengguna'])->name('superadmin.deletePengguna');
        Route::put('/superadmin/update-pengguna/{id_pengguna}', [AuthController::class, 'updatePengguna'])->name('superadmin.updatePengguna');
    });

    // === KHUSUS ADMIN ===
    Route::middleware(['role:admin'])->group(function () {

        // Dashboard
        Route::get('/admin/dashboard', [MenuController::class, 'index'])->name('admin.dashboard');

        // === MENU & SUBMENU ===
        Route::prefix('admin/menu')->group(function () {
            Route::get('/', [MenuController::class, 'showMenu'])->name('menu.index');
            Route::get('/tambah', [MenuController::class, 'create'])->name('menu.create');
            Route::post('/store', [MenuController::class, 'store'])->name('menu.store');
            Route::get('/{id_menu}/edit', [MenuController::class, 'edit'])->name('menu.edit');
            Route::put('/{id_menu}', [MenuController::class, 'update'])->name('menu.update');
            Route::delete('/{id_menu}', [MenuController::class, 'destroy'])->name('menu.destroy');

            Route::get('/{id_menu}/submenu', [SubmenuController::class, 'index'])->name('submenu.index');
            Route::get('/{id_menu}/submenu/create', [SubmenuController::class, 'create'])->name('submenu.create');
            Route::post('/{id_menu}/submenu', [SubmenuController::class, 'store'])->name('submenu.store');
            Route::get('/{id_menu}/submenu/{id_submenu}/edit', [SubmenuController::class, 'edit'])->name('submenu.edit');
            Route::put('/{id_menu}/submenu/{id_submenu}', [SubmenuController::class, 'update'])->name('submenu.update');
            Route::delete('/{id_menu}/submenu/{id_submenu}', [SubmenuController::class, 'destroy'])->name('submenu.destroy');
            Route::get('/{id_menu}/kelola', [SubmenuController::class, 'kelola'])->name('submenu.kelola');
        });

        // === KATEGORI STATISTIKK ===
        Route::prefix('admin/kategori-statistik')->group(function () {
            Route::get('/', [KategoriStatistikController::class, 'index'])->name('kategori-statistik.index');
            Route::get('/tambah', [KategoriStatistikController::class, 'create'])->name('kategori-statistik.create');
            Route::post('/store', [KategoriStatistikController::class, 'store'])->name('kategori-statistik.store');
            Route::get('/edit/{id_kategori}', [KategoriStatistikController::class, 'edit'])->name('kategori-statistik.edit');
            Route::put('/update/{id_kategori}', [KategoriStatistikController::class, 'update'])->name('kategori-statistik.update');
            Route::delete('/hapus/{id_kategori}', [KategoriStatistikController::class, 'destroy'])->name('kategori-statistik.destroy');
        });

        // === SUBKATEGORI STATISTIK ===
        Route::prefix('admin/subkategori-statistik')->group(function () {
            Route::get('/{id_kategori}', [SubkategoriStatistikController::class, 'index'])->name('subkategori-statistik.index');
            Route::get('/tambah/{id_kategori}', [SubkategoriStatistikController::class, 'create'])->name('subkategori-statistik.create');
            Route::post('/store', [SubkategoriStatistikController::class, 'store'])->name('subkategori-statistik.store');
            Route::get('/edit/{id}', [SubkategoriStatistikController::class, 'edit'])->name('subkategori-statistik.edit');
            Route::put('/update/{id}', [SubkategoriStatistikController::class, 'update'])->name('subkategori-statistik.update');
            Route::delete('/hapus/{id}', [SubkategoriStatistikController::class, 'destroy'])->name('subkategori-statistik.destroy');
            Route::get('/{id}/detail', [SubkategoriStatistikController::class, 'show'])->name('subkategori-statistik.show');
        });

        // === DATA STATISTIK ===
        Route::prefix('admin/data-statistik')->group(function () {
            Route::get('/', [DataStatistikController::class, 'index'])->name('data-statistik.index');
            Route::get('/tambah', [DataStatistikController::class, 'create'])->name('data-statistik.create');
            Route::post('/store', [DataStatistikController::class, 'store'])->name('data-statistik.store');
            Route::get('/edit/{id}', [DataStatistikController::class, 'edit'])->name('data-statistik.edit');
            Route::put('/update/{id}', [DataStatistikController::class, 'update'])->name('data-statistik.update');
            Route::delete('/hapus/{id}', [DataStatistikController::class, 'destroy'])->name('data-statistik.destroy');
        });

        // === JENIS PPID ===
        Route::prefix('admin/jenis-ppid')->group(function () {
            Route::get('/', [JenisPPIDController::class, 'index'])->name('jenis-ppid.index');
            Route::get('/tambah', [JenisPPIDController::class, 'create'])->name('jenis-ppid.create');
            Route::post('/store', [JenisPPIDController::class, 'store'])->name('jenis-ppid.store');
            Route::get('/edit/{id}', [JenisPPIDController::class, 'edit'])->name('jenis-ppid.edit');
            Route::put('/update/{id}', [JenisPPIDController::class, 'update'])->name('jenis-ppid.update');
            Route::delete('/hapus/{id}', [JenisPPIDController::class, 'destroy'])->name('jenis-ppid.destroy');
        });

        // === JUDUL PPID ===
        Route::prefix('admin/judul-ppid')->group(function () {
            Route::get('/{id_jenis_ppid}', [JudulPPIDController::class, 'index'])->name('judul-ppid.index');
            Route::get('/tambah/{id_jenis_ppid}', [JudulPPIDController::class, 'create'])->name('judul-ppid.create');
            Route::post('/store', [JudulPPIDController::class, 'store'])->name('judul-ppid.store');
            Route::get('/edit/{id}', [JudulPPIDController::class, 'edit'])->name('judul-ppid.edit');
            Route::put('/update/{id}', [JudulPPIDController::class, 'update'])->name('judul-ppid.update');
            Route::delete('/hapus/{id}', [JudulPPIDController::class, 'destroy'])->name('judul-ppid.destroy');
        });

        // === DOKUMEN PPID ===
        Route::prefix('admin/ppid')->group(function () {
            Route::get('/{id_judul}', [PPIDController::class, 'index'])->name('ppid.index');
            Route::get('/tambah/{id_judul}', [PPIDController::class, 'create'])->name('ppid.create');
            Route::post('/store', [PPIDController::class, 'store'])->name('ppid.store');
            Route::get('/edit/{id_ppid}', [PPIDController::class, 'edit'])->name('ppid.edit');
            Route::put('/update/{id_ppid}', [PPIDController::class, 'update'])->name('ppid.update');
            Route::delete('/hapus/{id_ppid}', [PPIDController::class, 'destroy'])->name('ppid.destroy');
        });

        // === PROFIL DESA ===
        Route::prefix('profil')->group(function () {
            Route::get('/tambah', [PageController::class, 'create'])->name('profil.tambah');
            Route::post('/', [PageController::class, 'store'])->name('profil.store');
            Route::get('/edit/{id}', [PageController::class, 'edit'])->name('profil.edit');
            Route::put('/update/{id}', [PageController::class, 'update'])->name('profil.update');
            Route::delete('/hapus/{id}', [PageController::class, 'destroy'])->name('profil.hapus');
        });

        Route::prefix('admin')->group(function () {
            // RW
            Route::get('/rw', [RwController::class, 'index'])->name('rw.index');
            Route::get('/rw/tambah', [RwController::class, 'create'])->name('rw.create');
            Route::post('/rw', [RwController::class, 'store'])->name('rw.store');
            Route::get('/rw/{id_rw}/edit', [RwController::class, 'edit'])->name('rw.edit');
            Route::put('/rw/{id_rw}', [RwController::class, 'update'])->name('rw.update');
            Route::delete('/rw/{id_rw}', [RwController::class, 'destroy'])->name('rw.destroy');
            Route::get('/rw/{id_rw}', [RwController::class, 'show'])->name('rw.show');

            // RT (nested dalam RW)
            Route::prefix('rw/{id_rw}/rt')->group(function () {
                Route::get('/', [RtController::class, 'index'])->name('rt.index');
                Route::get('/tambah', [RtController::class, 'create'])->name('rt.create');
                Route::post('/store', [RtController::class, 'store'])->name('rt.store');
                Route::get('/{id_rt}/edit', [RtController::class, 'edit'])->name('rt.edit');
                Route::put('/{id_rt}/update', [RtController::class, 'update'])->name('rt.update');
                Route::delete('/{id_rt}/hapus', [RtController::class, 'destroy'])->name('rt.destroy');
            });
        });

        Route::prefix('admin')->group(function () {
            // RW
            Route::get('/rw', [RwController::class, 'index'])->name('rw.index');
            Route::get('/rw/tambah', [RwController::class, 'create'])->name('rw.create');
            Route::post('/rw', [RwController::class, 'store'])->name('rw.store');
            Route::get('/rw/{id_rw}/edit', [RwController::class, 'edit'])->name('rw.edit');
            Route::put('/rw/{id_rw}', [RwController::class, 'update'])->name('rw.update');
            Route::delete('/rw/{id_rw}', [RwController::class, 'destroy'])->name('rw.destroy');
            Route::get('/rw/{id_rw}', [RwController::class, 'show'])->name('rw.show');

            // RT (nested dalam RW)
            Route::prefix('rw/{id_rw}/rt')->group(function () {
                Route::get('/', [RtController::class, 'index'])->name('rt.index');
                Route::get('/tambah', [RtController::class, 'create'])->name('rt.create');
                Route::post('/store', [RtController::class, 'store'])->name('rt.store');
                Route::get('/{id_rt}/edit', [RtController::class, 'edit'])->name('rt.edit');
                Route::put('/{id_rt}/update', [RtController::class, 'update'])->name('rt.update');
                Route::delete('/{id_rt}/hapus', [RtController::class, 'destroy'])->name('rt.destroy');
            });
        });
        
        Route::prefix('admin/jabatan')->group(function () {
            Route::get('/', [JabatanController::class, 'index'])->name('jabatan.index');
            Route::get('/create', [JabatanController::class, 'create'])->name('jabatan.create');
            Route::post('/store', [JabatanController::class, 'store'])->name('jabatan.store');
            Route::get('/{id_jabatan}/edit', [JabatanController::class, 'edit'])->name('jabatan.edit');
            Route::put('/{id_jabatan}', [JabatanController::class, 'update'])->name('jabatan.update');
            Route::delete('/{id_jabatan}', [JabatanController::class, 'destroy'])->name('jabatan.destroy');
            Route::get('/{id_jabatan}/detail', [JabatanController::class, 'detail'])->name('jabatan.detail');

            // SubJabatan Routes
            Route::get('/{id_jabatan}/subjabatan', [SubJabatanController::class, 'index'])->name('subjabatan.index');
            Route::get('/{id_jabatan}/subjabatan/create', [SubJabatanController::class, 'create'])->name('subjabatan.create');
            Route::post('/{id_jabatan}/subjabatan/store', [SubJabatanController::class, 'store'])->name('subjabatan.store');
            Route::get('/{id_jabatan}/subjabatan/{id_subjabatan}/edit', [SubJabatanController::class, 'edit'])->name('subjabatan.edit');
            Route::put('/{id_jabatan}/subjabatan/{id_subjabatan}', [SubJabatanController::class, 'update'])->name('subjabatan.update');
            Route::delete('/{id_jabatan}/subjabatan/{id_subjabatan}', [SubJabatanController::class, 'destroy'])->name('subjabatan.destroy');
           
            Route::get('/{id_jabatan}/pejabat/create/{id_sub?}', [PejabatController::class, 'create'])->name('pejabat.create');
            Route::get('/{id_jabatan}/pejabat/{id_sub?}', [PejabatController::class, 'index'])->name('pejabat.index');
            Route::post('/pejabat/store', [PejabatController::class, 'store'])->name('pejabat.store');
            Route::get('/pejabat/edit/{id_pejabat}/{id_sub?}', [PejabatController::class, 'edit'])->name('pejabat.edit');
            Route::put('/pejabat/update/{id_pejabat}/{id_sub?}', [PejabatController::class, 'update'])->name('pejabat.update');
            Route::delete('/pejabat/destroy/{id_pejabat}/{id_sub?}', [PejabatController::class, 'destroy'])->name('pejabat.destroy');
            Route::get('/pejabat/show/{id_pejabat}', [PejabatController::class, 'show'])->name('pejabat.show');
        });

        // === BERITA ===
        Route::prefix('admin')->group(function() {
            Route::resource('berita', BeritaController::class);
            Route::get('berita/detail/{id_berita}', [BeritaController::class, 'detail'])->name('berita.detail');
        });

        // === GALERI ===
        Route::prefix('admin')->group(function() {
            Route::resource('galeri', GaleriController::class);
            Route::get('galeri/detail/{id_galeri}', [GaleriController::class, 'detail'])->name('galeri.detail');
        });
    });
});