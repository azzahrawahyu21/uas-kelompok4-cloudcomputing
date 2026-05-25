@extends('layouts.admin')

@section('title', 'Edit Submenu')

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
        <li class="breadcrumb-item active text-muted" aria-current="page">Edit Submenu</li>
      </ol>
    </div>
  </div>

  {{-- Judul Halaman --}}
  <h2 class="text-[#0D4715] text-center text-2xl font-bold mb-4">Edit Submenu</h2>

  {{-- Pesan Sukses/Error --}}
  @if(session('success'))
    <div class="alert alert-success text-center">{{ session('success') }}</div>
  @elseif(session('error'))
    <div class="alert alert-danger text-center">{{ session('error') }}</div>
  @endif

  {{-- Form Edit Submenu --}}
  <form action="{{ route('submenu.update', [$menu->id_menu, $submenu->id_submenu]) }}" method="POST">
    @csrf
    @method('PUT')

    {{-- Input Judul --}}
    <div class="mb-3">
      <label for="judul" class="form-label fw-semibold">Judul</label>
      <input
        type="text"
        name="judul"
        id="judul"
        class="form-control w-100"
        placeholder="Masukkan judul submenu"
        value="{{ old('judul', $submenu->judul) }}"
        required
      >
    </div>

    {{-- Input Isi --}}
    <div class="mb-3">
      <label for="isi" class="form-label fw-semibold">Isi</label>
      <textarea
        name="isi"
        id="isi"
        rows="6"
        class="form-control w-100"
        placeholder="Masukkan isi submenu"
      >{{ old('isi', $submenu->isi) }}</textarea>
    </div>

    {{-- Input Foto --}}
    <div class="mb-3">
      <label for="foto" class="form-label fw-semibold">File atau Gambar</label>
      <div class="input-group w-100">
        <input type="hidden" name="foto_url" id="foto_url" value="{{ old('foto_url', $submenu->foto) }}"> <!-- URL lengkap -->
        <input type="text" name="foto" id="foto" class="form-control" placeholder="Nama file (opsional)" value="{{ basename($submenu->foto) }}">
        <button type="button" class="btn btn-secondary" id="btnBrowse">
          <i class="bi bi-folder2-open"></i> Pilih dari ElFinder
        </button>
      </div>

      {{-- Preview Gambar --}}
      <div class="mt-3">
        <img id="previewImage"
             src="{{ $submenu->foto ? $submenu->foto : '' }}"
             alt="Preview"
             style="max-width: 200px; display: {{ $submenu->foto ? 'block' : 'none' }}; border: 1px solid #ccc; padding: 5px; border-radius: 8px;">
      </div>
    </div>

    {{-- Tombol Simpan --}}
    <div class="text-end mt-4">
      <button type="submit" class="btn btn-success px-4">
        <i class="bi bi-save me-1"></i> Simpan Perubahan
      </button>
    </div>
  </form>
</div>

{{-- Script CKEditor & ElFinder --}}
<script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  // ✅ CKEditor untuk textarea "isi"
  CKEDITOR.replace('isi', {
      filebrowserBrowseUrl: '/elfinder/ckeditor', // Integrasi dengan elfinder
      extraPlugins: 'colorbutton,font',
      toolbar: [
          { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'Undo', 'Redo'] },
          { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike'] },
          { name: 'paragraph', items: ['NumberedList', 'BulletedList'] },
          { name: 'links', items: ['Link', 'Unlink'] },
          { name: 'insert', items: ['Image', 'Table'] },
          { name: 'styles', items: ['Format', 'Font', 'FontSize'] },
          { name: 'colors', items: ['TextColor', 'BGColor'] },
          { name: 'tools', items: ['Maximize'] }
      ]
  });

  // Matikan warning CKEditor di console
  CKEDITOR.config.versionCheck = false;
  console.warn = function(msg) {
    if (msg.includes("CKEditor 4.22.1 version is not secure")) return;
    console.log(msg);
  };


  // ✅ ElFinder file picker
  function processSelectedFile(file) {
      const fileName = file.url.split('/').pop();
      document.getElementById('foto').value = fileName;
      document.getElementById('foto_url').value = file.url;

      // Preview Gambar
      const preview = document.getElementById('previewImage');
      preview.src = file.url;
      preview.style.display = 'block';
  }

  document.getElementById('btnBrowse').addEventListener('click', function() {
      window.open('/elfinder/popup/foto', 'FileManager', 'width=900,height=600');
  });
</script>
@endsection
