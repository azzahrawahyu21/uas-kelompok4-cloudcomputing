@extends('layouts.admin')

@section('title', 'Kelola Submenu - ' . $menu->nama_menu)

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
  {{-- Breadcrumb --}}
  <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
    <div>
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item">
          <a href="{{ route('menu.index') }}" class="text-[#0D4715] fw-semibold text-decoration-none">
            <i class="bi bi-arrow-left-circle me-1"></i> Daftar Menu
          </a>
        </li>
        <li class="breadcrumb-item active text-muted" aria-current="page">
          Kelola Submenu - {{ $menu->nama_menu }}
        </li>
      </ol>
    </div>
  </div>

  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-[#0D4715] text-2xl font-bold">
      Kelola Submenu dari {{ $menu->nama_menu }}
    </h2>
    <a href="{{ route('submenu.create', $menu->id_menu) }}" class="btn btn-success">
      <i class="bi bi-plus-circle"></i> Tambah Submenu
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
          <th style="width:5%">Nom</th>
          <th>Judul</th>
          <th style="width:30%">Isi</th>
          <th>Foto</th>
          <th style="width:25%">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($submenus as $index => $submenu)
          <tr>
            <td class="text-center">{{ $index + 1 }}</td>
            <td>{{ $submenu->judul }}</td>
            <td class="isi-teks">
                {{ \Illuminate\Support\Str::limit(strip_tags($submenu->isi), 200, '...') }}
            </td>
            <td class="text-center">
              @if($submenu->foto)
                <img src="{{ asset('ufiles/' . $submenu->foto) }}" alt="Foto" class="img-fluid rounded" style="max-height:80px;">
              @else
                <span class="text-muted">-</span>
              @endif
            </td>
            <td class="text-center">
              <a href="{{ route('submenu.edit', [$menu->id_menu, $submenu->id_submenu]) }}" class="btn btn-warning btn-sm me-1">
                <i class="bi bi-pencil-square"></i> Edit
              </a>
              <form action="{{ route('submenu.destroy', [$menu->id_menu, $submenu->id_submenu]) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus submenu ini?')">
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
            <td colspan="5" class="text-center text-muted">Belum ada submenu.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection