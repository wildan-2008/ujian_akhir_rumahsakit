@extends('layouts.sidebar')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Data Dokter</h2>
        <a href="{{ route('dokter.create') }}" class="btn btn-success btn-sm">+ Tambah Dokter</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-striped">
                <thead class="table-light">
                    <tr>
                        <th>Nama</th>
                        <th>Spesialisasi</th>
                        <th>Jadwal Praktek</th>
                        <th>No. STR</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $doctor)
                        <tr>
                            <td>{{ $doctor->nama }}</td>
                            <td>{{ $doctor->spesialisasi }}</td>
                            <td>{{ $doctor->jadwal_praktek }}</td>
                            <td>{{ $doctor->no_str }}</td>
                            <td class="d-flex gap-2">
                                <a href="{{ route('dokter.edit', $doctor->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('dokter.destroy', $doctor->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus dokter ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada data dokter.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
