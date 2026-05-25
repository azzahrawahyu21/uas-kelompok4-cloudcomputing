@extends('layouts.admin')

@section('title', 'Detail Berita')

@section('content')
<div class="container">

    {{-- Breadcrumb --}}
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <div>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('berita.index') }}" class="text-[#0D4715] fw-semibold text-decoration-none">
                        <i class="bi bi-arrow-left-circle me-1"></i> Daftar Berita
                    </a>
                </li>
                <li class="breadcrumb-item active text-muted" aria-current="page">Detail Berita</li>
            </ol>
        </div>
    </div>

    <div class="bg-white p-4 rounded shadow-sm border">
        {{-- Tanggal --}}
        <p class="text-muted mb-3">
            <i class="bi bi-calendar-event"></i>
            {{ \Carbon\Carbon::parse($berita->tanggal)->format('d M Y') }}
        </p>

        {{-- Judul --}}
        <h2 class="fw-bold mb-3 text-center">{{ $berita->judul }}</h2>

        {{-- Gambar --}}
        @if($berita->foto)
            <div class="mb-4 text-center">
                <img 
                    src="{{ asset('ufiles/' . $berita->foto) }}" 
                    alt="Gambar Berita" 
                    class="img-fluid rounded d-block mx-auto" 
                    style="max-height: 400px; object-fit: cover;">
            </div>
        @endif

        {{-- Isi Berita --}}
        <div class="ck-content">
            {!! $berita->isi !!}
        </div>

        <div class="text-end mt-4">
            <a href="{{ route('berita.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

</div>
@endsection
