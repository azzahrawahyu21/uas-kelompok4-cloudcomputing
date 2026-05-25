@extends('layouts.admin')

@section('title', 'Tambah Pejabat')

@section('content')
<div class="container">
    {{-- Breadcrumb --}}
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <div>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('jabatan.index') }}" class="text-[#0D4715] fw-semibold text-decoration-none">
                        <i class="bi bi-arrow-left-circle me-1"></i> Daftar Jabatan
                    </a>
                </li>

                @if($id_sub)
                    <li class="breadcrumb-item">
                        <a href="{{ route('subjabatan.index', $jabatan->id_jabatan) }}" class="text-[#0D4715] fw-semibold text-decoration-none">
                            Subjabatan
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('pejabat.index', [$jabatan->id_jabatan, $id_sub]) }}" class="text-[#0D4715] fw-semibold text-decoration-none">
                            Detail Subjabatan: {{ $subjabatan->nama_sub }}
                        </a>
                    </li>
                @else
                    <li class="breadcrumb-item">
                        <a href="{{ route('pejabat.index', $jabatan->id_jabatan) }}" class="text-[#0D4715] fw-semibold text-decoration-none">
                            {{ $jabatan->nama_jabatan }}
                        </a>
                    </li>
                @endif

                <li class="breadcrumb-item active text-muted" aria-current="page">Tambah Pejabat</li>
            </ol>
        </div>
    </div>

    <form action="{{ route('pejabat.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id_jabatan" value="{{ $jabatan->id_jabatan }}">
        <input type="hidden" name="id_sub" value="{{ $id_sub ?? null}}">

        <div class="mb-3">
            <label for="nama_pejabat" class="form-label fw-semibold">Nama Pejabat</label>
            <input type="text" name="nama_pejabat" class="form-control w-100" placeholder="Masukkan nama pejabat" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="5" class="form-control w-100" placeholder="Masukkan deskripsi"></textarea>
        </div>

<div class="mb-3">
    <label for="foto" class="form-label fw-semibold">File atau Gambar</label>
    <div class="input-group w-100">
        <input type="hidden" name="foto_url" id="foto_url">
        <input type="text" name="foto" id="foto" class="form-control" placeholder="Nama file (opsional)">
        <button type="button" class="btn btn-secondary" id="btnBrowse">Pilih dari ElFinder</button>
    </div>
    <div class="mt-3">
        <img id="previewImage" src="" alt="Preview" style="max-width: 200px; display:none; border: 1px solid #ccc; padding: 5px; border-radius: 8px;">
    </div>
</div>

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
    const fileName = file.url.split('/').pop();
    document.getElementById('foto').value = fileName;
    document.getElementById('foto_url').value = file.url;

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
  CKEDITOR.replace('deskripsi', {
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