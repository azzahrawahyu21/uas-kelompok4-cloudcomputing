@extends('layouts.admin')

@section('title', 'Detail Gelari')

@section('content')
<div class="container">

    {{-- Breadcrumb --}}
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <div>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('galeri.index') }}" class="text-[#0D4715] fw-semibold text-decoration-none">
                        <i class="bi bi-arrow-left-circle me-1"></i> Daftar Galeri
                    </a>
                </li>
                <li class="breadcrumb-item active text-muted" aria-current="page">Detail Galeri</li>
            </ol>
        </div>
    </div>

    <div class="bg-white p-4 rounded shadow-sm border">
        {{-- Tanggal --}}
        <p class="text-muted mb-3">
            <i class="bi bi-calendar-event"></i>
            {{ \Carbon\Carbon::parse($galeri->tanggal)->format('d M Y') }}
        </p>

        {{-- Judul --}}
        <h2 class="fw-bold mb-3 text-center">{{ $galeri->judul }}</h2>

        {{-- Gambar --}}
        @if($galeri->foto)
            <div class="mb-4 text-center">
                <img 
                    src="{{ asset('ufiles/' . $galeri->foto) }}" 
                    alt="Gambar galeri" 
                    class="img-fluid rounded d-block mx-auto" 
                    style="max-height: 400px; object-fit: cover;">
            </div>
        @endif

        <div class="text-end mt-4">
            <a href="{{ route('galeri.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

</div>
@endsection
