<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Menu;
use App\Models\KategoriStatistik;
use App\Models\JenisPPID;
use App\Models\Rw;
use App\Models\Jabatan;
use App\Models\Berita;
use App\Models\Galeri;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(['user.*', 'user.submenu.*', 'layouts.user', 'user.navbar'], function ($view) {
            $menus = Menu::with('submenus')->get()->groupBy('url');
            $kategoris = KategoriStatistik::all();
            $jabatans = Jabatan::all();
            $jenisPpids = JenisPPID::all();
            $beritas = Berita::orderBy('tanggal', 'desc')->get();
            $galeris = Galeri::orderBy('tanggal', 'desc')->get();
            $view->with(compact('menus', 'kategoris', 'jabatans', 'jenisPpids', 'beritas', 'galeris'));
        });

        // Untuk sidebar admin
        View::composer('admin.sidebar', function ($view) {
            $menus = Menu::with('submenus')
                        ->orderBy('id_menu', 'asc')
                        ->get();
            $kategoris = KategoriStatistik::all();
            $jenisPpids = JenisPPID::all();
            $rws = Rw::all();
            $jabatans = Jabatan::all();
            $beritas = Berita::orderBy('tanggal', 'desc')->take(5)->get();
            $galeris = Galeri::orderBy('tanggal', 'desc')->take(5)->get();
            $view->with(compact('menus', 'kategoris', 'jenisPpids','rws','jabatans', 'beritas', 'galeris'));
        });    
    }
}