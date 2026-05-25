<style>
  .sidebar {
    width: 260px;
    height: 100vh;
    background-color: #0D4715;
    color: white;
    position: fixed;
    top: 0;
    left: 0;
    padding-top: 80px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    box-shadow: 5px 0 15px rgba(0,0,0,0.1);
    z-index: 40;
    overflow-y: auto;
    max-height: 100vh;
  }
</style>
<nav class="navbar navbar-expand-lg fixed-top bg-[#0D4715] py-3 shadow-md">
  <div class="container-fluid px-4 d-flex justify-content-between align-items-center text-white">
    <button id="toggleSidebar" class="btn text-white d-lg-none me-2 fs-4 border-0">
      <i class="bi bi-list"></i>
    </button>
    <a class="navbar-brand text-white fw-bold d-flex align-items-center gap-2" href="#">
      <img src="{{ asset('assets/img/navbar/logo 1.png') }}" alt="Logo Desa" width="40" class="rounded">
      <div class="d-flex flex-column lh-sm">
        <span class="fw-semibold" style="font-size: 0.95rem; color: white;">Desa Driyorejo</span>
        <small class="text-white-50" style="font-size: 0.75rem;">Kec. Driyorejo Kab. Magetan</small>
      </div>
    </a>
    <div class="d-flex align-items-center gap-4">
      <a href="javascript:void(0)" id="profileIcon" class="text-light d-flex align-items-center" style="font-size:2rem; text-decoration:none;" title="Profil Saya">
        <i class="bi bi-person-circle" style="transition:0.3s; cursor:pointer;"></i>
      </a>
      <form method="POST" action="{{ route('logout') }}" class="m-0">
        @csrf
        <button type="submit" class="btn btn-light rounded-pill px-4 py-2 fw-semibold text-[#0D4715]">
          <i class="bi bi-box-arrow-right me-1"></i> Logout
        </button>
      </form>
    </div>
  </div>
</nav>

