<!-- Footer -->
<footer class="py-5 border-top" style="background-color: #0D4715; color: #ffffff;">
  <div class="container">
    <div class="row gy-4">
      
      <!-- Logo & Nama Desa -->
      <div class="col-lg-3 col-md-6 col-sm-12">
        <a class="d-flex align-items-center text-decoration-none mb-3" href="#">
          <img src="{{ asset('assets/img/navbar/logo 1.png') }}" alt="Logo Desa" width="60">
          <div>
            <span style="font-size: 1rem; font-weight: 600;">Desa Driyorejo</span><br>
            <small style="font-size: 0.85rem;">Kec. Driyorejo Kab. Magetan</small>
          </div>
        </a>
        <p style="font-size: 0.9rem;">
          Driyorejo, Nguntoronadi, Driyan, Driyorejo, Magetan, Jawa Timur 63383
        </p>
        <h6 class="fw-bold mt-3">Hubungi Kami</h6>
        <div style="width: 100px; height: 3px; background-color: #e67e22; margin: 5px 0 10px 0;"></div>
        <p class="mb-1"><i class="bi bi-telephone me-2"></i>0850000000</p>
        <p class="mb-0"><i class="bi bi-envelope me-2"></i>driyorejo@gmail.com</p>
      </div>

      <!-- Informasi -->
      <div class="col-lg-3 col-md-6 col-sm-12">
        <h6 class="fw-bold">Informasi</h6>
        <div style="width: 70px; height: 3px; background-color: #e67e22; margin: 5px 0 10px 0;"></div>
        <ul class="list-unstyled mb-0">
          <li><a href="{{ route('user.struktur.semua') }}" class="text-decoration-none text-white">Struktur Organisasi</a></li>
          <li><a href="{{ route('user.ppid.index') }}" class="text-decoration-none text-white">PPID</a></li>
          <li><a href="{{ route('user.berita.index') }}" class="text-decoration-none text-white">Berita</a></li>
          <li><a href="{{ route('user.galeri.index') }}" class="text-decoration-none text-white">Galeri</a></li>
        </ul>
      </div>

      <!-- Berita -->
      <div class="col-lg-3 col-md-6 col-sm-12">
        <h6 class="fw-bold">Berita dan Update Desa Driyorejo</h6>
        <div style="width: 180px; height: 3px; background-color: #e67e22; margin: 5px 0 10px 0;"></div>
        <p style="font-size: 0.9rem;">
          Berita, artikel, dan program terbaru dari warga bisa disampaikan lewat kontak yang tersedia.
        </p>
      </div>

      <!-- Lokasi -->
      <div class="col-lg-3 col-md-6 col-sm-12">
        <h6 class="fw-bold mb-2">Lokasi</h6>
        <div style="width: 60px; height: 3px; background-color: #e67e22; margin: 5px 0 10px 0;"></div>
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.936143982015!2d111.36903291477503!3d-7.669545994445763!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e79c7b97d6d6eab%3A0x3a8c945e92d3b3da!2sDriyorejo%2C%20Magetan%2C%20East%20Java%2C%20Indonesia!5e0!3m2!1sen!2sid!4v1701290071920!5m2!1sen!2sid"
          width="100%"
          height="200"
          style="border:0; border-radius:15px; box-shadow: 0 4px 15px rgba(0,0,0,0.2);"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
        ></iframe>
      </div>

    </div>

    <!-- Copyright -->
    <div class="text-center pt-4 border-top mt-4" style="border-color: #ffffff !important;">
      <small>&copy; 2025 Desa Driyorejo. Semua Hak Dilindungi.</small>
    </div>
  </div>
</footer>
