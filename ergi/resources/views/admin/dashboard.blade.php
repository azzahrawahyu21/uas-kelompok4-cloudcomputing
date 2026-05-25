<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    body { background-color: #fffff; }
    .navbar {
      background-color: #ffffff;
      border-radius: 0 0 0 0;
    }
    .navbar-brand span { color: #0D4715; }

    .main-content {
      margin-left: 260px;
      padding: 100px 40px;
    }

    .underline {
      width: 192px;
      height: 3px;
      background-color: #f97316;
      border-radius: 2px;
      margin-top: 6px;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg fixed-top py-2">
    <div class="container d-flex justify-content-between align-items-center">
      <a class="navbar-brand fw-bold text-dark d-flex align-items-center" href="#">
        <img src="{{ asset('assets/img/navbar/logo 1.png') }}" alt="Logo Desa" width="40" class="me-2">
        <div class="d-flex flex-column">
          <span style="font-size: 0.95rem; font-weight: 600;">Desa Driyorejo</span>
          <small style="font-size: 0.75rem; font-weight: 400; color: #555;">
            Kec. Driyorejo Kab. Magetan
          </small>
        </div>
      </a>

      <form method="POST" action="{{ route('logout') }}" class="logout-btn m-0">
        @csrf
        <button type="submit" class="rounded-pill bg-[#0D4715] text-white px-4 py-2 fw-semibold border-0">
          <i class="bi bi-box-arrow-right me-1"></i> Logout
        </button>
      </form>
    </div>
  </nav>

  <!-- Sidebar -->
  @include('admin.sidebar')

  <!-- Konten utama -->
  <main class="main-content">
    <h4 class="fw-bold text-[#0D4715]" style="font-size: 28px;">DASHBOARD ADMIN</h4>
    <p style="font-size: 18px; font-weight: 500; color: #0D4715;">
      Selamat datang,
      <span style="color: #f97316; font-weight: 600;">
        {{ auth()->user()->nama_pengguna }}
      </span>
    </p>
    <div class="underline mb-6"></div>

    <div class="bg-white p-6 rounded-xl shadow-md border border-gray-200">
      <h5 class="fw-bold mb-3 text-[#0D4715]">Selamat Datang di Sistem Desa Driyorejo</h5>
      <p class="text-gray-600">Silakan pilih menu di sidebar untuk melanjutkan.</p>
    </div>
  </main>

</body>
</html>