@extends('layouts.sidebar')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Data Pasien</h2>
            <a href="{{ route('pasien.create') }}" class="btn btn-success btn-sm">+ Tambah Data</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                @if(count($data) > 0)
<table class="table table-striped">
    <thead class="table-light">
        <tr>
            <th>Nama</th>
            <th>NIK</th>
            <th>Tanggal Lahir</th>
            <th>Alamat</th>
            <th>No HP</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $pasien)
            <tr>
                <td>{{ $pasien->nama }}</td>
                <td>{{ $pasien->nik }}</td>
                <td>{{ $pasien->tanggal_lahir }}</td>
                <td>{{ $pasien->alamat }}</td>
                <td>{{ $pasien->no_hp }}</td>
                <td class="d-flex gap-2">
                    <a href="{{ route('pasien.edit', $pasien->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('pasien.destroy', $pasien->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center text-muted">Belum ada data pasien.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endif
            </div>
        </div>
    </div>
@endsection
