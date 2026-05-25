@extends('layouts.admin')

@section('title', 'Kelola Jenis PPID')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-[#0D4715] text-2xl font-bold">Kelola Jenis PPID</h2>
    <a href="{{ route('jenis-ppid.create') }}" class="btn btn-success">
      <i class="bi bi-plus-circle"></i> Tambah Jenis PPID
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
          <th>Nama Jenis PPID</th>
          <th style="width: 35%">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($jenisPpids as $index => $jenis)
          <tr>
            <td class="text-center">{{ $index + 1 }}</td>
            <td>{{ $jenis->nama_jenis_ppid }}</td>
            <td class="text-center">
              <a href="{{ route('jenis-ppid.edit', $jenis->id_jenis_ppid) }}" 
                 class="btn btn-warning btn-sm me-1">
                <i class="bi bi-pencil-square"></i> Edit
              </a>

              <form action="{{ route('jenis-ppid.destroy', $jenis->id_jenis_ppid) }}"
                  method="POST" class="d-inline" 
                  onsubmit="return confirm('Yakin ingin menghapus?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="bi bi-trash"></i> Hapus
                </button>
            </form>
              <a href="{{ route('judul-ppid.index', $jenis->id_jenis_ppid) }}" class="btn btn-info btn-sm text-white">
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