<div id="profileOverlay" class="profile-overlay">
    <div class="overlay-content shadow">
        <h6 style="text-align:center; font-weight:bold; color:#0D4715;">Profil Akun</h6>
        <hr style="margin:8px 0;">
        <form id="updateProfileForm" method="POST" action="{{ route('profile.update') }}">
            @csrf
            <label>Email</label>
            <p>{{ auth()->user()->email ?? 'Tidak tersedia' }}</p>
            <label>Nama Pengguna</label>
            <input type="text" name="nama_pengguna" value="{{ auth()->user()->nama_pengguna ?? '' }}" required>
            <label>Password</label>
            <input type="password" name="kata_sandi" placeholder="Masukkan password baru">
            <label>Konfirmasi Password</label>
            <input type="password" name="kata_sandi_confirmation" placeholder="Konfirmasi password baru">
            <div style="text-align:right; margin-top:10px;">
                <button type="button" class="btn btn-secondary" id="closeProfileOverlay">Batal</button>
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Sidebar Admin -->
<aside id="sidebar" class="sidebar transition-transform duration-300 -translate-x-full lg:translate-x-0">
  <div>
    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
      <i class="bi bi-speedometer2 me-2"></i> Dashboard
    </a>

    <hr class="opacity-30 mx-3">

    <!-- Tombol dropdown Kelola Menu -->
    <button class="dropdown-toggle-btn w-100 text-start px-4 py-2 border-0 bg-transparent text-white fw-semibold">
      <i class="bi bi-journal-text me-2"></i> Profil Desa
      <i class="bi bi-chevron-down float-end"></i>
    </button>

    <!-- Isi dropdown menu dinamis -->
    <div id="menuDropdown" class="dropdown-content">
      <a href="{{ route('menu.index') }}" class="ps-5 {{ request()->routeIs('menu.index') ? 'active' : '' }}">
        <i class="bi bi-list-check me-2"></i> Daftar Profil
      </a>

      @if($menus->isNotEmpty())
        @foreach($menus as $menu)
          <a href="{{ route('submenu.index', $menu->id_menu) }}" 
            class="ps-5 {{ request()->is('admin/menu/'.$menu->id_menu.'/submenu') ? 'active' : '' }}">
            <i class="bi bi-folder2-open me-2"></i> {{ ucfirst($menu->nama_menu) }}
          </a>
        @endforeach
      @else
        <p class="text-sm text-gray-300,300 px-5 mt-2 italic">Belum ada Profil Desa.</p>
      @endif
    </div>

    <!--Tombol Data Statistik -->
    <button class="dropdown-toggle-btn w-100 text-start px-4 py-2 border-0 bg-transparent text-white fw-semibold">
      <i class="bi bi-journal-text me-2"></i> Data Statistik
      <i class="bi bi-chevron-down float-end"></i>
    </button>

    <div id="StatistikDropdown" class="dropdown-content">
      <a href="{{ route('kategori-statistik.index') }}" class="ps-5 {{ request()->routeIs('kategori-statistik.index') ? 'active' : '' }}">
      <i class="bi bi-list-check me-2"></i> Daftar Statistik
    </a>

    @if(isset($kategoris) && $kategoris->isNotEmpty())
      @foreach($kategoris as $kategori)
        <a href="{{ route('subkategori-statistik.index', $kategori->id_kategori) }}" class="ps-5 {{ request()->routeIs('subkategori-statistik.index') && request()->segment(3) == $kategori->id_kategori ? 'active' : '' }}">
          <i class="bi bi-folder2-open me-2"></i> {{ ucfirst($kategori->nama_kategori) }}
        </a>
      @endforeach
    @else
      <p class="text-sm text-gray-300 px-5 mt-2 italic">Belum data statistik.</p>
    @endif
    </div>

    <!--Tombol PPID -->
    <button class="dropdown-toggle-btn w-100 text-start px-4 py-2 border-0 bg-transparent text-white fw-semibold">
      <i class="bi bi-journal-text me-2"></i> PPID
      <i class="bi bi-chevron-down float-end"></i>
    </button>

    <div id="PpidDropdown" class="dropdown-content">
      <a href="{{ route('jenis-ppid.index') }}" class="ps-5 {{ request()->routeIs('jenis-ppid.index') ? 'active' : '' }}">
      <i class="bi bi-list-check me-2"></i> Daftar Jenis PPID
    </a>
  
    @if(isset($jenisPpids) && $jenisPpids->isNotEmpty())
    @foreach($jenisPpids as $jenis)
      <a href="{{ route('judul-ppid.index', $jenis->id_jenis_ppid) }}" class="ps-5 {{ request()->routeIs('judul-ppid.index') && request()->segment(3) == $jenis->id_jenis_ppid ? 'active' : '' }}">
        <i class="bi bi-folder2-open me-2"></i> {{ ucfirst($jenis->nama_jenis_ppid) }}
      </a>
    @endforeach
    @else
      <p class="text-sm text-gray-300 px-5 mt-2 italic">Belum ada PPID</p>
    @endif
    </div>

    <!-- RT/RW -->
    {{-- <button class="dropdown-toggle-btn w-100 text-start px-4 py-2 border-0 bg-transparent text-white fw-semibold">
      <i class="bi bi-journal-text me-2"></i> Data RT/RW
      <i class="bi bi-chevron-down float-end"></i>
    </button>

    <div id="rtRwDropdown" class="dropdown-content">
      <a href="{{ route('rw.index') }}" class="ps-5 {{ request()->routeIs('rw.index') ? 'active' : '' }}">
        <i class="bi bi-list-check me-2"></i> Daftar RW
      </a>

      @if(isset($rws) && $rws->isNotEmpty())
        @foreach($rws as $rw)
          <a href="{{ route('rt.index', $rw->id_rw) }}" class="ps-5 {{ request()->routeIs('rt.index') && request()->segment(3) == $rw->id_rw ? 'active' : '' }}">
            <i class="bi bi-folder2-open me-2"></i> RW {{ ucfirst($rw->no_rw) }}
          </a>
        @endforeach
      @else
        <p class="text-sm text-gray-300 px-5 mt-2 italic">Belum ada data RW.</p>
      @endif
    </div> --}}

    {{-- jabatan --}}
    <button class="dropdown-toggle-btn w-100 text-start px-4 py-2 border-0 bg-transparent text-white fw-semibold">
      <i class="bi bi-journal-text me-2"></i> Struktur Organisasi
      <i class="bi bi-chevron-down float-end"></i>
    </button>

    <!-- Isi dropdown jabatan dinamis -->
    <div id="jabatanDropdown" class="dropdown-content">
      <a href="{{ route('jabatan.index') }}" class="ps-5 {{ request()->routeIs('jabatan.index') ? 'active' : '' }}">
        <i class="bi bi-list-check me-2"></i> Daftar Jabatan
      </a>

      @if($jabatans->isNotEmpty())
        @foreach($jabatans as $jabatan)
          <a href="{{ route('subjabatan.index', $jabatan->id_jabatan) }}" 
            class="ps-5 {{ request()->is('admin/jabatan/'.$jabatan->id_jabatan.'/subjabatan') ? 'active' : '' }}">
            <i class="bi bi-folder2-open me-2"></i> {{ ucfirst($jabatan->nama_jabatan) }}
          </a>
        @endforeach
      @else
        <p class="text-sm text-gray-300,300 px-5 mt-2 italic">Belum ada jabatan.</p>
      @endif
    </div>

    {{-- berita --}}
    <a href="{{ route('berita.index') }}" 
      class="dropdown-toggle-btn w-100 text-start px-4 py-2 border-0 bg-transparent text-white fw-semibold d-block">
      <i class="bi bi-journal-text me-2"></i> Berita
    </a>

    {{-- galeri --}}
    <a href="{{ route('galeri.index') }}" 
      class="dropdown-toggle-btn w-100 text-start px-4 py-2 border-0 bg-transparent text-white fw-semibold d-block">
      <i class="bi bi-journal-text me-2"></i> Galeri
    </a>

    {{-- <hr class="opacity-30 mx-3"> --}}
  </div>

  {{-- <div class="bottom">
    <a href="{{ route('menu.create') }}" class="add-menu-btn">
      <i class="bi bi-plus-circle me-2"></i> Tambah Menu
    </a>
  </div> --}}
