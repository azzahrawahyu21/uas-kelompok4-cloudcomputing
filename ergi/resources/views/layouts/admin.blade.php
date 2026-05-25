<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Admin Panel')</title>

  {{-- Bootstrap & Tailwind --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>

  @stack('styles')
</head>
<body class="bg-gray-50">

  {{-- Navbar + Sidebar --}}
  @include('admin.sidebar')

  {{-- Konten Utama --}}
  <main class="ml-64 p-6 main-content">
    @yield('content')
  </main>

  <style>
    .main-content {
      margin-top: 85px; /* memberi jarak dari navbar fixed-top */
    }

    @media (max-width: 1024px) {
      .main-content {
        margin-left: 0;
        padding: 1rem;
      }
    }
  </style>

  @stack('scripts')
</body>
</html>
