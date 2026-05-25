@extends('layouts.admin')

@section('title', 'Tambah Judul PPID')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    {{-- BREADCRUMB --}}
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <div>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('jenis-ppid.index') }}" class="text-[#0D4715] fw-semibold text-decoration-none">
                        <i class="bi bi-arrow-left-circle me-1"></i> Jenis PPID
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('judul-ppid.index', $jenis->id_jenis_ppid) }}" 
                       class="text-[#0D4715] fw-semibold text-decoration-none">
                        {{ $jenis->nama_jenis_ppid }}
                    </a>
                </li>
                <li class="breadcrumb-item active text-muted" aria-current="page">
                    Tambah Judul PPID
                </li>
            </ol>
        </div>
    </div>

    <h2 class="text-[#0D4715] text-2xl font-bold mb-4">Tambah Judul PPID untuk {{ $jenis->nama_jenis_ppid }}</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form method="POST" action="{{ route('judul-ppid.store') }}">
        @csrf
        <input type="hidden" name="id_jenis_ppid" value="{{ $jenis->id_jenis_ppid }}">

        <div class="mb-4">
            <label class="form-label fw-bold">Judul PPID</label>
            <input type="text" name="judul" class="form-control" required>
        </div>

        <div class="mb-4">
            <label class="form-label fw-bold">Jenis PPID</label>
            <input type="text" class="form-control" value="{{ $jenis->nama_jenis_ppid }}" disabled>
        </div>

        <button type="submit" class="btn btn-success">Simpan Judul PPID</button>
        <a href="{{ route('judul-ppid.index', $jenis->id_jenis_ppid) }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
