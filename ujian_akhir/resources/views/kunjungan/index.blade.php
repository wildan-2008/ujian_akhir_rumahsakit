@extends('layouts.sidebar')

@section('content')
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Data Kunjungan</h2>
                <a href="{{ route('kunjungan.create') }}" class="btn btn-success btn-sm">+ Tambah Kunjungan</a>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card shadow-sm">
                <div class="card-body">
                    @if(count($kunjungans) > 0)
                        <table class="table table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th>Pasien</th>
                                    <th>Dokter</th>
                                    <th>Tanggal Kunjungan</th>
                                    <th>Keluhan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kunjungans as $kunjungan)
                                    <tr>
                                        <td>{{ $kunjungan->pasien->nama ?? '-' }}</td>
                                        <td>{{ $kunjungan->doctor->nama ?? '-' }}</td>
                                        <td>{{ $kunjungan->tanggal_kunjungan }}</td>
                                        <td>{{ $kunjungan->keluhan }}</td>
                                        <td class="d-flex gap-2">
                                            <a href="{{ route('kunjungan.edit', $kunjungan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('kunjungan.destroy', $kunjungan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                         <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada data kunjungan.</td>
                        </tr>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
