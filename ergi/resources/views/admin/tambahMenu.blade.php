@extends('layouts.admin')

@section('title', 'Tambah Profil Desa')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">

  {{-- Breadcrumb --}}
  <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
    <div>
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item">
          <a href="{{ route('menu.index') }}" class="text-[#0D4715] fw-semibold text-decoration-none">
            <i class="bi bi-arrow-left-circle me-1"></i> Daftar Profil Desa
          </a>
        </li>
        </li>
        <li class="breadcrumb-item active text-muted" aria-current="page">Tambah Profil Desa</li>
      </ol>
    </div>
  </div>

  {{-- Judul --}}
  <h2 class="text-[#0D4715] text-center text-2xl font-bold mb-4">Tambah Profil Desa Baru</h2>

  {{-- Pesan sukses/error --}}
  @if(session('success'))
    <div class="alert alert-success text-center">{{ session('success') }}</div>
  @elseif(session('error'))
    <div class="alert alert-danger text-center">{{ session('error') }}</div>
  @endif

  {{-- Form Tambah Menu --}}
  <form action="{{ route('menu.store') }}" method="POST">
    @csrf

    {{-- Input Nama Menu --}}
    <div class="mb-3">
      <label for="nama_menu" class="form-label fw-semibold">Nama Profil Desa</label>
      <input
        type="text"
        name="nama_menu"
        id="nama_menu"
        class="form-control w-100"
        placeholder="Masukkan profil desa baru"
        required
      >
    </div>

    {{-- Input Kategori --}}
    <div class="mb-3">
      <label for="url" class="form-label fw-semibold">Pilih Kategori</label>
      <select name="url" id="url" class="form-select w-100" required>
        <option value="" disabled selected>-- Pilih Kategori --</option>
        <option value="profil_desa">Profil Desa</option>
      </select>
    </div>

    {{-- Tombol --}}
    <div class="text-end mt-4">
      <button type="submit" class="btn btn-success px-4">
        <i class="bi bi-save me-1"></i>Simpan
      </button>
    </div>
  </form>

</div>
@endsection
