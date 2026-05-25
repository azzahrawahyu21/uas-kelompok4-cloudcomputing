@extends('layouts.user')

@section('title', 'PPID')

@section('content')
<div class="header-section text-white d-flex flex-column justify-content-center text-center"
     style="height: 30vh; background: url('{{ asset('assets/img/background.jpg') }}') center/cover no-repeat; position: relative;">
    
    <div style="position:absolute; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.45);"></div>

    <h1 class="fw-bold position-relative" style="z-index: 2; font-size:30px;">
        PEJABAT PENGELOLA INFORMASI DAN DOKUMENTASI (PPID)
    </h1>
    <p class="text-white position-relative mt-3" style="z-index:2;">
        <strong>Pejabat Pengelola Informasi dan Dokumentasi (PPID)</strong> adalah pejabat yang bertanggung jawab di bidang <br> 
        penyimpanan, pendokumentasian, penyediaan, dan/atau pelayanan informasi di badan publik.
    </p>
</div>

<div class="container" style="margin-top: -150px; padding-top: 180px; margin-bottom: 50px;">
    <div class="row g-4 justify-content-center">
    @forelse($jenisPpids as $jenis)
        <div class="col-lg-4 col-md-6 col-12">
            <a href="{{ route('user.ppid.show-detail', $jenis->id_jenis_ppid) }}"
                class="text-decoration-none h-100">
                <div class="card p-3 text-center shadow-sm ppid-card h-100"
                        style="border-radius: 18px; background: linear-gradient(135deg, #d1e7dd 0%, #e8f5e8 100%);
                            transition: transform 0.3s, box-shadow 0.3s;">
                    <div class="card-body d-flex flex-column justify-content-center">
                        <h5 class="fw-bold text-success mb-0 ppid-title" style="font-size: 18px;">
                            {{ $jenis->nama_jenis_ppid }}
                        </h5>
                    </div>
                </div>
            </a>
        </div>
    @empty
        <div class="col-12 text-center py-5">
            <p class="text-muted fs-5">Belum ada jenis informasi publik yang tersedia.</p>
        </div>
    @endforelse
    </div><br>

    <!-- Card Utama -->
    <div class="card p-4 bg-white shadow-lg" 
        style="border-radius:20px;">
        <h5 class="text-center text-success fw-bold mt-4" style="font-size: 20px;">DASAR HUKUM PPID</h5>
        <div class="mt-3">
            <div class="ppid-hukum-block">
                <strong class="fw-bold text-success mb-0 ppid-title">UNDANG UNDANG REPUBLIK INDONESIA</strong>
                <ol>
                    <li>Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik.</li>
                    <li>Undang-Undang Nomor 25 Tahun 2009 tentang Pelayanan Publik.</li>
                    <li>Undang-Undang Nomor 6 Tahun 2014 tentang Desa.</li>
                </ol>
            </div>

            <div class="ppid-hukum-block">
                <strong class="fw-bold text-success mb-0 ppid-title">PERATURAN PEMERINTAH</strong>
                <ol>
                    <li>Peraturan Pemerintah Nomor 61 Tahun 2010 Tentang Pelaksanaan Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik.</li>
                </ol>
            </div>

            <div class="ppid-hukum-block">
                <strong class="fw-bold text-success mb-0 ppid-title">PERATURAN KOMISI INFORMASI</strong>
                <ol>
                    <li>Peraturan Komisi Informasi Pusat Republik Indonesia Nomor 1 Tahun 2018 tentang Standar Layanan Informasi Publik Desa.</li>
                    <li>Peraturan Komisi Informasi Pusat Republik Indonesia Nomor 1 Tahun 2021 tentang Standar Layanan Informasi Publik.</li>
                </ol>
            </div>

            <div class="ppid-hukum-block">
                <strong class="fw-bold text-success mb-0 ppid-title">PERATURAN MENTRI DALAM NEGERI</strong>
                <ol>
                    <li>Peraturan Pemerintah Nomor 61 Tahun 2010 Tentang Pelaksanaan Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik.</li>
                </ol>
            </div>
        </div>
      </div>
</div>

<style>
.header-section p strong {
    color: #ffffff; /* paksa strong jadi putih */
}

.ppid-card {
    box-shadow: 0 6px 18px rgba(0,0,0,0.2);
    border: 1px solid #d4edda;
    transition: transform 0.3s, box-shadow 0.3s;
    border-radius: 18px;
}
.ppid-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 18px 36px rgba(0,0,0,0.35);
}

.ppid-title {
    transition: transform 0.3s, text-shadow 0.3s;
}
.ppid-card:hover .ppid-title {
    transform: translateY(-3px);
    text-shadow: 0 4px 8px rgba(0,0,0,0.2);
}
.ppid-hukum-block {
    margin-bottom: 30px; /* jarak antar blok */
}
.ppid-hukum-block strong {
    display: block;
    margin-bottom: 8px; /* jarak antara strong dan ol */
}

</style>
@endsection