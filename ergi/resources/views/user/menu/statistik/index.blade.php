@extends('layouts.user')

@section('content')
<div class="container py-5">
  <h2 class="text-center mb-4">Data Statistik Desa Driyorejo</h2>
  <div class="row">
    @foreach($kategoris as $kategori)
      <div class="col-md-4 mb-3">
        <a href="{{ route('user.statistik.kategori', $kategori->id_kategori) }}" class="card p-3 text-center shadow-sm">
          <h5 class="fw-semibold">{{ $kategori->nama_kategori }}</h5>
        </a>
      </div>
    @endforeach
  </div>
</div>
@endsection
