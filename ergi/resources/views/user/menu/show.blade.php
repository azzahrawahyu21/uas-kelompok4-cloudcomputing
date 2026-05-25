@extends('layouts.user')
@section('title', $menu->nama_menu)

@section('content')
<div class="header-section text-white d-flex flex-column justify-content-center text-center"
    style="height: 20vh; background: url('{{ asset('assets/img/background.jpg') }}') center/cover no-repeat; position: relative;">
    
    <div style="position:absolute; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.45);"></div>

    <h1 class="fw-bold position-relative" style="z-index: 2; font-size:30px;">
        {{ $menu->nama_menu }}
    </h1>
</div>

{{-- CEK ADA FOTO ATAU TIDAK --}}
@php 
    $adaFoto = $submenus->contains(function($s) {
        return !empty($s->foto) && file_exists(public_path('ufiles/' . $s->foto));
    });
@endphp

@if($adaFoto) 
  <div class="container submenu-container">
      <div class="row justify-content-center">
          <div class="col-lg-11">
              @foreach($submenus as $submenu)
                  <div class="border border-success rounded p-4 bg-white mb-5 shadow submenu-box">

                      <h4 class="fw-bold mb-2 text-success text-center">{{ $submenu->judul }}</h4>
                      <div class="mx-auto mb-4" style="width: 90px; height: 4px; background-color: #e67e22;"></div>

                      <div class="row align-items-start g-5 submenu-row">
                          @if($submenu->foto && file_exists(public_path('ufiles/' . $submenu->foto)))
                            <div class="col-md-5 d-flex justify-content-center">
                                <img src="{{ asset('ufiles/' . $submenu->foto) }}"
                                    alt="{{ $submenu->judul }}"
                                    class="img-fluid rounded-3 shadow-sm w-100"
                                    style="max-height: 400px; object-fit: cover;">
                            </div>
                            <div class="col-md-7">
                              <div class="bg-white border border-success-subtle rounded-4 shadow-sm p-4 text-break overflow-auto submenu-content"
                                   style="max-height: 420px;">
                                {!! $submenu->isi !!}
                              </div>
                            </div>
                          @else
                            <div class="col-12">
                                <div class="bg-white border border-success-subtle rounded-4 shadow-sm p-4 text-center submenu-content">
                                    {!! $submenu->isi !!}
                                </div>
                            </div>
                          @endif
                      </div>
                  </div>
              @endforeach
          </div>
      </div>
  </div>
@else
  <div class="text-center submenu-container">
      <div class="mx-auto" style="max-width: 800px;">
          @foreach($submenus as $submenu)
              <div class="mb-5 submenu-box">
                  <h3 class="fw-bold text-success" style="margin-top: 20px;">
                      {{ $submenu->judul }}
                  </h3>
                  <hr style="width: 100px; height: 4px; background-color: #e67e22; border: none; margin: 15px auto;">
                  <div class="bg-white border border-success-subtle rounded-4 shadow-sm p-4 submenu-content">
                      {!! $submenu->isi !!}
                  </div>
              </div>
          @endforeach
      </div>
  </div>
@endif

<style>
  /* Umum */
  .submenu-container {
    margin-top: -150px;
    padding-top: 180px;
    margin-bottom: 50px;
  }

  .submenu-box {
    box-shadow: 0 4px 20px rgba(13,71,21,0.15);
  }

  /* RESPONSIF UNTUK HP */
  @media (max-width: 768px) {
    .submenu-container {
      margin-top: -100px;
      padding-top: 120px;
      padding-left: 1rem;
      padding-right: 1rem;
    }
    .submenu-row {
      flex-direction: column;
      text-align: center;
    }
    .submenu-content {
      max-height: unset !important;
      padding: 1.2rem;
      text-align: justify;
    }
    .submenu-box {
      padding: 1.2rem !important;
    }
    img.img-fluid {
      width: 90% !important;
      max-height: 250px !important;
      margin-bottom: 1rem;
    }
  }

  /* RESPONSIF UNTUK HP KECIL BANGET (320px - 480px) */
  @media (max-width: 480px) {
    .submenu-container {
      padding-left: 0.8rem;
      padding-right: 0.8rem;
    }
    h4, h3 {
      font-size: 18px;
    }
    .submenu-content {
      font-size: 0.9rem;
    }
  }
</style>
@endsection
