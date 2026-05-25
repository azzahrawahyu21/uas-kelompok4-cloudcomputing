@extends('layouts.admin')

@section('title', 'Detail Kategori Statistik')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">

    {{-- Judul --}}
    <h2 class="text-[#0D4715] text-2xl fw-bold mb-4">Detail Kategori: {{ $kategori->nama_kategori }}</h2>

    {{-- Tombol Tambah Subkategori --}}
    <a href="{{ route('subkategori-statistik.create') }}?id_kategori={{ $kategori->id_kategori }}" class="btn btn-success mb-3">
        <i class="bi bi-plus-circle"></i> Tambah Subkategori
    </a>

    {{-- Pesan sukses --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Tabel Subkategori --}}
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Subkategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kategori->subkategoris as $index => $subkategori)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $subkategori->nama_subkategori }}</td>
                    <td>
                        {{-- Edit Subkategori --}}
                        <a href="{{ route('subkategori-statistik.edit', $subkategori->id_subkategori) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>

                        {{-- Hapus Subkategori --}}
                        <form action="{{ route('subkategori-statistik.destroy', $subkategori->id_subkategori) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus subkategori ini?')">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>

                        {{-- Detail Subkategori --}}
                        <a href="{{ route('subkategori-statistik.show', $subkategori->id_subkategori) }}" class="btn btn-info btn-sm text-white">
                            <i class="bi bi-list-ul"></i> Detail
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center text-muted">Belum ada subkategori untuk kategori ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Tombol Kembali --}}
    <a href="{{ route('kategori-statistik.index') }}" class="btn btn-secondary mt-3">
        <i class="bi bi-arrow-left-circle"></i> Kembali ke Daftar Kategori
    </a>

</div>
@endsection
