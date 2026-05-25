@extends('layouts.admin')

@section('title', $jabatan->nama_jabatan)

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <div>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('jabatan.index') }}" class="text-[#0D4715] fw-semibold text-decoration-none">
                        <i class="bi bi-arrow-left-circle me-1"></i> Daftar Jabatan
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('subjabatan.index', $jabatan->id_jabatan) }}" class="text-[#0D4715] fw-semibold text-decoration-none">
                        {{ $jabatan->nama_jabatan }}
                    </a>
                </li>
            </ol>
        </div>
    </div>

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="text-[#0D4715] text-2xl font-bold mb-1">
                {{ $jabatan->nama_jabatan }}
            </h2>
        </div>

        <a href="{{ route('subjabatan.create', $jabatan->id_jabatan) }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Tambah Sub Jabatan
        </a>
    </div>

    {{-- Pesan success --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Tabel --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-success text-center">
                <tr>
                    <th width="5%">No</th>
                    <th>Nama Sub Jabatan</th>
                    <th style="width: 28%">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($subJabatan as $index => $sub)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $sub->nama_sub }}</td>
                        <td class="text-center">
                            <a href="{{ route('subjabatan.edit', [$jabatan->id_jabatan, $sub->id_sub]) }}"
                                class="btn btn-warning btn-sm me-1">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>

                            <form action="{{ route('subjabatan.destroy', [$jabatan->id_jabatan, $sub->id_sub]) }}"
                                  method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>

                            <a href="{{ route('pejabat.index', [$jabatan->id_jabatan, $sub->id_sub]) }}" class="btn btn-info btn-sm text-white">
                               <i class="bi bi-list-ul"></i> Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Belum ada Sub Jabatan yang ditambahkan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Kembali --}}
    {{-- <div class="mt-3">
        <a href="{{ route('jabatan.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div> --}}
</div>
@endsection
