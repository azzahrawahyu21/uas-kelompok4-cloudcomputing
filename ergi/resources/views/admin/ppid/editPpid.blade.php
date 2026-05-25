{{-- resources/views/admin/ppid/editPpid.blade.php --}}
@extends('layouts.admin')

@section('title', 'Edit Dokumen PPID')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">

    {{-- BREADCRUMB 4 LEVEL --}}
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <div>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('jenis-ppid.index') }}" class="text-[#0D4715] fw-semibold text-decoration-none">
                        Jenis PPID
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('judul-ppid.index', $ppid->judul->id_jenis_ppid) }}" 
                       class="text-[#0D4715] fw-semibold text-decoration-none">
                        {{ $ppid->judul->jenis->nama_jenis_ppid }}
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('ppid.index', $ppid->id_judul) }}" 
                       class="text-[#0D4715] fw-semibold text-decoration-none">
                        {{ $ppid->judul->judul }}
                    </a>
                </li>
                <li class="breadcrumb-item active text-muted" aria-current="page">
                    Edit Dokumen
                </li>
            </ol>
        </div>
    </div>

    {{-- JUDUL HALAMAN --}}
    <h2 class="text-[#0D4715] text-2xl fw-bold mb-4">
        Edit Dokumen - {{ $ppid->judul->judul }}
    </h2>

    {{-- ALERT --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- FORM EDIT DOKUMEN --}}
    <form action="{{ route('ppid.update', $ppid->id_ppid) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label fw-bold">Tanggal <span class="text-danger">*</span></label>
            <input type="date" name="tanggal" class="form-control" 
                   value="{{ old('tanggal', $ppid->tanggal) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Tentang <span class="text-danger">*</span></label>
            <textarea name="tentang" class="form-control" rows="4" required>{{ old('tentang', $ppid->tentang) }}</textarea>
        </div>

        {{-- FILE PDF (GANTI VIA ELFINDER) --}}
        <div class="mb-3">
            <label class="form-label fw-bold">File PDF Saat Ini</label>
            <div class="input-group mb-2">
                <input type="text" class="form-control" 
                       value="{{ basename($ppid->file) }}" readonly>
                <a href="{{ $ppid->file }}" target="_blank" class="btn btn-outline-primary">
                    Lihat
                </a>
            </div>
            <small class="text-muted">Klik tombol di bawah untuk ganti file</small>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Ganti File PDF</label>
            <div class="input-group">
                <input type="hidden" name="file_url" id="file_url">
                <input type="text" name="file" id="file" class="form-control" 
                       placeholder="Pilih file PDF baru..." readonly>
                <button type="button" class="btn btn-secondary" id="btnBrowsePdf">
                    Pilih PDF
                </button>
            </div>
            <small class="text-muted">Kosongkan jika tidak ingin ganti file</small>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">
                Simpan Perubahan
            </button>
            <a href="{{ route('ppid.index', $ppid->id_judul) }}" class="btn btn-secondary">
                Batal
            </a>
        </div>
    </form>
</div>

{{-- SCRIPT ELFINDER --}}
<script>
    function processSelectedFile(file) {
        const fileName = file.url.split('/').pop();
        if (!fileName.toLowerCase().endsWith('.pdf')) {
            alert('Harap pilih file PDF!');
            return;
        }
        document.getElementById('file').value = fileName;
        document.getElementById('file_url').value = file.url;
    }

    document.getElementById('btnBrowsePdf').addEventListener('click', function() {
        window.open('/elfinder/popup/pdf', 'FileManager', 'width=900,height=600');
    });
</script>
@endsection