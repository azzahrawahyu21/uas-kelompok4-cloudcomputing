@extends('layouts.admin')

@section('title', 'Tambah RW')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
  {{-- Breadcrumb --}}
  <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
    <div>
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item">
          <a href="{{ route('rw.index') }}" class="text-[#0D4715] fw-semibold text-decoration-none">
            <i class="bi bi-arrow-left-circle me-1"></i>Tambah RW
          </a>
        </li>
        <li class="breadcrumb-item active text-muted" aria-current="page">
          @isset($rw)
            Tambah RW - {{ $rw->no_rw }}
          @else
            Tambah RW
          @endisset
        </li>
      </ol>
    </div>
  </div>
  <h4 class="text-[#0D4715] fw-bold mb-4" style="font-size: 25px;">Tambah RW</h4>
    <form action="{{ route('rw.store') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label for="no_rw" class="form-label">Nomor RW</label>
        <input type="text" name="no_rw" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="nama_rw" class="form-label">Nama Ketua RW</label>
        <input type="text" name="nama_rw" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-success">Simpan</button>
      <a href="{{ route('rw.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>  
@endsection
