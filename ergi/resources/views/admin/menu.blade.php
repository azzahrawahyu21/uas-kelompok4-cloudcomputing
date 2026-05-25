@extends('layouts.admin')

@section('title', 'Kelola Profil Desa')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-[#0D4715] text-2xl font-bold">Kelola Profil Desa</h2>
    <a href="{{ route('menu.create') }}" class="btn btn-success">
      <i class="bi bi-plus-circle"></i> Tambah Profil Desa
    </a>
  </div>

  {{-- Pesan sukses / error --}}
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @elseif(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif

  {{-- Tabel Daftar Menu --}}
  <div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
      <thead class="text-center table-success">
        <tr>
          <th style="width: 5%">No</th>
          <th>Nama Profil Desa</th>
          <th style="width: 30%">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($menus as $index => $menu)
          <tr>
            <td class="text-center">{{ $index + 1 }}</td>
            <td>{{ $menu->nama_menu }}</td>
            <td class="text-center">
              <a href="{{ route('menu.edit', $menu->id_menu) }}" class="btn btn-warning btn-sm me-1">
                <i class="bi bi-pencil-square"></i> Edit
              </a>

              <form action="{{ route('menu.destroy', $menu->id_menu) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus menu ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">
                  <i class="bi bi-trash"></i> Hapus
                </button>
              </form>

              <a href="{{ route('submenu.index', $menu->id_menu) }}" class="btn btn-info btn-sm text-white">
                <i class="bi bi-list-ul"></i> Detail
              </a>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="3" class="text-center text-muted">Belum ada profil desa yang ditambahkan.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
