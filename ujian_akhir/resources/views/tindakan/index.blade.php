@extends('layouts.sidebar')

@section('content')
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Data Tindakan</h2>
                <a href="{{ route('tindakan.create') }}" class="btn btn-success btn-sm">+ Tambah Tindakan</a>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card shadow-sm">
                <div class="card-body">
                    @if(count($tindakans) > 0)
                        <table class="table table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th>Nama Tindakan</th>
                                    <th>Biaya</th>
                                    <th>Kode ICD</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tindakans as $t)
                                    <tr>
                                        <td>{{ $t->nama_tindakan }}</td>
                                        <td>Rp{{ number_format($t->biaya, 0, ',', '.') }}</td>
                                        <td>{{ $t->kode_icd }}</td>
                                        <td class="d-flex gap-2">
                                            <a href="{{ route('tindakan.edit', $t->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('tindakan.destroy', $t->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
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
                            <td colspan="4" class="text-center text-muted">Belum ada data Tindakan</td>
                        </tr>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection