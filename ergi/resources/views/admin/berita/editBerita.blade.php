@extends('layouts.admin')

@section('title', 'Edit Berita')

@section('content')
<div class="container">
    {{-- Breadcrumb --}}
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <div>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('berita.index') }}" class="text-[#0D4715] fw-semibold text-decoration-none">
                        <i class="bi bi-arrow-left-circle me-1"></i> Daftar Berita
                    </a>
                </li>

                <li class="breadcrumb-item active text-muted" aria-current="page">Edit Berita</li>
            </ol>
        </div>
    </div>

    <form action="{{ route('berita.update', $berita->id_berita) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Judul --}}
        <div class="mb-3">
            <label for="judul" class="form-label fw-semibold">Judul</label>
            <input type="text" name="judul" class="form-control w-100" value="{{ $berita->judul }}" required>
        </div>

        {{-- Foto --}}
        <div class="mb-3">
            <label for="foto" class="form-label fw-semibold">File atau Gambar</label>
            <div class="input-group w-100">
                <input type="hidden" name="foto_url" id="foto_url" value="{{ asset('ufiles/'.$berita->foto) }}">
                <input type="text" name="foto" id="foto" class="form-control" value="{{ $berita->foto }}">
                <button type="button" class="btn btn-secondary" id="btnBrowse">Pilih dari ElFinder</button>
            </div>

            {{-- Preview foto --}}
            <div class="mt-3">
                @if($berita->foto)
                    <img id="previewImage" src="{{ asset('ufiles/'.$berita->foto) }}" alt="Preview"
                        style="max-width: 200px; display:block; border: 1px solid #ccc; padding: 5px; border-radius: 8px;">
                @else
                    <img id="previewImage" src="" alt="Preview"
                        style="max-width: 200px; display:none; border: 1px solid #ccc; padding: 5px; border-radius: 8px;">
                @endif
            </div>
        </div>

        {{-- Isi --}}
        <div class="mb-3">
            <label for="isi" class="form-label fw-semibold">Isi</label>
            <textarea name="isi" id="isi" rows="5" class="form-control w-100">{{ $berita->isi }}</textarea>
        </div>

        {{-- Tanggal --}}
        <div class="mb-3">
            <label for="tanggal" class="form-label fw-semibold">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control"
                value="{{ $berita->tanggal }}">
        </div>

        <div class="text-end mt-4">
            <button type="submit" class="btn btn-success px-4">
                <i class="bi bi-save me-1"></i> Update
            </button>
        </div>
    </form>
</div>

{{-- Script elFinder --}}
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

{{-- CKEditor --}}
<script>
CKEDITOR.replace('isi', {
    filebrowserBrowseUrl: '/elfinder/ckeditor',
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

// Matikan warning CKEditor
CKEDITOR.config.versionCheck = false;
console.warn = function(msg) {
    if (msg.includes("CKEditor 4.22.1 version is not secure")) return;
    console.log(msg);
};
</script>

@endsection
