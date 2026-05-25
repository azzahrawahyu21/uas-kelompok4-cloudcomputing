@extends('layouts.admin')

@section('title', 'Tambah Dokumen')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    {{-- BREADCRUMB 4 LEVEL --}}
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <div>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('jenis-ppid.index') }}" class="text-[#0D4715] fw-semibold text-decoration-none">
                        <i class="bi bi-arrow-left-circle me-1"></i> Jenis PPID
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('judul-ppid.index', $judul->id_jenis_ppid) }}" 
                       class="text-[#0D4715] fw-semibold text-decoration-none">
                        {{ $jenis->nama_jenis_ppid }}
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('ppid.index', $judul->id_judul) }}" 
                       class="text-[#0D4715] fw-semibold text-decoration-none">
                        {{ $judul->judul }}
                    </a>
                </li>
                <li class="breadcrumb-item active text-muted" aria-current="page">
                    Tambah Dokumen
                </li>
            </ol>
        </div>
    </div>

    <h2 class="text-[#0D4715] text-2xl fw-bold mb-4">
        Tambah Dokumen - {{ $judul->judul }}
    </h2>

    <form action="{{ route('ppid.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id_judul" value="{{ $judul->id_judul }}">

        <div class="mb-3">
            <label class="form-label fw-bold">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Tentang</label>
            <textarea name="tentang" class="form-control" rows="3" required></textarea>
        </div>

        {{-- ELFINDER UNTUK PDF --}}
        <div class="mb-3">
            <label class="form-label fw-bold">File PDF</label>
            <div class="input-group">
                <input type="hidden" name="file_url" id="file_url">
                <input type="text" name="file" id="file" class="form-control" placeholder="Pilih file PDF..." readonly required>
                <button type="button" class="btn btn-secondary" id="btnBrowsePdf">
                    Pilih PDF
                </button>
            </div>
            <small class="text-muted">Klik tombol untuk memilih PDF dari ElFinder</small>
        </div>

        <button type="submit" class="btn btn-success">
            Simpan Dokumen
        </button>
    </form>
</div>

{{-- SCRIPT ELFINDER UNTUK PDF --}}
<script>
    function processSelectedFile(file) {
        // Ambil nama file
        const fileName = file.url.split('/').pop();

        // Cek apakah PDF
        if (!fileName.toLowerCase().endsWith('.pdf')) {
            alert('Harap pilih file PDF!');
            return;
        }

        // Isi input
        document.getElementById('file').value = fileName;
        document.getElementById('file_url').value = file.url;
    }

    document.getElementById('btnBrowsePdf').addEventListener('click', function() {
        // Buka ElFinder popup, filter hanya PDF
        window.open('/elfinder/popup/pdf', 'FileManager', 'width=900,height=600');
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