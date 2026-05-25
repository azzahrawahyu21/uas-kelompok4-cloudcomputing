@extends('layouts.admin')

@section('title', 'Edit RW')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
  {{-- Breadcrumb --}}
  <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
    <div>
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item">
          <a href="{{ route('rw.index') }}" class="text-[#0D4715] fw-semibold text-decoration-none">
            <i class="bi bi-arrow-left-circle me-1"></i>Edit RW
          </a>
        </li>
        <li class="breadcrumb-item active text-muted" aria-current="page">
          @isset($rw)
            Edit RW - {{ $rw->no_rw }}
          @else
            Edit RW
          @endisset
        </li>
      </ol>
    </div>
  </div>
  <h3 class="text-[#0D4715] fw-bold mb-4">Edit RW</h3>
     <form action="{{ route('rw.update', $rw->id_rw) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="mb-3">
        <label for="no_rw" class="form-label">Nomor RW</label>
        <input type="text" name="no_rw" class="form-control" value="{{ $rw->no_rw }}" required>
      </div>
      <div class="mb-3">
        <label for="nama_rw" class="form-label">Nama Ketua RW</label>
        <input type="text" name="nama_rw" class="form-control" value="{{ $rw->nama_rw }}" required>
      </div>
       <div class="text-end mt-4">
            <button type="submit" class="btn btn-success px-4">
                <i class="bi bi-save me-1"></i> Simpan Perubahan
            </button>
      <a href="{{ route('rw.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
</div>
@endsection
