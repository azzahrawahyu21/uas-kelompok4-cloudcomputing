@extends('layouts.admin')

@section('title', 'Tambah Submenu')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">

  {{-- Breadcrumb --}}
  <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
    <div>
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item">
          <a href="{{ route('submenu.kelola', $menu->id_menu) }}" class="text-[#0D4715] fw-semibold text-decoration-none">
            <i class="bi bi-arrow-left-circle me-1"></i> Kelola Submenu - {{ $menu->nama_menu }}
          </a>
        </li>
        <li class="breadcrumb-item active text-muted" aria-current="page">Tambah Submenu</li>
      </ol>
    </div>
  </div>

  {{-- Judul --}}
  <h2 class="text-[#0D4715] text-center text-2xl font-bold mb-4">
    Tambah Submenu untuk {{ $menu->nama_menu }}
  </h2>

  {{-- Alert sukses --}}
  @if(session('success'))
    <div class="alert alert-success text-center">{{ session('success') }}</div>
  @endif

  {{-- Form Tambah Submenu --}}
  <form action="{{ route('submenu.store', $menu->id_menu) }}" method="POST">
    @csrf

    {{-- Input Judul --}}
    <div class="mb-3">
      <label for="judul" class="form-label fw-semibold">Judul</label>
      <input
        type="text"
        name="judul"
        id="judul"
        class="form-control w-100"
        placeholder="Masukkan judul submenu"
        required
      >
    </div>

    {{-- Input Isi --}}
    <div class="mb-3">
      <label for="isi" class="form-label fw-semibold">Isi</label>
      <textarea
        name="isi"
        id="isi"
        rows="5"
        class="form-control w-100"
        placeholder="Tulis isi submenu di sini..."
      ></textarea>
    </div>

    {{-- Input Foto --}}
    <div class="mb-3">
      <label for="foto" class="form-label fw-semibold">File atau Gambar</label>
      <div class="input-group w-100">
        <input type="hidden" name="foto_url" id="foto_url"> <!-- URL lengkap -->
        <input type="text" name="foto" id="foto" class="form-control" placeholder="Nama file (opsional)">
        <button type="button" class="btn btn-secondary" id="btnBrowse">Pilih dari ElFinder</button>
      </div>

      <!-- Tempat preview gambar -->
      <div class="mt-3">
        <img id="previewImage" src="" alt="Preview" style="max-width: 200px; display:none; border: 1px solid #ccc; padding: 5px; border-radius: 8px;">
      </div>
    </div>


    {{-- Tombol Simpan --}}
    <div class="text-end mt-4">
      <button type="submit" class="btn btn-success px-4">
        <i class="bi bi-save me-1"></i> Simpan
      </button>
    </div>
  </form>
</div>

{{-- Script untuk ElFinder --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
<script>
  function processSelectedFile(file) {
      // Ambil nama file saja
      const fileName = file.url.split('/').pop(); 

      // Masukkan nama file ke input
      document.getElementById('foto').value = fileName;

      // Simpan URL lengkap di hidden input
      document.getElementById('foto_url').value = file.url;

      // Tampilkan preview gambar
      const preview = document.getElementById('previewImage');
      preview.src = file.url;
      preview.style.display = 'block';
  }

  document.getElementById('btnBrowse').addEventListener('click', function() {
      window.open('/elfinder/popup/foto', 'FileManager', 'width=900,height=600');
  });
</script>
<script>
  // Inisialisasi CKEditor pada textarea isi
  CKEDITOR.replace('isi', {
      filebrowserBrowseUrl: '/elfinder/ckeditor', // sambungkan dengan elfinder
      filebrowserImageBrowseUrl: '/elfinder/ckeditor', 
      filebrowserUploadUrl: '/elfinder/connector', 
      height: 300,
      toolbar: [
          { name: 'document', items: [ 'Source', '-', 'NewPage', 'Preview' ] },
          { name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', '-', 'Undo', 'Redo' ] },
          { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
          { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
          { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike' ] },
          { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
          { name: 'insert', items: [ 'Image', 'Link', 'Table', 'HorizontalRule' ] },
          { name: 'tools', items: [ 'Maximize' ] }
      ]
  });
</script>
<script>
  // Matikan warning CKEditor di console
  CKEDITOR.config.versionCheck = false;
  console.warn = function(msg) {
    if (msg.includes("CKEditor 4.22.1 version is not secure")) return;
    console.log(msg);
  };
</script>
@endsection