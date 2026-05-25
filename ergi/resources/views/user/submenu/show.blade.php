@extends('layouts.user')

@section('title', $submenu->judul)

@section('content')
<div class="container">
  <!-- Judul -->
  <div class="text-center mb-5">
    <h4 class="fw-bold text-white py-2 px-4"
        style="background-color: #014421; border-radius: 4px; display: inline-block; width: 100%;">
      {{ $submenu->menu->nama_menu ?? 'Submenu' }}
    </h4>
  </div>

  <div class="text-center mb-5">
    <h3 class="fw-bold" style="margin-top: 40px;">{{ $submenu->judul }}</h3>
    <hr style="width: 100px; border: 2px solid #e67e22; margin: 0 auto 15px auto;">
    <p style="font-size: 1rem; max-width: 700px; margin: 0 auto;">
      {!! $submenu->isi !!}
    </p>
  </div>
</div>
@endsection
