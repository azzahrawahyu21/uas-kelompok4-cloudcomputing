@extends('layouts.admin')

@section('title', 'Edit Jabatan')

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
                <li class="breadcrumb-item active text-muted" aria-current="page">Edit Jabatan</li>
            </ol>
        </div>
    </div>

    {{-- Judul --}}
    <h2 class="text-[#0D4715] text-center text-2xl font-bold mb-4">Edit Jabatan: {{ $jabatan->nama_jabatan }}</h2>

    {{-- Pesan error --}}
    @if ($errors->any())
        <div class="alert alert-danger text-center">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Edit Jabatan --}}
    <form action="{{ route('jabatan.update', $jabatan->id_jabatan) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Input Nama Jabatan --}}
        <div class="mb-3">
            <label for="nama_jabatan" class="form-label fw-semibold">Nama Jabatan</label>
            <input
                type="text"
                name="nama_jabatan"
                id="nama_jabatan"
                class="form-control w-100"
                value="{{ old('nama_jabatan', $jabatan->nama_jabatan) }}"
                required
            >
        </div>

        {{-- Input Tipe --}}
        <div class="mb-3">
            <label for="tipe" class="form-label fw-semibold">Pilih Tipe</label>
            <select name="tipe" id="tipe" class="form-select w-100" required>
                <option value="tunggal" {{ old('tipe', $jabatan->tipe) == 'tunggal' ? 'selected' : '' }}>Tunggal</option>
                <option value="multi" {{ old('tipe', $jabatan->tipe) == 'multi' ? 'selected' : '' }}>Multi</option>
            </select>
        </div>

        {{-- Tombol --}}
        <div class="text-end mt-4">
            <a href="{{ route('jabatan.index') }}" class="btn btn-secondary me-2">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <button type="submit" class="btn btn-success px-4">
                <i class="bi bi-save me-1"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection