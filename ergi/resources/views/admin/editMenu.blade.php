@extends('layouts.admin')

@section('title', 'Edit Profil Desa')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">

  {{-- Breadcrumb --}}
  <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
    <div>
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item">
          <a href="{{ route('menu.index') }}" class="text-[#0D4715] fw-semibold text-decoration-none">
            <i class="bi bi-arrow-left-circle me-1"></i> Kelola Profil Desa
          </a>
        </li>
        <li class="breadcrumb-item active text-muted" aria-current="page">Edit Profil Desa</li>
      </ol>
    </div>
  </div>

  {{-- Form Edit Menu --}}
  <h2 class="text-[#0D4715] text-center text-2xl font-bold mb-4">Edit Profil Desa</h2>

  {{-- Pesan sukses/error --}}
  @if(session('success'))
    <div class="alert alert-success text-center">{{ session('success') }}</div>
  @elseif(session('error'))
    <div class="alert alert-danger text-center">{{ session('error') }}</div>
  @endif

  <form action="{{ route('menu.update', $menu->id_menu) }}" method="POST" class="w-100">
    @csrf
    @method('PUT')

    {{-- Nama Menu --}}
    <div class="mb-3">
      <label for="nama_menu" class="form-label fw-semibold">Nama Profil Desa</label>
      <input
        type="text"
        name="nama_menu"
        id="nama_menu"
        class="form-control w-100"
        placeholder="Masukkan nama menu"
        value="{{ old('nama_menu', $menu->nama_menu) }}"
        required
      >
    </div>

    {{-- Kategori --}}
    <div class="mb-3">
      <label for="url" class="form-label fw-semibold">Kategori</label>
      <select name="url" id="url" class="form-select w-100" required>
        <option value="" disabled>-- Pilih Kategori --</option>
        <option value="profil_desa" {{ $menu->url == 'profil_desa' ? 'selected' : '' }}>Profil Desa</option>
        {{-- <option value="data_statistik" {{ $menu->url == 'data_statistik' ? 'selected' : '' }}>Data Statistik</option>
        <option value="lembaga" {{ $menu->url == 'lembaga' ? 'selected' : '' }}>Lembaga</option>
        <option value="berita_desa" {{ $menu->url == 'berita_desa' ? 'selected' : '' }}>Berita Desa</option>
        <option value="galeri" {{ $menu->url == 'galeri' ? 'selected' : '' }}>Galeri</option> --}}
      </select>
    </div>

    {{-- Tombol Simpan --}}
    <div class="text-end mt-4">
      <button type="submit" class="btn btn-success px-4">
        <i class="bi bi-save me-1"></i> Simpan
      </button>
    </div>
  </form>
</div>
@endsection
