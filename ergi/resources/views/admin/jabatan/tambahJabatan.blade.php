@extends('layouts.admin')

@section('title', 'Tambah Jabatan')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    {{-- Breadcrumb --}}
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <div>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
            <a href="{{ route('jabatan.index') }}" class="text-[#0D4715] fw-semibold text-decoration-none">
                <i class="bi bi-arrow-left-circle me-1"></i> Daftar Jabatan
            </a>
            </li>
            </li>
            <li class="breadcrumb-item active text-muted" aria-current="page">Tambah Jabatan</li>
        </ol>
        </div>
    </div>

    {{-- Judul --}}
    <h2 class="text-[#0D4715] text-center text-2xl font-bold mb-4">Tambah Jabatan Baru</h2>

    {{-- Pesan sukses/error --}}
    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif

    {{-- Form Tambah Jabatan --}}
    <form action="{{ route('jabatan.store') }}" method="POST">
        @csrf

        {{-- Input Nama Jabatan --}}
        <div class="mb-3">
        <label for="nama_jabatan" class="form-label fw-semibold">Nama Jabatan</label>
        <input
            type="text"
            name="nama_jabatan"
            id="nama_jabatan"
            class="form-control w-100"
            placeholder="Masukkan nama jabatan baru"
            required
        >
        </div>

        {{-- Input Tipe --}}
        <div class="mb-3">
        <label for="tipe" class="form-label fw-semibold">Pilih Tipe</label>
        <select name="tipe" id="tipe" class="form-select w-100" required>
            <option value="" disabled selected>-- Pilih Tipe --</option>
            <option value="tunggal">Tunggal</option>
            <option value="multi">Multi</option>
        </select>
        </div>

        {{-- Tombol --}}
        <div class="text-end mt-4">
        <button type="submit" class="btn btn-success px-4">
            <i class="bi bi-save me-1"></i>Simpan Jabatan
        </button>
        </div>
    </form>
</div>
@endsection
