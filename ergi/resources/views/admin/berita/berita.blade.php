@extends('layouts.admin')

@section('title', 'Kelola Berita')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <h2 class="text-[#0D4715] text-2xl font-bold">Kelola Berita</h2>
        <a href="{{ route('berita.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Tambah Berita
        </a>
    </div>

    {{-- Pesan sukses / error --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Tabel Daftar Berita --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
        <thead class="text-center table-success">
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 20%">Judul</th>
                <th style="width: 25%">Isi</th>
                <th style="width: 10%">Foto</th>
                <th style="width: 10%">Tanggal</th>
                <th style="width: 25%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($beritas as $index => $berita)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $berita->judul }}</td>
                <td>{!! Str::limit(strip_tags($berita->isi), 50, ' ... ') !!}</td>
                <td class="text-center">
                    @if($berita->foto)
                        <img src="{{ asset('ufiles/' . $berita->foto) }}"alt="Foto"class="rounded"style="width: 100%; height: auto; display: block; margin: 0 auto; object-fit: cover; object-position: center;">
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </td>
                <td>{{ \Carbon\Carbon::parse($berita->tanggal)->format('d-m-Y') }}</td>
                <td class="text-center">
                    <a href="{{ route('berita.edit', $berita->id_berita) }}" class="btn btn-warning btn-sm me-1">
                        <i class="bi bi-pencil-square"></i> Edit
                    </a>

                    <form action="{{ route('berita.destroy', $berita->id_berita) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </form>

                    <a href="{{ route('berita.detail', $berita->id_berita) }}" class="btn btn-info btn-sm text-white">
                            <i class="bi bi-list-ul"></i> Detail
                    </a>


                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-muted">Belum ada berita yang ditambahkan.</td>
            </tr>
            @endforelse
        </tbody>
        </table>
    </div>
</div>
@endsection
