@extends('layouts.admin')

@section('title', 'Subkategori Statistik')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    {{-- Breadcrumb --}}
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <div>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('kategori-statistik.index') }}" class="text-[#0D4715] fw-semibold text-decoration-none">
                        <i class="bi bi-arrow-left-circle me-1"></i> Kategori Statistik
                    </a>
                </li>
                <li class="breadcrumb-item active text-muted" aria-current="page">Daftar Subkategori - {{ $kategori->nama_kategori }}</li>
            </ol>
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-[#0D4715] text-2xl fw-bold">Daftar Subkategori Statistik - {{ $kategori->nama_kategori }}</h2>
        <a href="{{ route('subkategori-statistik.create', $kategori->id_kategori) }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Tambah Subkategori
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
                    <th>Nama Subkategori</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @forelse($subkategoris as $index => $subkategori)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $subkategori->nama_subkategori }}</td>
                        <td>{{ $subkategori->kategori->nama_kategori ?? '-' }}</td>
                        <td>
                            <a href="{{ route('subkategori-statistik.edit', $subkategori->id_subkategori) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('subkategori-statistik.destroy', $subkategori->id_subkategori) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                            <a href="{{ route('subkategori-statistik.show', $subkategori->id_subkategori) }}" class="btn btn-info btn-sm text-white">
                                <i class="bi bi-list-ul"></i> Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">Belum ada subkategori untuk kategori {{ $kategori->nama_kategori }}.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
