@extends('layouts.admin')

@section('title', 'Kelola Kategori Statistik')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-[#0D4715] text-2xl font-bold">Kelola Kategori Statistik</h2>
    <a href="{{ route('kategori-statistik.create') }}" class="btn btn-success">
      <i class="bi bi-plus-circle"></i> Tambah Kategori
    </a>
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @elseif(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif

  <div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
      <thead class="text-center" style="background-color: #0D4715; color: white;">
        <tr>
          <th style="width: 5%">No</th>
          <th>Nama Kategori</th>
          <th style="width: 35%">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($kategoris as $index => $kategori)
          <tr>
            <td class="text-center">{{ $index + 1 }}</td>
            <td>{{ $kategori->nama_kategori }}</td>
            <td class="text-center">
              <a href="{{ route('kategori-statistik.edit', $kategori->id_kategori) }}" 
                 class="btn btn-warning btn-sm me-1">
                <i class="bi bi-pencil-square"></i> Edit
              </a>

              <form action="{{ route('kategori-statistik.destroy', $kategori->id_kategori) }}" 
                    method="POST" class="d-inline" 
                    onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">
                  <i class="bi bi-trash"></i> Hapus
                </button>
              </form>
              <a href="{{ route('subkategori-statistik.index', $kategori->id_kategori) }}" class="btn btn-info btn-sm text-white">
                <i class="bi bi-list-ul"></i> Detail
              </a>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="3" class="text-center text-muted">Belum ada kategori yang ditambahkan.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
