@extends('layouts.admin')

@section('title', 'Pejabat')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    {{-- Breadcrumb --}}
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <div>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('jabatan.index') }}" class="text-[#0D4715] fw-semibold text-decoration-none">
                        <i class="bi bi-arrow-left-circle me-1"></i> Daftar Jabatan
                    </a>
                </li>

                @if($id_sub == null)
                    <li class="breadcrumb-item active text-muted" aria-current="page">
                        {{ $jabatan->nama_jabatan }}
                    </li>
                @else
                    <li class="breadcrumb-item">
                        <a href="{{ route('subjabatan.index', $jabatan->id_jabatan) }}" class="text-[#0D4715] fw-semibold text-decoration-none">
                        {{ $jabatan->nama_jabatan }}
                        </a>
                    </li>
                    <li class="breadcrumb-item active text-muted" aria-current="page">
                        {{ $subjabatan->nama_sub }}
                    </li>
                @endif
            </ol>
        </div>
    </div>

    {{-- Judul Halaman & Tombol Tambah --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-[#0D4715] text-2xl font-bold">
            {{ $id_sub ? $subjabatan->nama_sub : $jabatan->nama_jabatan }}
        </h2>
        {{-- Tombol Tambah sebagai link ke halaman create --}}
        <a href="{{ route('pejabat.create', [$jabatan->id_jabatan, $id_sub]) }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Tambah Pejabat
        </a>
    </div>

    {{-- Pesan sukses / error --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Tabel Pejabat --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="text-center table-success">
                <tr>
                    <th style="width:5%">No</th>
                    <th>Nama Pejabat</th>
                    <th>Deskripsi</th>
                    <th>Foto</th>
                    <th style="width:25%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pejabats as $index => $pejabat)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $pejabat->nama_pejabat }}</td>
                        <td>{!! Str::limit($pejabat->deskripsi, 200, '...') !!}</td>
                        <td class="text-center">
                            @if($pejabat->foto)
                                <img src="{{ asset('ufiles/' . $pejabat->foto) }}" alt="Foto" class="img-fluid rounded" style="max-height:80px;">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('pejabat.edit', [$pejabat->id_pejabat, $id_sub]) }}" class="btn btn-warning btn-sm me-1">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>

                            <form action="{{ route('pejabat.destroy', [$pejabat->id_pejabat, $id_sub]) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pejabat ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>

                            <a href="{{ route('pejabat.show', $pejabat->id_pejabat) }}" class="btn btn-info btn-sm text-white">
                                <i class="bi bi-list-ul"></i> Detail
                            </a>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada pejabat.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
