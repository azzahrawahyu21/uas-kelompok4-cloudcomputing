<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Admin Panel')</title>

  @vite(['resources/css/user.css', 'resources/js/app.js'])
  {{-- Bootstrap & Tailwind --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  @stack('styles')
</head>
<body class="bg-gray-50">

<div class="fixed-top bg-white border-bottom" style="z-index:50;">
    <div class="container py-3 d-flex justify-content-between align-items-center">

        {{-- Logo (Left) --}}
        <a class="navbar-brand fw-bold text-dark d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('assets/img/navbar/logo 1.png') }}" alt="Logo Desa" width="40" class="me-2">
            <div class="d-flex flex-column">
                <span style="font-size: 0.95rem; font-weight: 600;">Desa Driyorejo</span>
                <small style="font-size: 0.75rem; font-weight: 400; color: #555;">
                    Kec. Driyorejo Kab. Magetan
                </small>
            </div>
        </a>

        {{-- Breadcrumb (Center) --}}
        <nav class="d-none d-lg-flex flex-grow-1 justify-content-center">
            <ol class="breadcrumb mb-0 bg-transparent px-0 py-1" style="--bs-breadcrumb-divider: ''; gap: 25px;">
                
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ route('user.dashboard') }}">
                        Beranda
                    </a>
                </li>
                {{-- MENU DINAMIS BERDASARKAN KATEGORI --}}
                @php
                    $groupedMenus = $menus ?? Menu::with('submenus')->get()->groupBy('url');
                @endphp

                {{-- PROFIL DESA - Dropdown Otomatis --}}
                @if(isset($groupedMenus['profil_desa']) && $groupedMenus['profil_desa']->count() > 0)
                    <li class="nav-item dropdown">
                        <a class="nav-link text-dark d-flex align-items-center" href="#" data-bs-toggle="dropdown">
                            <span>Profil Desa</span>
                            <i class="bi bi-chevron-down ms-2" style="font-size: 0.85rem;"></i>
                        </a>
                        <ul class="dropdown-menu mt-2">
                            @foreach($groupedMenus['profil_desa'] as $menu)
                                <li>
                                    <a class="dropdown-item" href="{{ route('user.menu.show', [
                                        'kategori' => $menu->url,
                                        'menuSlug' => Str::slug($menu->nama_menu)
                                    ]) }}">
                                        {{ $menu->nama_menu }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif

                {{-- DATA STATISTIK --}}
                @if(isset($kategoris) && $kategoris->count())
                <li class="nav-item dropdown">
                    <a class="nav-link text-dark d-flex align-items-center" 
                    href="#" data-bs-toggle="dropdown">
                        <span>Data Statistik</span>
                        <i class="bi bi-chevron-down ms-2" style="font-size: 0.85rem; margin-top: 4px;"></i>
                    </a>
                    <ul class="dropdown-menu mt-2">
                        @foreach($kategoris as $kategori)
                        <li>
                            <a class="dropdown-item"
                            href="{{ route('user.statistik.kategori', $kategori->id_kategori) }}">
                                {{ $kategori->nama_kategori }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                @endif


                {{-- STRUKTUR ORGANISASI --}}
                <li class="nav-item">
                    <a class="nav-link text-dark"
                    href="{{ route('user.struktur.semua') }}">
                        Struktur Organisasi
                    </a>
                </li>

                {{-- PPID --}}
                <li class="nav-item">
                    <a class="nav-link text-dark"
                    href="{{ route('user.ppid.index') }}">
                        PPID
                    </a>
                </li>

                {{-- MEDIA --}}
                <li class="nav-item dropdown">
                    <a class="nav-link text-dark d-flex align-items-center" href="#" data-bs-toggle="dropdown">
                        <span>Media</span>
                        <i class="bi bi-chevron-down ms-2" style="font-size: 0.85rem; margin-top: 4px;"></i>
                    </a>
                    <ul class="dropdown-menu mt-2">
                        <li><a class="dropdown-item" href="{{ route('user.berita.index') }}">Berita</a></li>
                        <li><a class="dropdown-item" href="{{ route('user.galeri.index') }}">Galeri</a></li>
                    </ul>
                </li>
            </ol>
        </nav>

        {{-- Login Button (Right) --}}
        <a class="btn btn-success px-4" href="{{ route('login') }}"
            style="border-radius: 20px; background-color:#0D4715; border:none;">
            Login
        </a>

        {{-- MOBILE BUTTON --}}
        <button class="btn d-lg-none" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu">
            <i class="bi bi-list" style="font-size:1.8rem;"></i>
        </button>

    </div>
</div>

<div class="fixed-top bg-white border-bottom" style="z-index:50;">
    <div class="container py-3 d-flex justify-content-between align-items-center">

        {{-- Logo (Left) --}}
        <a class="navbar-brand fw-bold text-dark d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('assets/img/navbar/logo 1.png') }}" alt="Logo Desa" width="40" class="me-2">
            <div class="d-flex flex-column">
                <span style="font-size: 0.95rem; font-weight: 600;">Desa Driyorejo</span>
                <small style="font-size: 0.75rem; color:#555;">Kec. Driyorejo Kab. Magetan</small>
            </div>
        </a>

        {{-- DESKTOP MENU --}}
        <nav class="d-none d-lg-flex flex-grow-1 justify-content-center">
            <ol class="breadcrumb mb-0 bg-transparent px-0 py-1" style="--bs-breadcrumb-divider: ''; gap:25px;">

                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ route('user.dashboard') }}">Beranda</a>
                </li>

                @php
                    $groupedMenus = $menus ?? Menu::with('submenus')->get()->groupBy('url');
                @endphp

                {{-- PROFIL DESA --}}
                @if(isset($groupedMenus['profil_desa']) && $groupedMenus['profil_desa']->count() > 0)
                <li class="nav-item dropdown">
                    <a class="nav-link text-dark d-flex align-items-center" href="#" data-bs-toggle="dropdown">
                        Profil Desa <i class="bi bi-chevron-down ms-2"></i>
                    </a>
                    <ul class="dropdown-menu mt-2">
                        @foreach($groupedMenus['profil_desa'] as $menu)
                        <li>
                            <a class="dropdown-item" href="{{ route('user.menu.show', [
                                'kategori' => $menu->url,
                                'menuSlug' => Str::slug($menu->nama_menu)
                            ]) }}">{{ $menu->nama_menu }}</a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                @endif

                {{-- DATA STATISTIK --}}
                @if(isset($kategoris) && $kategoris->count())
                <li class="nav-item dropdown">
                    <a class="nav-link text-dark d-flex align-items-center" href="#" data-bs-toggle="dropdown">
                        Data Statistik <i class="bi bi-chevron-down ms-2"></i>
                    </a>
                    <ul class="dropdown-menu mt-2">
                        @foreach($kategoris as $kategori)
                        <li>
                            <a class="dropdown-item" 
                                href="{{ route('user.statistik.kategori', $kategori->id_kategori) }}">
                                {{ $kategori->nama_kategori }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                @endif

                <li class="nav-item"><a class="nav-link text-dark" href="{{ route('user.struktur.semua') }}">Struktur Organisasi</a></li>
                <li class="nav-item"><a class="nav-link text-dark" href="{{ route('user.ppid.index') }}">PPID</a></li>

                <li class="nav-item dropdown">
                    <a class="nav-link text-dark d-flex align-items-center" href="#" data-bs-toggle="dropdown">
                        Media <i class="bi bi-chevron-down ms-2"></i>
                    </a>
                    <ul class="dropdown-menu mt-2">
                        <li><a class="dropdown-item" href="{{ route('user.berita.index') }}">Berita</a></li>
                        <li><a class="dropdown-item" href="{{ route('user.galeri.index') }}">Galeri</a></li>
                    </ul>
                </li>

            </ol>
        </nav>

        {{-- LOGIN (Desktop) --}}
        <a class="btn btn-success px-4 d-none d-lg-block" href="{{ route('login') }}" 
           style="border-radius: 20px; background-color:#0D4715; border:none;">
            Login
        </a>

        {{-- MOBILE BUTTON --}}
        <button class="btn d-lg-none" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu">
            <i class="bi bi-list" style="font-size:1.8rem;"></i>
        </button>

    </div>
</div>

{{-- MOBILE OFFCANVAS MENU --}}
<div class="offcanvas offcanvas-end" tabindex="-1" id="mobileMenu">
    <div class="offcanvas-header">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="offcanvas-body">

        <a class="d-block mb-3" href="{{ route('user.dashboard') }}"><b>Beranda</b></a>

        {{-- Profil Desa --}}
        @if(isset($groupedMenus['profil_desa']) && $groupedMenus['profil_desa']->count())
        <div class="mb-3">
            <strong>Profil Desa</strong>
            <ul class="list-unstyled ms-3 mt-1">
                @foreach($groupedMenus['profil_desa'] as $menu)
                <li>
                    <a href="{{ route('user.menu.show', [
                        'kategori' => $menu->url,
                        'menuSlug' => Str::slug($menu->nama_menu)
                    ]) }}">{{ $menu->nama_menu }}</a>
                </li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Data Statistik --}}
        @if(isset($kategoris) && $kategoris->count())
        <div class="mb-3">
            <strong>Data Statistik</strong>
            <ul class="list-unstyled ms-3 mt-1">
                @foreach($kategoris as $kategori)
                <li><a href="{{ route('user.statistik.kategori', $kategori->id_kategori) }}">{{ $kategori->nama_kategori }}</a></li>
                @endforeach
            </ul>
        </div>
        @endif

        <a class="d-block mb-3" href="{{ route('user.struktur.semua') }}"><b>Struktur Organisasi</b></a>
        <a class="d-block mb-3" href="{{ route('user.ppid.index') }}"><b>PPID</b></a>

        <div class="mb-3">
            <strong>Media</strong>
            <ul class="list-unstyled ms-3 mt-1">
                <li><a href="{{ route('user.berita.index') }}">Berita</a></li>
                <li><a href="{{ route('user.galeri.index') }}">Galeri</a></li>
            </ul>
        </div>

        <a class="btn w-100 mt-4" style="background-color: #0D4715; color: #ffffff" href="{{ route('login') }}">Login</a>

    </div>
</div>

  {{-- Konten Utama --}}
  <main class="p-6 main-content">
    @yield('content')
  </main>

  @include('user.footer')

<style>
    .main-content {
        margin-top: 5% !important;
        padding: 0 !important;
    }
</style>

  @stack('scripts')
</body>
</html>
