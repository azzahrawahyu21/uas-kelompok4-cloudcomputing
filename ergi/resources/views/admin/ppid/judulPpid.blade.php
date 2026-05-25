@extends('layouts.admin')

@section('title', 'Daftar Judul PPID')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    {{-- Breadcrumb --}}
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <div>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('jenis-ppid.index') }}" class="text-[#0D4715] fw-semibold text-decoration-none">
                        <i class="bi bi-arrow-left-circle me-1"></i> Jenis PPID
                    </a>
                </li>
                <li class="breadcrumb-item active text-muted" aria-current="page">Daftar Judul PPID - {{ $jenis->nama_jenis_ppid }}</li>
            </ol>
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-[#0D4715] text-2xl fw-bold">Daftar Judul PPID - {{ $jenis->nama_jenis_ppid }}</h2>
        <a href="{{ route('judul-ppid.create', $jenis->id_jenis_ppid) }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Tambah Judul PPID
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-success text-center">
                <tr>
                    <th>No</th>
                    <th style="width: 50%">Judul PPID</th>
                    <th>Jenis PPID</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @forelse($juduls as $index => $judul)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $judul->judul }}</td>
                        <td>{{ $judul->jenis->nama_jenis_ppid }}</td>
                        <td>
                            <a href="{{ route('judul-ppid.edit', $judul->id_judul) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('judul-ppid.destroy', $judul->id_judul) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                            <a href="{{ route('ppid.index', $judul->id_judul) }}" class="btn btn-info btn-sm text-white">
                                <i class="bi bi-list-ul"></i> Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">Belum ada subkategori untuk kategori {{ $jenis->nama_jenis_ppid }}.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
