@extends('layouts.usersub')

@section('title', $berita->judul)

@section('content')
<div class="header-section text-white d-flex flex-column justify-content-center text-center"
    style="height: 20vh; background: url('{{ asset('assets/img/background.jpg') }}') center/cover no-repeat; position: relative;">
    
    <div style="position:absolute; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.45);"></div>

    <h1 class="fw-bold position-relative" style="z-index: 2; font-size:30px;">
        BERITA DESA
    </h1>
</div>

<div class="container" style="margin-top: -150px; padding-top: 180px; margin-bottom: 50px;">
    <div class="row">
        {{-- ============ KOLOM KIRI (DETAIL BERITA) ============ --}}
        <div class="col-lg-8 mb-4">
            <div id="berita-container"></div>
        </div>

        {{-- ============ KOLOM KANAN (REKOMENDASI BERITA) ============ --}}
        <div class="col-lg-4">
            <h5 class="fw-bold mb-3">Rekomendasi Berita</h5>
            @forelse($rekomendasi as $r)
                <div class="card mb-3 shadow-sm rounded-3 border-0 rekom-card"
                     style="cursor:pointer;"
                     onclick="window.location='{{ route('user.berita.show', $r->id_berita) }}'">

                    <img src="{{ $r->foto ? asset('ufiles/'.$r->foto) : asset('noimage.png') }}"
                         class="rounded-top-3"
                         style="height: 150px; width: 100%; object-fit: cover;">

                    <div class="p-3">
                        <div class="text-muted" style="font-size: .8rem;">
                            <i class="bi bi-calendar-event" style="margin-right: 10px;"></i>
                            {{ \Carbon\Carbon::parse($r->tanggal)->locale('id')->translatedFormat('d M Y') }}
                        </div>
    
                        <hr class="my-2">

                        <h6 class="fw-bold">{{ Str::limit($r->judul, 60) }}</h6>

                        <p class="text-muted" style="font-size: .85rem;">
                            {!! Str::words(strip_tags($r->isi), 15, '...') !!}
                        </p>
                    </div>
                </div>
            @empty
                <p class="text-muted">Tidak ada rekomendasi berita.</p>
            @endforelse
        </div>
    </div>
</div>

{{-- ============ CSS HOVER CARD REKOMENDASI ============ --}}
<style>
    .rekom-card {
        transition: .3s;
    }
    .rekom-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.18) !important;
    }
</style>


{{-- ============ JS AUTO DETECT PORTRAIT / LANDSCAPE ============ --}}
<script>
document.addEventListener("DOMContentLoaded", function () {
    const url = "{{ $berita->foto ? asset('ufiles/'.$berita->foto) : asset('noimage.png') }}";

    let img = new Image();
    img.src = url;

    img.onload = function () {
        let container = document.getElementById("berita-container");

        // ================= PORTRAIT =================
        if (img.height > img.width) {
            container.innerHTML = `
                <div class="card shadow-lg border-0 rounded-4 p-4">
                    <div class="row g-4">

                        <div class="col-md-5">
                            <img src="${url}" class="img-fluid rounded-3 w-100"
                                 style="height: 320px; object-fit: cover;">
                        </div>

                        <div class="col-md-7">
                            <h2 class="fw-bold mb-3">{{ $berita->judul }}</h2>

                            <div class="text-muted mb-3" style="font-size:.9rem;">
                                <i class="bi bi-calendar-event" style="margin-right: 10px;"></i>
                                {{ \Carbon\Carbon::parse($berita->tanggal)->locale('id')->translatedFormat('d F Y') }}
                            </div>

                            <hr>

                            <div style="font-size: 1rem; line-height: 1.8;">
                                {!! $berita->isi !!}
                            </div>
                        </div>

                    </div>
                </div>
            `;
        }

        // ================= LANDSCAPE =================
        else {
            container.innerHTML = `
                <div class="card shadow-lg border-0 rounded-4 p-4">

                    <img src="${url}" class="rounded-3 mb-4 w-100"
                         style="height: 350px; object-fit: cover;">

                    <h2 class="fw-bold mb-3">{{ $berita->judul }}</h2>

                    <div class="text-muted mb-3" style="font-size:.9rem;">
                        <i class="fa-solid fa-calendar-days me-2"></i>
                        {{ \Carbon\Carbon::parse($berita->tanggal)->locale('id')->translatedFormat('d F Y') }}
                    </div>

                    <hr>

                    <div style="font-size: 1rem; line-height: 1.8;">
                        {!! $berita->isi !!}
                    </div>

                </div>
            `;
        }
    };
});
</script>

@endsection
