@extends('layouts.admin')

@section('title', 'Edit Subjabatan - ' . $jabatan->nama_jabatan)

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">

    {{-- Breadcrumb --}}
    <div class="d-flex align-items-center mb-4" style="gap: 0.5rem;">
        <a href="{{ route('jabatan.index') }}" class="text-[#0D4715] fw-semibold text-decoration-none">
            <i class="bi bi-arrow-left-circle me-1"></i> Daftar Jabatan
        </a>
        <span class="text-muted">/</span>
        <a href="{{ route('subjabatan.index', $jabatan->id_jabatan) }}" class="text-[#0D4715] fw-semibold text-decoration-none">
            Subjabatan
        </a>
        <span class="text-muted">/</span>
        <span class="text-muted">Edit: {{ $subJabatan->nama_sub }}</span>
    </div>

    <h2 class="text-2xl font-bold mb-4 text-[#0D4715]">
        Edit Subjabatan untuk: {{ $jabatan->nama_jabatan }}
    </h2>

    {{-- Pesan Error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('subjabatan.update', [$jabatan->id_jabatan, $subJabatan->id_sub]) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Nama Subjabatan --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Nama Subjabatan</label>
            <input type="text" name="nama_sub" class="form-control" value="{{ old('nama_sub', $subJabatan->nama_sub) }}" required>
        </div>

        {{-- Parent ID / Subjabatan Induk --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Induk (Parent Sub)</label>

            <select name="parent_id" class="form-select">
                <option value="">— Tidak Ada (Root) —</option>
                @foreach ($subJabatan->jabatan->subJabatan as $sub)
                    @if($sub->id_sub != $subJabatan->id_sub) {{-- Jangan pilih diri sendiri --}}
                        <option value="{{ $sub->id_sub }}" {{ old('parent_id', $subJabatan->parent_id) == $sub->id_sub ? 'selected' : '' }}>
                            {{ $sub->nama_sub }}
                        </option>
                    @endif
                @endforeach
            </select>

            <small class="text-muted">
                *Jika ini adalah RW → tidak pilih parent.  
                *Jika RT → pilih parent RW-nya.
            </small>
        </div>

        {{-- Tombol --}}
        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('subjabatan.index', $jabatan->id_jabatan) }}" class="btn btn-secondary">
                Kembali
            </a>

            <button type="submit" class="btn btn-success">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
