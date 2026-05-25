@extends('layouts.usersub')

@section('title', 'Berita Desa')

@section('content')
<div class="header-section text-white d-flex flex-column justify-content-center text-center"
     style="height: 20vh; background: url('{{ asset('assets/img/background.jpg') }}') center/cover no-repeat; position: relative;">
    
    <div style="position:absolute; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.45);"></div>

    <h1 class="fw-bold position-relative" style="z-index: 2; font-size:30px;">
        BERITA DESA
    </h1>
</div>

<div class="container" style="margin-top: -150px; padding-top: 180px; margin-bottom: 50px;">
    <div class="row g-4">
        @foreach($beritas as $b)
        <div class="col-md-4">
            <div class="card rounded-4 shadow-sm border-0 h-100 berita-card"
                style="transition: .3s; cursor: pointer;"
                onclick="window.location='{{ route('user.berita.show', $b->id_berita) }}'">

                {{-- Foto --}}
                <img src="{{ $b->foto ? asset('ufiles/'.$b->foto) : asset('noimage.png') }}"
                    class="card-img-top rounded-top-4"
                    style="height: 220px; object-fit: cover;">

                <div class="card-body">
                    <div class="d-flex align-items-center text-muted" style="font-size: .85rem;">
                        <i class="bi bi-calendar-event" style="margin-right: 10px;"></i>
                        {{ \Carbon\Carbon::parse($b->tanggal)->locale('id')->translatedFormat('d F Y') }}
                    </div>

                    <hr class="my-2">

                    <h5 class="fw-bold mb-2">
                        {{ Str::limit($b->judul, 70) }}
                    </h5>

                    <p class="text-muted mb-3" style="font-size: .9rem;">
                        {{ Str::limit(strip_tags($b->isi), 100) }}
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
    .berita-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.18) !important;
    }
</style>
@endsection