@extends('layouts.user')
@section('title', $jenis->nama_jenis_ppid . ' - PPID')

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

<div class="container mb-5">
    <!-- Judul Jenis PPID -->
    <div class="text-center mt-3 mb-3">
        <h4 class="fw-bold text-white py-2 px-4" style="background-color: #014421; border-radius: 10px; display: inline-block; width: 100%;">
            {{ $jenis->nama_jenis_ppid }}
        </h4>
    </div>

    <div class="card shadow-sm p-4" style="border-radius:20px; border:1px solid #cfe5d1;">
        @forelse($jenis->juduls as $judul)
        <div class="mb-5">
            <!-- Tombol Kembali & Judul sejajar -->
            <div class="d-flex align-items-center mb-3">
                @if($loop->first)
                <!-- Tombol Kembali hanya untuk judul pertama -->
                <a href="{{ route('user.ppid.index') }}" class="back-button me-3" onclick="history.back()" aria-label="Kembali">
                    <i class="bi bi-arrow-left-circle fs-4 text-success"></i>
                </a>
                @else
                <!-- Untuk judul berikutnya beri space agar tetap sejajar -->
                <span class="me-3" style="width: 36px;"></span>
                @endif

                <!-- Judul Tabel tetap sesuai styling lama -->
                <h5 class="fw-bold text-center mb-0 flex-grow-1" style="color:#014421;">
                    {{ strtoupper($judul->judul) }}
                </h5>
            </div>

            @if($judul->dokumens->count() > 0)
            <!-- Table -->
            <div class="table-responsive mb-4">
                <table class="table" style="border:1px solid #D9D9D9; border-radius:10px;">
                    <thead>
                        <tr class="text-center" style="background:#689875; color:#fff;">
                            <th style="width:50px; background:#689875; color:#fff;">NO</th>
                            <th style="width:300px; background:#689875; color:#fff;">TANGGAL</th>
                            <th style="background:#689875; color:#fff;">TENTANG</th>
                            <th style="width:200px; background:#689875; color:#fff;">FILE</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($judul->dokumens->sortByDesc('tanggal') as $dokumen)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($dokumen->tanggal)->locale('id')->translatedFormat('d F Y') }}</td>
                            <td>{{ $dokumen->tentang }}</td>
                            <td class="text-center">
                                <a href="{{ $dokumen->file }}" target="_blank" class="text-danger fw-semibold" style="text-decoration:none;">
                                    <i class="bi bi-eye"></i> Lihat File
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <p class="text-muted text-center">Belum ada dokumen untuk judul ini.</p>
            @endif
        </div>
        @empty
        
        <p class="text-center text-muted">Belum ada judul informasi untuk jenis ini.</p>
        @endforelse
    </div>
</div>
@endsection
\