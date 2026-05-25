@extends('layouts.admin')

@section('title', 'Tambah Subkategori Statistik')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-[#0D4715] text-2xl font-bold mb-4">Tambah Subkategori untuk {{ $kategori->nama_kategori }}</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('subkategori-statistik.store') }}">
        @csrf
        <input type="hidden" name="id_kategori" value="{{ $id_kategori }}">

        <div class="mb-4">
            <label for="nama_subkategori" class="form-label font-weight-bold">Nama Subkategori</label>
            <input type="text" name="nama_subkategori" id="nama_subkategori" class="form-control" value="{{ old('nama_subkategori') }}" required>
        </div>

        <div class="mb-4">
            <label for="kategori" class="form-label font-weight-bold">Kategori</label>
            <input type="text" id="kategori" class="form-control" value="{{ $kategori->nama_kategori }}" disabled>
        </div>

        <button type="submit" class="btn btn-success">Simpan Subkategori</button>
        <a href="{{ route('subkategori-statistik.index', $id_kategori) }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
