@extends('layouts.admin')

@section('title', 'Detail Pejabat')

@section('content')
<div class="container">

    {{-- Breadcrumb --}}
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <div>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('jabatan.index') }}" class="text-[#0D4715] fw-semibold text-decoration-none">
                        <i class="bi bi-arrow-left-circle me-1"></i> Daftar Jabatan
                    </a>
                </li>
                @if($id_sub)
                    <li class="breadcrumb-item">
                        <a href="{{ route('subjabatan.index', $jabatan->id_jabatan) }}" class="text-[#0D4715] fw-semibold text-decoration-none">
                            Subjabatan
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('pejabat.index', [$jabatan->id_jabatan, $id_sub]) }}" class="text-[#0D4715] fw-semibold text-decoration-none">
                            Detail Subjabatan: {{ $subjabatan->nama_sub }}
                        </a>
                    </li>
                @else
                    <li class="breadcrumb-item">
                        <a href="{{ route('pejabat.index', $jabatan->id_jabatan) }}" class="text-[#0D4715] fw-semibold text-decoration-none">
                            {{ $jabatan->nama_jabatan }}
                        </a>
                    </li>
                @endif
                <li class="breadcrumb-item active text-muted" aria-current="page">Detail Pejabat</li>
            </ol>
        </div>
    </div>

    {{-- Content --}}
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-[#0D4715] fw-bold text-decoration-none" style="text-align: center; margin-bottom: 40px; font-size: 20px;">
            {{ $jabatan->nama_jabatan }}
        </h1>
        <div class="row">
            {{-- FOTO DI KIRI --}}
            <div class="col-md-4 text-center">
                @if($pejabat->foto)
                    <img 
                        src="{{ asset('ufiles/' . $pejabat->foto) }}" 
                        alt="Foto Pejabat" 
                        class="img-fluid rounded shadow"
                        style="max-width: 250px;">
                @else
                    <img 
                        src="{{ asset('noimage.png') }}" 
                        alt="Tidak ada foto" 
                        class="img-fluid rounded shadow"
                        style="max-width: 250px;">
                @endif
            </div>

            {{-- NAMA + DESKRIPSI --}}
            <div class="col-md-8">
                <h3 class="fw-bold mb-3">{{ $pejabat->nama_pejabat }}</h3>
                <hr>
                <div style="min-height: 200px; margin-top: 15px;">
                    {!! $pejabat->deskripsi !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
