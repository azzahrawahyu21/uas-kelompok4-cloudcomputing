@extends('layouts.user')

@section('title', 'Struktur Organisasi - ' . $jabatan->nama_jabatan)

@section('content')
<div class="container-fluid px-4"> {{-- px-1 = margin kiri kanan kecil --}}

    {{-- Judul / Header --}}
    <div class="mb-4">
        <div class="card shadow rounded-4 border-0" style="background-color: #d1e7dd;">
            <div class="card-body text-center py-4">
                <h2 class="fw-bold text-success text-uppercase mb-0">
                    {{ strtoupper($jabatan->nama_jabatan) }}
                </h2>
            </div>
        </div>
    </div>

    {{-- Jika data kosong --}}
    @if($pejabat->isEmpty())
        <div class="alert alert-warning text-center rounded-4 shadow-sm mx-1">
            Belum ada pejabat untuk jabatan ini.
        </div>
    @else

    {{-- Card isi pejabat --}}
    @foreach($pejabat as $p)
        <div class="card bg-white shadow rounded-4 p-4 mb-4 mx-1"> {{-- mx-1 = margin kiri kanan 5px --}}
            <div class="row">
                
                {{-- Foto --}}
                <div class="col-md-4 text-center mb-3 mb-md-0">
                    @if($p->foto)
                        <img src="{{ asset('ufiles/'.$p->foto) }}"
                            class="img-fluid rounded shadow"
                            style="max-width: 170px;">
                    @else
                        <img src="{{ asset('noimage.png') }}"
                            class="img-fluid rounded shadow"
                            style="max-width: 170px;">
                    @endif
                </div>

                {{-- Detail --}}
                <div class="col-md-8">
                    <h4 class="fw-bold mb-3">Nama : {{ $p->nama_pejabat }}</h4>
                    <hr>
                    @if(!empty($p->deskripsi))
                        <div class="mt-3" style="min-height: 100px;">
                            {!! $p->deskripsi !!}
                        </div>
                    @endif
                </div>

            </div>
        </div>
    @endforeach

    @endif

</div>
@endsection
