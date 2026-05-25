@extends('layouts.admin')

@section('title', 'Edit Subkategori Statistik')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">

    <h2 class="text-[#0D4715] text-center text-2xl font-bold mb-4">
        Edit Subkategori
    </h2>

    {{-- Pesan error --}}
    @if($errors->any())
        <div class="alert alert-danger text-center">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('subkategori-statistik.update', $subkategori->id_subkategori) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_subkategori" class="form-label fw-semibold">Nama Subkategori Statistik</label>
            <input type="text" name="nama_subkategori" id="nama_subkategori" class="form-control w-100"
                   value="{{ old('nama_subkategori', $subkategori->nama_subkategori) }}" required>
        </div>

        <div class="text-end mt-4">
            <button type="submit" class="btn btn-success px-4">
                <i class="bi bi-save me-1"></i> Simpan Perubahan
            </button>
            <a href="{{ route('subkategori-statistik.index', ['id_kategori' => $subkategori->id_kategori]) }}" 
               class="btn btn-secondary px-4 ms-2">
                <i class="bi bi-x-circle me-1"></i> Batal
            </a>
        </div>
    </form>

</div>
@endsection
