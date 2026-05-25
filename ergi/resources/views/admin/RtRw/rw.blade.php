@extends('layouts.admin')

@section('title', 'Data RW')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
  {{-- Breadcrumb --}}
  <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
    <div>
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item">
          <a href="{{ route('rw.index') }}" class="text-[#0D4715] fw-semibold text-decoration-none">
            <i class="bi bi-arrow-left-circle me-1"></i>Daftar RT/RW
          </a>
        </li>
        <li class="breadcrumb-item active text-muted" aria-current="page">
          @isset($rw)
            Kelola RW - {{ $rw->no_rw }}
          @else
            Kelola RW
          @endisset
        </li>
      </ol>
    </div>
  </div>

  <div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h3 class="text-[#0D4715] fw-bold" style="font-size: 25px;">Data RW</h3>
      <a href="{{ route('rw.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle me-2"></i> Tambah RW
      </a>
    </div>

      <div class="card-body">
        @if($rws->isEmpty())
          <p class="text-center text-muted">Belum ada data RW.</p>
        @else
          <table class="table table-bordered">
            <thead class="table-success">
              <tr>
                <th>No</th>
                <th>No RW</th>
                <th>Nama Ketua RW</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($rws as $index => $rw)
                <tr>
                  <td>{{ $index + 1 }}</td>
                  <td>{{ $rw->no_rw }}</td>
                  <td>{{ $rw->nama_rw }}</td>
                  <td class="text-center">
                    {{-- Tombol Edit --}}
                    <a href="{{ route('rw.edit', $rw->id_rw) }}" 
                      class="btn btn-warning btn-sm me-1">
                      <i class="bi bi-pencil-square"></i> Edit
                    </a>

                    {{-- Tombol Hapus --}}
                    <form action="{{ route('rw.destroy', $rw->id_rw) }}" 
                          method="POST" class="d-inline" 
                          onsubmit="return confirm('Yakin ingin menghapus RW ini?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm me-1">
                        <i class="bi bi-trash"></i> Hapus
                      </button>
                    </form>

                    {{-- Tombol Detail --}}
                    <a href="{{ route('rw.show', $rw->id_rw) }}" 
                      class="btn btn-info btn-sm text-white">
                      <i class="bi bi-list-ul"></i> Detail
                    </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        @endif
      </div>
  </div>
</div>
  @endsection