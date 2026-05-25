@extends('admin.dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h5>Data Statistik</h5>
</div>

@if (session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card mb-4">
  <div class="card-header">
    <h6>{{ isset($editData) ? 'Edit Data Statistik' : 'Tambah Data Statistik' }}</h6>
  </div>
  <div class="card-body">
    <form action="{{ isset($editData) ? route('data.update', $editData->id_data) : route('data-statistik.store') }}" method="POST">
      @csrf
      @if(isset($editData))
        @method('PUT')
      @endif

      <div class="row">
        <div class="col-md-4 mb-3">
          <label class="form-label">Subkategori</label>
          <select name="id_subkategori" class="form-select" required>
            <option value="">-- Pilih Subkategori --</option>
            @foreach ($subkategori as $sub)
              <option value="{{ $sub->id_subkategori }}"
                {{ isset($editData) && $editData->id_subkategori == $sub->id_subkategori ? 'selected' : '' }}>
                {{ $sub->nama_subkategori }}
              </option>
            @endforeach
          </select>
        </div>
        <div class="col-md-4 mb-3">
          <label class="form-label">Jumlah</label>
          <input type="number" name="jumlah" class="form-control" value="{{ $editData->jumlah ?? old('jumlah') }}" required>
        </div>
        <div class="col-md-4 mb-3">
          <label class="form-label">Tahun</label>
          <input type="number" name="tahun" class="form-control" value="{{ $editData->tahun ?? old('tahun') }}" required>
        </div>
      </div>

      <button type="submit" class="btn btn-success">
        {{ isset($editData) ? 'Perbarui' : 'Tambah' }}
      </button>

      @if(isset($editData))
        <a href="{{ route('data.index') }}" class="btn btn-secondary">Batal</a>
      @endif
    </form>
  </div>
</div>

<table class="table table-striped">
  <thead>
    <tr>
      <th>No</th>
      <th>Subkategori</th>
      <th>Jumlah</th>
      <th>Tahun</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($dataStatistik as $index => $item)
    <tr>
      <td>{{ $index + 1 }}</td>
      <td>{{ $item->subkategori->nama_subkategori ?? '-' }}</td>
      <td>{{ $item->jumlah }}</td>
      <td>{{ $item->tahun }}</td>
      <td>
        <a href="{{ route('data-statistik.index', ['edit' => $item->id_data]) }}" class="btn btn-warning btn-sm">Edit</a>
        <form action="{{ route('data-statistik.destroy', $item->id_data) }}" method="POST" style="display:inline;">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</button>
        </form>
      </td>
    </tr>
    @empty
    <tr><td colspan="5" class="text-center">Belum ada data</td></tr>
    @endforelse
  </tbody>
</table>
@endsection