</aside>

<style>
  .sidebar {
    width: 260px;
    height: 100vh;
    background-color: #0D4715;
    color: white;
    position: fixed;
    top: 0;
    left: 0;
    padding-top: 80px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    box-shadow: 5px 0 15px rgba(0,0,0,0.1);
    z-index: 40;
  }

  .sidebar a {
    display: block;
    padding: 10px 20px;
    color: white;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s;
  }

  .sidebar a:hover, .sidebar a.active {
    background-color: #166534;
    padding-left: 28px;
  }

  .dropdown-toggle-btn {
    cursor: pointer;
    transition: all 0.3s;
  }

  .dropdown-toggle-btn:hover {
    background-color: #166534;
  }

  .dropdown-content {
    display: none;
    flex-direction: column;
    background-color: rgba(255, 255, 255, 0.05);
  }

  .dropdown-content a {
    padding: 8px 24px;
    font-size: 0.9rem;
  }

  .dropdown-content.show {
    display: flex;
  }

  .sidebar .bottom {
    padding: 20px;
    border-top: 1px solid rgba(255,255,255,0.2);
  }

  .sidebar .add-menu-btn {
    background-color: #f97316;
    color: #fff;
    display: block;
    text-align: center;
    padding: 10px;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s;
  }

  .sidebar .add-menu-btn:hover {
    background-color: #fb923c;
    transform: scale(1.05);
  }

  /* Responsif */
  @media (max-width: 1024px) {
    .sidebar {
      transform: translateX(-100%);
    }
    .sidebar.show {
      transform: translateX(0);
    }
  }

  input[type="text"],
  input[type="email"],
  input[type="password"],
  select {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 6px;
      box-sizing: border-box;
  }

  input:disabled {
      background-color: #e0e0e0;
      cursor: not-allowed;
  }

  .profile-overlay, .edit-user-overlay {
      display: none;
      position: fixed;
      z-index: 1050;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0,0,0,0.3);
      backdrop-filter: blur(3px);
      justify-content: center;
      align-items: center;
  }

  .profile-overlay.show, .edit-user-overlay.show {
      display: flex;
      animation: fadeIn 0.3s ease;
  }

  .overlay-content {
      background: #fff;
      padding: 20px;
      border-radius: 12px;
      width: 320px;
      max-width: 90%;
      box-shadow: 0 4px 15px rgba(0,0,0,0.2);
  }

  .overlay-content input, .overlay-content select {
      width: 100%;
      padding: 8px;
      margin-bottom: 8px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 0.9rem;
  }

  .overlay-content input:disabled {
      background-color: #e0e0e0;
      cursor: not-allowed;
  }

  .overlay-content button {
      padding: 6px 12px;
      border-radius: 6px;
      font-size: 0.9rem;
      cursor: pointer;
  }

  @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.95); }
      to { opacity: 1; transform: scale(1); }
  }

</style>

<script>
  const toggleBtn = document.getElementById('toggleSidebar');
  const sidebar = document.getElementById('sidebar');

  // Toggle sidebar (untuk layar kecil)
  toggleBtn.addEventListener('click', () => {
    sidebar.classList.toggle('show');
  });

  // Ambil semua tombol dropdown
  const dropdownButtons = document.querySelectorAll('.dropdown-toggle-btn');

  dropdownButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      const dropdownContent = btn.nextElementSibling;
      dropdownContent.classList.toggle('show');
      const icon = btn.querySelector('.bi-chevron-down');
      icon.classList.toggle('rotate');
    });
  });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
      const profileIcon = document.getElementById("profileIcon");
      const profileOverlay = document.getElementById("profileOverlay");
      const closeProfileOverlay = document.getElementById("closeProfileOverlay");

      profileIcon.addEventListener("click", () => {
          profileOverlay.classList.add("show");
      });

      closeProfileOverlay.addEventListener("click", () => {
          profileOverlay.classList.remove("show");
      });

      // klik luar untuk menutup
      document.addEventListener("click", (e) => {
          if (!profileOverlay.contains(e.target) && !profileIcon.contains(e.target)) {
              profileOverlay.classList.remove("show");
          }
      });
  });
</script>
