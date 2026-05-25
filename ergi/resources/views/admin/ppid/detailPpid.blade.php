{{-- resources/views/admin/ppid/detailPpid.blade.php --}}
@extends('layouts.admin')

@section('title', 'Daftar Dokumen PPID')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">

    {{-- BREADCRUMB --}}
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <div>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('jenis-ppid.index') }}" class="text-[#0D4715] fw-semibold text-decoration-none">
                        <i class="bi bi-arrow-left-circle me-1"></i> Jenis PPID
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('judul-ppid.index', $judul->id_jenis_ppid) }}" 
                       class="text-[#0D4715] fw-semibold text-decoration-none">
                        {{ $jenis->nama_jenis_ppid }}
                    </a>
                </li>
                <li class="breadcrumb-item active text-muted" aria-current="page">
                    {{ $judul->judul }}
                </li>
            </ol>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="text-[#0D4715] text-2xl fw-bold mb-1">{{ $judul->judul }}</h2>
            <p class="text-muted mb-0">Jenis: <strong>{{ $jenis->nama_jenis_ppid }}</strong></p>
        </div>
        <a href="{{ route('ppid.create', $judul->id_judul) }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Tambah Dokumen
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-success text-center" style="background-color: #0D4715; color: white;">
                <tr>
                    <th style="width: 5%">No</th>
                    <th style="width: 15%">Tanggal</th>
                    <th>Tentang</th>
                    <th style="width: 20%">File</th>
                    <th style="width: 15%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dokumens as $index => $dokumen)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="text-center">
                            {{ \Carbon\Carbon::parse($dokumen->tanggal)->format('d/m/Y') }}
                        </td>
                        <td>{{ $dokumen->tentang }}</td>
                        <td>
                            <a href="{{ $dokumen->file }}" target="_blank" class="text-primary text-decoration-underline">
                                {{ urldecode(basename($dokumen->file)) }}
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('ppid.edit', $dokumen->id_ppid) }}" 
                               class="btn btn-warning btn-sm" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                                Edit
                            </a>
                            <form action="{{ route('ppid.destroy', $dokumen->id_ppid) }}" 
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" 
                                        onclick="return confirm('Yakin hapus dokumen ini?')" 
                                        title="Hapus">
                                    <i class="bi bi-trash"></i>
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            Belum ada dokumen untuk judul ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection