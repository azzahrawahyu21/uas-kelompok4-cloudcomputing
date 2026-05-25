@extends('layouts.admin')

@section('title', 'Detail Subkategori Statistik')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
  {{-- Breadcrumb --}}
  <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
      <div>
          <ol class="breadcrumb mb-0">
              <li class="breadcrumb-item">
                  <a href="{{ route('kategori-statistik.index') }}" class="text-[#0D4715] fw-semibold text-decoration-none">
                      <i class="bi bi-arrow-left-circle me-1"></i> Kategori Statistik
                  </a>
              </li>
              <li class="breadcrumb-item">
                  <a href="{{ route('subkategori-statistik.index', $subkategori->id_kategori) }}" class="text-[#0D4715] fw-semibold text-decoration-none">
                      Daftar Subkategori - {{ $subkategori->kategori->nama_kategori ?? '-' }}
                  </a>
              </li>
              <li class="breadcrumb-item active text-muted" aria-current="page">
                  Detail Subkategori - {{ $subkategori->nama_subkategori }}
              </li>
          </ol>
      </div>
  </div>
  <h2 class="text-[#0D4715] text-2xl font-bold mb-4">
    Detail Subkategori: {{ $subkategori->nama_subkategori }}
  </h2>
  <p><strong>Kategori:</strong> {{ $subkategori->kategori->nama_kategori ?? '-' }}</p>

  {{-- Form Tambah Data Statistik --}}
  <form action="{{ route('data-statistik.store') }}" method="POST" class="mb-4">
    @csrf
    <input type="hidden" name="id_subkategori" value="{{ $subkategori->id_subkategori }}">

    <div class="row g-3 align-items-end">
      <div class="col-md-4">
        <label for="tahun" class="form-label fw-semibold">Tahun</label>
        <input type="number" name="tahun" id="tahun" class="form-control" required>
      </div>
      <div class="col-md-4">
        <label for="jumlah" class="form-label fw-semibold">Jumlah</label>
        <input type="number" name="jumlah" id="jumlah" class="form-control" required>
      </div>
      <div class="col-md-4">
        <button type="submit" class="btn btn-success mt-3 w-100">
          <i class="bi bi-plus-circle"></i> Tambah Data
        </button>
      </div>
    </div>
  </form>

  {{-- Daftar Data Statistik --}}
  <div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
      <thead class="text-center table-success">
        <tr>
          <th>No</th>
          <th>Tahun</th>
          <th>Jumlah</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody class="text-center">
        @forelse($dataStatistik as $index => $data)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ \Carbon\Carbon::parse($data->tahun)->format('Y') }}</td>
            <td>{{ $data->jumlah }}</td>
            <td>
              {{-- Tombol Edit --}}
              <a href="{{ route('data-statistik.edit', $data->id_data) }}" class="btn btn-warning btn-sm">
                <i class="bi bi-pencil-square"></i> Edit
              </a>

              {{-- Tombol Hapus --}}
              <form action="{{ route('data-statistik.destroy', $data->id_data) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
            <td colspan="4" class="text-center text-muted">Belum ada data statistik.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
