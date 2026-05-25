@extends('layouts.admin')

@section('title', 'Daftar Subkategori')

@section('content')
<div class="container">
    <h2>Daftar Subkategori</h2>

    <label for="kategori">Filter Kategori:</label>
    <select id="kategori" class="form-control">
        <option value="">-- Semua Kategori --</option>
        @foreach ($kategoriAdmin as $kategori)
            <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
        @endforeach
    </select>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Subkategori</th>
                <th>Kategori</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subkategori as $key => $sub)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $sub->nama_subkategori }}</td>
                    <td>{{ $sub->kategori->nama_kategori }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    // Optional: filter subkategori saat kategori dipilih
    document.getElementById('kategori').addEventListener('change', function() {
        const kategoriId = this.value;
        window.location.href = kategoriId ? `/admin/subkategori?kategori=${kategoriId}` : '/admin/subkategori';
    });
</script>
@endsection
