{{-- resources/views/admin/ppid/editJudulPpid.blade.php --}}
@extends('layouts.admin')

@section('title', 'Edit Judul PPID')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">

    {{-- Breadcrumb --}}
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <div>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('jenis-ppid.index') }}" class="text-[#0D4715] fw-semibold text-decoration-none">
                        Jenis PPID
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('judul-ppid.index', $judul->id_jenis_ppid) }}" class="text-[#0D4715] fw-semibold text-decoration-none">
                        Daftar Judul
                    </a>
                </li>
                <li class="breadcrumb-item active text-muted" aria-current="page">Edit Judul</li>
            </ol>
        </div>
    </div>

    <h2 class="text-[#0D4715] text-center text-2xl font-bold mb-4">
        Edit Judul PPID - {{ $jenis->nama_jenis_ppid }}
    </h2>

    @if($errors->any())
        <div class="alert alert-danger text-center">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <form action="{{ route('judul-ppid.update', $judul->id_judul) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="judul" class="form-label fw-semibold">Judul PPID</label>
            <input type="text" name="judul" id="judul" class="form-control w-100"
                   value="{{ old('judul', $judul->judul) }}" required>
        </div>

        <div class="text-end mt-4">
            <button type="submit" class="btn btn-success px-4">
                Simpan Perubahan
            </button>
            <a href="{{ route('judul-ppid.index', $judul->id_jenis_ppid) }}" 
               class="btn btn-secondary px-4 ms-2">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection