@extends('layouts.user')

@section('title', 'Desa Driyorejo')

@section('content')
<header class="header-2 position-relative">
  <div id="header-bg" style="height:60vh; position:relative; overflow:hidden;">
    <!-- Slide -->
    <div class="slide" style="background-image:url('{{ asset('assets/img/background.jpg') }}');"></div>
    <div class="slide" style="background-image:url('{{ asset('assets/img/image_desa.jpg') }}');"></div>
    <div class="slide" style="background-image:url('{{ asset('assets/img/image_profil_desa.jpg') }}');"></div>

    <!-- Overlay -->
    <div style="background: rgba(0,0,0,0.5); position:absolute; top:0; right:0; bottom:0; left:0; z-index:1;"></div>

    <!-- Teks -->
    <div class="container position-relative" style="z-index:2; text-align:center; color:white; top:50%; transform:translateY(-50%);">
      <h1 class="fw-bold" style="font-size: 35px;">Selamat Datang di Website Resmi Desa Driyorejo</h1>
      <p style="font-size: 25px;">Sumber informasi terbuka, pelayanan mudah, dan desa maju bersama.</p>
    </div>
  </div>
</header>

  {{-- Content --}}
<main class="position-relative mb-5">
  <div class="container container-custom my-5">
    <div class="row justify-content-center align-items-center">
      
    <!-- Kolom kiri: Profil teks -->
    <div class="col-md-6 mb-4 mb-md-0" style="max-width: 500px;">
      <h3 class="fw-bold mb-3" style="font-size: 20px;">
        Profil Desa
        <div style="width: 90px; height: 4px; background-color: #d35400; margin-top: 5px;"></div>
      </h3>

      <div class="mt-4">
        <p><strong>Nama Desa</strong> : Driyorejo</p>
        <p><strong>Luas Wilayah</strong> : ± 182,02 Hektar</p> 
        <p><strong>Letak Geografis</strong> : Terletak di Kecamatan Nguntoronadi, Kabupaten Magetan, Jawa Timur</p>
        <p><strong>Kode Pos</strong> : 63383</p>
        <p><strong>Kecamatan</strong> : Nguntoronadi</p>
        <p><strong>Kabupaten</strong> : Magetan</p>
      </div>
    </div>

    <div class="col-md-6 d-flex justify-content-center" style="max-width: 500px;">
      <div class="position-relative" style="display: inline-block; width: 100%; max-width: 400px;">
        <!-- Embed Google Maps -->
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.936143982015!2d111.36903291477503!3d-7.669545994445763!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e79c7b97d6d6eab%3A0x3a8c945e92d3b3da!2sDriyorejo%2C%20Magetan%2C%20East%20Java%2C%20Indonesia!5e0!3m2!1sen!2sid!4v1701290071920!5m2!1sen!2sid"
          width="100%"
          height="300"
          style="border:0; border-radius:15px; box-shadow: 0 4px 15px rgba(0,0,0,0.2);"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
        ></iframe>
      </div>
    </div>
  </div>

  <!-- Bagian Jam Kerja & SOTK -->
  <div class="container container-custom my-5">
    <div class="row justify-content-center mt-4">
      <!-- Jam Kerja -->
      <div class="col-md-3 mb-4 mb-md-0" style="max-width: 300px;">
        <div class="border border-success rounded p-3 text-center h-100">
          <h5 class="fw-bold mb-2" style="font-size: 20px;">Jam Kerja</h5>
          <div style="width: 90px; height: 4px; background-color: #2A774C; margin: 0 auto 15px auto;"></div>

          @php
            $jamkerja = [
              ['hari' => 'Senin', 'jam' => '08:00 - 15:00'],
              ['hari' => 'Selasa', 'jam' => '08:00 - 15:00'],
              ['hari' => 'Rabu', 'jam' => '08:00 - 15:00'],
              ['hari' => 'Kamis', 'jam' => '08:00 - 15:00'],
              ['hari' => 'Jumat', 'jam' => '08:00 - 15:00'],
              ['hari' => 'Sabtu', 'jam' => 'Libur'],
              ['hari' => 'Minggu', 'jam' => 'Libur']
            ];
          @endphp

          @foreach($jamkerja as $j)
            <div class="jamkerja-item">
              <span class="badge text-white" style="background-color:#e67e22;">{{ $j['hari'] }}</span>
              <span class="waktu">{{ $j['jam'] }}</span>
            </div>
          @endforeach
        </div>
      </div>

      <!-- SOTK -->
      <div class="col-md-8" style="max-width: 650px;">
        <div class="border border-success rounded sotk-card text-center h-100">
          <h5 class="fw-bold mb-2" style="font-size: 20px;">SOTK</h5>
          <div style="width: 90px; height: 4px; background-color: #2A774C; margin: 0 auto 15px auto;"></div>

          <img src="assets/img/sotknew.png" alt="Struktur Organisasi" 
              class="img-fluid mb-3" style="max-height: 330px; object-fit:contain;">

          <a href="#" class="btn btn-warning text-white fw-semibold"
            style="background-color: #e67e22; border:none;">
            Baca Selengkapnya
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bagian Berita -->
  <div class="container container-custom my-5">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h3 class="fw-bold mb-0" style="font-size: 20px;">Berita</h3>

        <a href="{{ route('user.berita.index') }}" 
            class="btn btn-warning text-white fw-semibold px-3 py-1"
            style="background-color: #e67e22; border: none;">
            Baca Selengkapnya
        </a>
    </div>

    <div style="width: 90px; height: 4px; background-color: #2A774C; margin-bottom: 25px;"></div>

    <!-- Scrollable Berita -->
    {{-- <div class="d-flex flex-nowrap overflow-auto pb-3 px-1" style="gap: 1rem; scroll-snap-type: x mandatory;"> --}}
    <div class="berita-wrapper d-flex flex-nowrap overflow-auto pb-3 px-1">
      @foreach($beritas as $b)
        <div class="col-md-4">
            <div class="card rounded-4 shadow-sm border-0 h-100 berita-card"
                    style="transition: .3s; cursor: pointer;"
                    onclick="window.location='{{ route('user.berita.show', $b->id_berita) }}'">

              {{-- Foto --}}
              <img src="{{ $b->foto ? asset('ufiles/'.$b->foto) : asset('noimage.png') }}"
                      class="card-img-top rounded-top-4"
                      style="height: 220px; object-fit: cover;">

              <div class="d-flex align-items-center text-muted" style="font-size: 15px; margin: 20px 0 0 10px ;">
                  <i class="bi bi-calendar-event" style="margin-right: 10px;"></i>
                  {{ \Carbon\Carbon::parse($b->tanggal)->locale('id')->translatedFormat('d F Y') }}
              </div>
              
              <hr class="my-2">

              <div class="card-body">
                <h5 class="fw-bold mb-2">
                    {{ Str::limit($b->judul, 70) }}
                </h5>
                <p class="text-muted mb-0" style="font-size: .9rem;">
                    {!! Str::words(strip_tags($b->isi), 20, '...') !!}
                </p>
              </div>

              <div class="p-3">
                <a href="{{ route('user.berita.show', $b->id_berita) }}"
                  class="fw-semibold"
                  style="color: #0D4715; text-decoration: none;">
                    Baca Selengkapnya →
                </a>
              </div>
            </div>
        </div>
      @endforeach
    </div>
  </div>
</main>

<style>
  /* -------------------- SLIDER -------------------- */
  #header-bg .slide {
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background-size:cover;
    background-position:center;
    opacity:0;
    transition: opacity 1s ease-in-out;
  }
  #header-bg .slide.active {
    opacity:1;
  }
  .header-section, #header-bg {
      min-height: 60vh; /* Bisa disesuaikan */
      position: relative;
  }

  .main-card-container {
      margin-top: -50px; /* atau 0, nanti kita atur dengan media queries */
      position: relative;
      z-index: 5;
  }

  /* -------------------- RESPONSIVE CONTAINER -------------------- */
  @media (max-width: 768px) {
      .container-custom {
          padding-left: 1rem !important;
          padding-right: 1rem !important;
      }

      #header-bg {
          height: 45vh !important;
      }
  }

  /* -------------------- JAM KERJA -------------------- */
  .jamkerja-item {
      display:flex;
      justify-content:space-between;
      align-items:center;
      margin-bottom: .6rem;
      gap: 10px;
  }
  .jamkerja-item .badge {
      font-size:.75rem;
      padding:.4rem .7rem;
  }
  .jamkerja-item .waktu {
      border:1px solid #e67e22;
      border-radius:20px;
      padding:.35rem .7rem;
      font-size:.75rem;
      white-space:nowrap;
  }

  @media(max-width:576px){
      .jamkerja-item .badge{
        font-size:.7rem;
        padding:.35rem .6rem;
      }
      .jamkerja-item .waktu{
        font-size:.7rem;
        padding:.3rem .6rem;
      }
  }

  /* -------------------- SOTK CARD -------------------- */
  .sotk-card {
      padding: 1.5rem;
  }
  @media(max-width:576px){
      .sotk-card { padding: 1rem; }
  }

  /* -------------------- BERITA: SCROLL RESPONSIVE -------------------- */
  .berita-scroll {
      gap: .9rem;
      padding-bottom: 1rem;
      scroll-snap-type: x mandatory;
  }
  .berita-card {
      min-width: 260px;
      scroll-snap-align: start;
  }
  /* @media(max-width:576px){
      .berita-card {
          min-width: 80%;
      }
  } */
  .berita-wrapper {
      gap: 1rem;
      scroll-snap-type: x mandatory;
      display: flex;
      flex-wrap: nowrap;
      overflow-x: auto;
  }

  /* Mobile → scroll ke bawah */
  @media (max-width: 576px) {
      .berita-wrapper {
          display: block !important;     /* ubah flex horizontal → block */
          overflow-x: hidden !important;
          overflow-y: auto !important;   /* scroll ke bawah */
          max-height: 550px;             /* biar bisa discroll */
      }

      .berita-wrapper .berita-card {
          min-width: 100% !important;    /* satu card per baris */
          margin-bottom: 1rem;
      }
  }

</style>

<script>
  const slides = document.querySelectorAll('#header-bg .slide');
  let currentIndex = 0;
  slides[currentIndex].classList.add('active');

  setInterval(() => {
      slides[currentIndex].classList.remove('active');
      currentIndex = (currentIndex + 1) % slides.length;
      slides[currentIndex].classList.add('active');
  }, 5000);
</script>
@endsection