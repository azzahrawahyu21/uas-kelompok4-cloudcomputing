@extends('layouts.user')

@section('title', 'Struktur Organisasi')

@section('content')
<div class="header-section text-white d-flex flex-column justify-content-center text-center"
     style="height: 20vh; background: url('{{ asset('assets/img/background.jpg') }}') center/cover no-repeat; position: relative;">
    
    <div style="position:absolute; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.45);"></div>

    <h1 class="fw-bold position-relative" style="z-index: 2; font-size:30px;">
        STRUKTUR ORGANISASI
    </h1>
</div>

<div class="container" style="margin-top: -150px; padding-top: 180px; margin-bottom: 50px;">
    <div class="row">
        @foreach($jabatans as $jabatan)

            {{-- Skip jika tidak ada pejabat --}}
            @if($jabatan->pejabat->isEmpty())
                @continue
            @endif

            @foreach($jabatan->pejabat as $p)
            <div class="col-md-6 mb-4"> {{-- 2 card per baris --}}
                <div class="card bg-white shadow rounded-4 border-0 p-4 h-100 jabatan-card"
                    style="transition: .3s; cursor: pointer;">

                    {{-- Judul Jabatan --}}
                    <div class="card shadow rounded-4 border-0 mb-4" style="background-color: #d1e7dd;">
                        <div class="card-body text-center py-2">
                            <h2 class="fw-bold text-success text-uppercase mb-0">
                                @if($jabatan->tipe == 'multi')
                                    {{ strtoupper($p->subjabatan->nama_sub) }}
                                @else
                                    {{ strtoupper($jabatan->nama_jabatan) }}
                                @endif
                            </h2>
                        </div>
                    </div>

                    <div class="row">

                        {{-- Foto --}}
                        <div class="col-4 text-center">
                            <img src="{{ $p->foto ? asset('ufiles/'.$p->foto) : asset('noimage.png') }}"
                                 class="img-fluid rounded shadow"
                                 style="max-width: 130px;">
                        </div>

                        {{-- Detail --}}
                        <div class="col-8">
                            <h5 class="fw-bold mb-2">{{ $p->nama_pejabat }}</h5>
                            <hr class="my-2">
                            
                            @if($p->deskripsi)
                                <div style="font-size: .9rem;">
                                    {!! $p->deskripsi !!}
                                </div>
                            @endif
                        </div>

                    </div>

                </div>
            </div>
            @endforeach
        @endforeach
    </div>
</div>
<style>
    .jabatan-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.18) !important;
    }
</style>
@endsection