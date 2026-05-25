@extends('layouts.admin')

@section('title', 'Tambah Subjabatan')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">

    <h2 class="text-2xl font-bold mb-4 text-[#0D4715]">
        Tambah Subjabatan untuk: {{ $jabatan->nama_jabatan }}
    </h2>

    {{-- Pesan Error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('subjabatan.store', $jabatan->id_jabatan) }}" method="POST">
        @csrf

        {{-- Nama Subjabatan --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Nama Subjabatan</label>
            <input type="text" name="nama_sub" class="form-control" placeholder="Contoh: RW 1" required>
        </div>

        {{-- Parent ID / Subjabatan Induk --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Induk (Parent Sub)</label>

            <select name="parent_id" class="form-select">
                <option value="">— Tidak Ada (Root) —</option>

                @foreach ($subJabatan as $sub)
                    <option value="{{ $sub->id_sub }}">{{ $sub->nama_sub }}</option>
                @endforeach
            </select>

            <small class="text-muted">
                *Jika ini adalah RW → tidak pilih parent.  
                *Jika RT → pilih parent RW-nya.
            </small>
        </div>

        {{-- Tombol --}}
        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('subjabatan.index', $jabatan->id_jabatan) }}" class="btn btn-secondary">
                Kembali
            </a>

            <button type="submit" class="btn btn-success">
                Simpan Subjabatan
            </button>
        </div>
    </form>
</div>
@endsection
