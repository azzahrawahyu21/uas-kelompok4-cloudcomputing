@extends('layouts.admin')

@section('title', 'Tambah RT')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
  {{-- Breadcrumb --}}
  <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
    <div>
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item">
          <a href="{{ route('rw.show', $rw->id_rw) }}" class="text-[#0D4715] fw-semibold text-decoration-none">
            <i class="bi bi-arrow-left-circle me-1"></i>Tambah RT
          </a>
        </li>
        <li class="breadcrumb-item active text-muted" aria-current="page">
          Tambah RT - RW {{ $rw->no_rw }}
        </li>
      </ol>
    </div>
  </div>

  <h4 class="text-[#0D4715] fw-bold mb-4" style="font-size: 25px;">Tambah RT - RW {{ $rw->no_rw }}</h4>

  <form action="{{ route('rt.store', ['id_rw' => $rw->id_rw]) }}" method="POST">
    @csrf
    <input type="hidden" name="id_rw" value="{{ $rw->id_rw }}">

    <div class="mb-3">
      <label for="no_rt" class="form-label">Nomor RT</label>
      <input type="text" name="no_rt" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="nama_rt" class="form-label">Nama Ketua RT</label>
      <input type="text" name="nama_rt" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">
      <i class="bi bi-save me-1"></i> Simpan
    </button>
    <a href="{{ route('rw.show', $rw->id_rw) }}" class="btn btn-secondary">Kembali</a>
  </form>
</div>
@endsection
