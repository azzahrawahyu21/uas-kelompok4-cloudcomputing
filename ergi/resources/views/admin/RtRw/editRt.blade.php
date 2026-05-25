@extends('layouts.admin')

@section('title', 'Edit RT')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
  {{-- Breadcrumb --}}
  <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
    <div>
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item">
          <a href="{{ route('rw.show', $rw->id_rw) }}" class="text-[#0D4715] fw-semibold text-decoration-none">
            <i class="bi bi-arrow-left-circle me-1"></i>Kelola RW {{ $rw->no_rw }}
          </a>
        </li>
        <li class="breadcrumb-item active text-muted" aria-current="page">
          @isset($rt)
            Edit RT - {{ $rt->no_rt }}
          @else
            Edit RT
          @endisset
        </li>
      </ol>
    </div>
  </div>

  <h3 class="text-[#0D4715] fw-bold mb-4">Edit RT - RW {{ $rw->no_rw }}</h3>

  <form action="{{ route('rt.update', ['id_rw' => $rw->id_rw, 'id_rt' => $rt->id_rt]) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label for="no_rt" class="form-label">Nomor RT</label>
      <input type="text" name="no_rt" class="form-control" 
             value="{{ old('no_rt', $rt->no_rt) }}" required>
    </div>

    <div class="mb-3">
      <label for="nama_rt" class="form-label">Nama Ketua RT</label>
      <input type="text" name="nama_rt" class="form-control" 
             value="{{ old('nama_rt', $rt->nama_rt) }}" required>
    </div>

    <div class="text-end mt-4">
      <button type="submit" class="btn btn-success px-4">
        <i class="bi bi-save me-1"></i> Simpan Perubahan
      </button>
      <a href="{{ route('rw.show', $rw->id_rw) }}" class="btn btn-secondary">Batal</a>
    </div>
  </form>
</div>
@endsection
