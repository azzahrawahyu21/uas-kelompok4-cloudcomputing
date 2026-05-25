@extends('layouts.admin')

@section('title', 'Kelola Jabatan')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-[#0D4715] text-2xl font-bold">Kelola Jabatan</h2>
        <a href="{{ route('jabatan.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Tambah Jabatan
        </a>
    </div>

    {{-- Pesan sukses / error --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Tabel Daftar Jabatan --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
        <thead class="text-center table-success">
            <tr>
            <th style="width: 5%">No</th>
            <th>Nama Jabatan</th>
            <th style="width: 30%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($jabatans as $index => $jabatan)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $jabatan->nama_jabatan }}</td>
                <td class="text-center">
                    <a href="{{ route('jabatan.edit', $jabatan->id_jabatan) }}" class="btn btn-warning btn-sm me-1">
                        <i class="bi bi-pencil-square"></i> Edit
                    </a>

                    <form action="{{ route('jabatan.destroy', $jabatan->id_jabatan) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus jabatan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </form>

                    @if ($jabatan->tipe == 'tunggal')
                        <a href="{{ route('pejabat.index', $jabatan->id_jabatan) }}" class="btn btn-info btn-sm text-white">
                            <i class="bi bi-list-ul"></i> Detail
                        </a>
                    @endif
                    @if ($jabatan->tipe == 'multi')
                        <a href="{{ route('subjabatan.index', $jabatan->id_jabatan) }}" class="btn btn-info btn-sm text-white">
                            <i class="bi bi-list-ul"></i> Detail
                        </a>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center text-muted">Belum ada jabatan yang ditambahkan.</td>
            </tr>
            @endforelse
        </tbody>
        </table>
    </div>
</div>
@endsection
