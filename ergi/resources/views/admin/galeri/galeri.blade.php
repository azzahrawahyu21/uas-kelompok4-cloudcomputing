@extends('layouts.admin')

@section('title', 'Kelola Galeri')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <h2 class="text-[#0D4715] text-2xl font-bold">Kelola Galeri</h2>
        <a href="{{ route('galeri.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Tambah Galeri
        </a>
    </div>

    {{-- Pesan sukses / error --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Tabel Daftar galeri --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
        <thead class="text-center table-success">
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 20%">Judul</th>
                <th style="width: 15%">Foto</th>
                <th style="width: 10%">Tanggal</th>
                <th style="width: 25%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($galeris as $index => $galeri)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $galeri->judul }}</td>
                <td class="text-center">
                    @if($galeri->foto)
                        <img src="{{ asset('ufiles/' . $galeri->foto) }}"alt="Foto"class="rounded"style="width: 100%; height: auto; display: block; margin: 0 auto; object-fit: cover; object-position: center;">
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </td>
                <td class="text-center">{{ \Carbon\Carbon::parse($galeri->tanggal)->format('d-m-Y') }}</td>
                <td class="text-center">
                    <a href="{{ route('galeri.edit', $galeri->id_galeri) }}" class="btn btn-warning btn-sm me-1">
                        <i class="bi bi-pencil-square"></i> Edit
                    </a>

                    <form action="{{ route('galeri.destroy', $galeri->id_galeri) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus galeri ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center text-muted">Belum ada galeri yang ditambahkan.</td>
            </tr>
            @endforelse
        </tbody>
        </table>
    </div>
</div>
@endsection