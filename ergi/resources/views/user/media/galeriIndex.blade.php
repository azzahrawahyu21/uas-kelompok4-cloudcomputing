@extends('layouts.usersub')

@section('title', 'Galeri Desa')

@section('content')
<div class="header-section text-white d-flex flex-column justify-content-center text-center"
     style="height: 20vh; background: url('{{ asset('assets/img/background.jpg') }}') center/cover no-repeat; position: relative;">
    
    <div style="position:absolute; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.45);"></div>

    <h1 class="fw-bold position-relative" style="z-index: 2; font-size:30px;">
        GALERI DESA
    </h1>
</div>

<div class="container-fluid px-lg-5" style="margin-top: -150px; padding-top: 180px; margin-bottom: 50px;">
    <div class="row g-4">
        @foreach($galeris as $g)
        <div class="col-12 col-sm-6 col-lg-3"> {{-- 4 kolom per baris --}}
            <div class="card shadow-sm border-0 h-100 galeri-card"
                 style="transition: .3s; cursor: pointer;">

                {{-- Foto --}}
                <img src="{{ $g->foto ? asset('ufiles/'.$g->foto) : asset('noimage.png') }}"
                     class="card-img-top"
                     style="height: 220px; object-fit: cover;">

                <div class="card-body">
                    <div class="d-flex align-items-center text-muted" style="font-size: .85rem;">
                        <i class="bi bi-calendar-event" style="margin-right: 10px;"></i>
                        {{ \Carbon\Carbon::parse($g->tanggal)->locale('id')->translatedFormat('d F Y') }}
                    </div>
                    <hr class="my-2">
                    <h5 class="fw-bold mb-2">{{ $g->judul }}</h5>
                </div>

            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
    .galeri-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.18) !important;
    }
</style>
@endsection