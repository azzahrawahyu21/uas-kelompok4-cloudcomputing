@extends('layouts.admin')

@section('title', 'Detail RW')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
  {{-- Breadcrumb --}}
  <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
    <div>
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item">
          <a href="{{ route('rw.index') }}" class="text-[#0D4715] fw-semibold text-decoration-none">
            <i class="bi bi-arrow-left-circle me-1"></i> Daftar RT/RW
          </a>
        </li>
        <li class="breadcrumb-item active text-muted" aria-current="page">
          Detail RW - {{ $rw->no_rw }}
        </li>
      </ol>
    </div>
  </div>

  {{-- Detail RW --}}
  <div class="container mt-4">
    <h3 class="text-[#0D4715] fw-bold" style="font-size: 25px;">Detail RW</h3>
    <div class="card mt-3 mb-4">
      <div class="card-body">
        <p><strong>Nomor RW:</strong> {{ $rw->no_rw }}</p>
        <p><strong>Nama Ketua RW:</strong> {{ $rw->nama_rw }}</p>
      </div>
    </div>

    {{-- Bagian RT --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h3 class="text-[#0D4715] fw-bold" style="font-size: 20px;">Daftar RT di RW {{ $rw->no_rw }}</h3>
      <a href="{{ route('rt.create', ['id_rw' => $rw->id_rw]) }}" class="btn btn-success">
        <i class="bi bi-plus-circle me-2"></i> Tambah RT
      </a>
    </div>

    <div class="card-body">
      @if($rts->isEmpty())
        <p class="text-center text-muted">Belum ada data RT untuk RW ini.</p>
      @else
        <table class="table table-bordered">
          <thead class="table-success">
            <tr>
              <th>No</th>
              <th>Nomor RT</th>
              <th>Nama Ketua RT</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($rts as $index => $rt)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $rt->no_rt }}</td>
                <td>{{ $rt->nama_rt }}</td>
                <td class="text-center">
                  {{-- Tombol Edit --}}
                  <a href="{{ route('rt.edit', ['id_rw' => $rw->id_rw, 'id_rt' => $rt->id_rt]) }}" 
                    class="btn btn-warning btn-sm me-1">
                    <i class="bi bi-pencil-square"></i> Edit
                  </a>

                  {{-- Tombol Hapus --}}
                  <form action="{{ route('rt.destroy', ['id_rw' => $rw->id_rw, 'id_rt' => $rt->id_rt]) }}" 
                        method="POST" class="d-inline" 
                        onsubmit="return confirm('Yakin ingin menghapus RT ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm me-1">
                      <i class="bi bi-trash"></i> Hapus
                    </button>
                  </form>
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
