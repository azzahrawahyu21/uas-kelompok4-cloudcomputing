@extends('layouts.admin')

@section('title', 'Tambah Kategori Statistik')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">

  {{-- Breadcrumb --}}
  <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
    <div>
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item">
          <a href="{{ route('kategori-statistik.index') }}" class="text-[#0D4715] fw-semibold text-decoration-none">
            <i class="bi bi-arrow-left-circle me-1"></i> Daftar Kategori Statistik
          </a>
        </li>
        <li class="breadcrumb-item active text-muted" aria-current="page">Tambah Kategori</li>
      </ol>
    </div>
  </div>

  {{-- Judul --}}
  <h2 class="text-[#0D4715] text-center text-2xl font-bold mb-4">Tambah Kategori Statistik Baru</h2>

  {{-- Pesan sukses/error --}}
  @if(session('success'))
    <div class="alert alert-success text-center">{{ session('success') }}</div>
  @elseif(session('error'))
    <div class="alert alert-danger text-center">{{ session('error') }}</div>
  @endif

  {{-- Form Tambah Kategori Statistik --}}
  <form action="{{ route('kategori-statistik.store') }}" method="POST">
    @csrf

    {{-- Input Nama Kategori --}}
    <div class="mb-3">
      <label for="nama_kategori" class="form-label fw-semibold">Nama Kategori Statistik</label>
      <input
        type="text"
        name="nama_kategori"
        id="nama_kategori"
        class="form-control w-100"
        placeholder="Masukkan nama kategori statistik"
        value="{{ old('nama_kategori') }}"
        required
      >
      @error('nama_kategori')
        <small class="text-danger">{{ $message }}</small>
      @enderror
    </div>

    {{-- Tombol --}}
    <div class="text-end mt-4">
      <button type="submit" class="btn btn-success px-4">
        <i class="bi bi-save me-1"></i> Simpan Kategori
      </button>
      <a href="{{ route('kategori-statistik.index') }}" class="btn btn-secondary px-4 ms-2">
        <i class="bi bi-x-circle me-1"></i> Batal
      </a>
    </div>
  </form>

</div>
@endsection
