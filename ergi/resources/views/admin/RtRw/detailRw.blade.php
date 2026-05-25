@extends('layouts.admin')

@section('title', 'Detail RW')

@section('content')
<div class="container mt-5">
  <h3 class="text-[#0D4715] fw-bold mb-3">Detail RW - {{ $rw->no_rw }}</h3>
  <div class="card p-4 shadow-sm mb-4">
    <p><strong>Nomor RW:</strong> {{ $rw->no_rw }}</p>
    <p><strong>Nama RW:</strong> {{ $rw->nama_rw }}</p>
  </div>

  <h5 class="fw-bold text-[#0D4715] mb-3">Daftar RT di RW ini:</h5>
  @if($rw->rt->isEmpty())
    <p class="text-muted">Belum ada data RT untuk RW ini.</p>
  @else
    <table class="table table-bordered">
      <thead class="table-success">
        <tr>
          <th>No</th>
          <th>Nomor RT</th>
          <th>Nama RT</th>
        </tr>
      </thead>
      <tbody>
        @foreach($rw->rt as $index => $rt)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $rt->no_rt }}</td>
            <td>{{ $rt->nama_rt }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @endif

  <a href="{{ route('rw.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
