<nav class="navbar navbar-expand-lg navbar-light bg-white top-0 shadow position-absolute my-4 py-1 start-0 end-0 mx-5"
    style="z-index:1050; border-radius: 50px;">
  <div class="container">
    <!-- Logo -->
    <a class="navbar-brand fw-bold text-dark d-flex align-items-center" href="{{ url('/') }}">
      <img src="{{ asset('assets/img/navbar/logo 1.png') }}" alt="Logo Desa" width="40" class="me-2">
      <div class="d-flex flex-column">
        <span style="font-size: 0.95rem; font-weight: 600;">Desa Driyorejo</span>
        <small style="font-size: 0.75rem; font-weight: 400; color: #555;">
          Kec. Driyorejo Kab. Magetan
        </small>
      </div>
    </a>

    <!-- Toggle -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mx-auto">

        {{-- PROFIL DESA --}}
        @if(isset($menus['profil_desa']))
          <li class="nav-item dropdown">
            <a class="nav-link text-dark d-flex align-items-center" href="#" data-bs-toggle="dropdown">
              Profil Desa <i class="bi bi-chevron-down ms-2"></i>
            </a>
            <ul class="dropdown-menu">
              @foreach($menus['profil_desa'] as $menu)
                <li>
                  <a class="dropdown-item" href="{{ route('user.menu.show', [
                      'kategori' => $menu->url,
                      'menu' => Str::slug($menu->nama_menu)
                  ]) }}">
                    {{ $menu->nama_menu }}
                  </a>
                </li>
              @endforeach
            </ul>
          </li>
        @endif

        {{-- LEMBAGA --}}
        @if(isset($menus['lembaga']))
          <li class="nav-item dropdown">
            <a class="nav-link text-dark d-flex align-items-center" href="#" data-bs-toggle="dropdown">
              Lembaga <i class="bi bi-chevron-down ms-2"></i>
            </a>
            <ul class="dropdown-menu">
              @foreach($menus['lembaga'] as $menu)
                <li>
                  <a class="dropdown-item" href="{{ route('user.menu.show', [
                      'kategori' => $menu->url,
                      'menu' => Str::slug($menu->nama_menu)
                  ]) }}">
                    {{ $menu->nama_menu }}
                  </a>
                </li>
              @endforeach
            </ul>
          </li>
        @endif

        {{-- BERITA DESA --}}
        @if(isset($menus['berita_desa']))
          <li class="nav-item dropdown">
            <a class="nav-link text-dark d-flex align-items-center" href="#" data-bs-toggle="dropdown">
              Berita Desa <i class="bi bi-chevron-down ms-2"></i>
            </a>
            <ul class="dropdown-menu">
              @foreach($menus['berita_desa'] as $menu)
                <li>
                  <a class="dropdown-item" href="{{ route('user.menu.show', [
                      'kategori' => $menu->url,
                      'menu' => Str::slug($menu->nama_menu)
                  ]) }}">
                    {{ $menu->nama_menu }}
                  </a>
                </li>
              @endforeach
            </ul>
          </li>
        @endif

        {{-- GALERI --}}
        @if(isset($menus['galeri']))
          <li class="nav-item dropdown">
            <a class="nav-link text-dark d-flex align-items-center" href="#" data-bs-toggle="dropdown">
              Galeri <i class="bi bi-chevron-down ms-2"></i>
            </a>
            <ul class="dropdown-menu">
              @foreach($menus['galeri'] as $menu)
                <li>
                  <a class="dropdown-item" href="{{ route('user.menu.show', [
                      'kategori' => $menu->url,
                      'menu' => Str::slug($menu->nama_menu)
                  ]) }}">
                    {{ $menu->nama_menu }}
                  </a>
                </li>
              @endforeach
            </ul>
          </li>
        @endif

        {{-- DATA STATISTIK (diambil dari tabel kategori_statistik) --}}
        @if(isset($kategoris) && $kategoris->count())
          <li class="nav-item dropdown">
            <a class="nav-link text-dark d-flex align-items-center" href="#" data-bs-toggle="dropdown">
              Data Statistik <i class="bi bi-chevron-down ms-2"></i>
            </a>
            <ul class="dropdown-menu">
              @foreach($kategoris as $kategori)
                <li>
                  <a class="dropdown-item" href="{{ route('user.statistik.kategori', $kategori->id_kategori) }}">
                    {{ $kategori->nama_kategori }}
                  </a>
                </li>
              @endforeach
            </ul>
          </li>
        @endif

        {{-- STRUKTUR ORGANISASI --}}
        {{-- @if(isset($jabatans) && $jabatans->count())
          <li class="nav-item dropdown">
            <a class="nav-link text-dark d-flex align-items-center" href="#" data-bs-toggle="dropdown">
              Struktur Organisasi <i class="bi bi-chevron-down ms-2"></i>
            </a>
            <ul class="dropdown-menu">
              @foreach($jabatans as $jabatan)
                <li>
                  <a class="dropdown-item"
                    href="{{ route('user.struktur.show', $jabatan->id_jabatan) }}">
                    {{ $jabatan->nama_jabatan }}
                  </a>
                </li>
              @endforeach
            </ul>
          </li>
        @endif --}}
        <li class="nav-item">
          <a class="nav-link text-dark" href="{{ route('user.struktur.semua') }}">
              Struktur Organisasi
          </a>
        </li>

        {{-- PPID (diambil dari tabel Jenis PPID) --}}
        <li class="nav-item dropdown">
          <a class="nav-link text-dark d-flex align-items-center" href="{{ route('user.ppid.index') }}">
            PPID
          </a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link text-dark d-flex align-items-center" href="#" data-bs-toggle="dropdown">
            Media <i class="bi bi-chevron-down ms-2"></i>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('user.berita.index') }}">Berita</a></li>
            <li><a class="dropdown-item" href="{{ route('user.galeri.index') }}">Galeri</a></li>
          </ul>
        </li>
      </ul>

      <!-- Login -->
      <a class="btn btn-success ms-lg-2 px-4" href="{{ route('login') }}"
        style="border-radius: 20px; background-color:#0D4715; border:none;">
        Login
      </a>
    </div>
  </div>
</nav>