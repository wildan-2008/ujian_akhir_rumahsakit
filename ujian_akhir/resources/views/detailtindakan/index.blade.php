@extends('layouts.sidebar')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Data Detail Tindakan</h2>
        <a href="{{ route('detailtindakan.create') }}" class="btn btn-success btn-sm">+ Tambah Detail</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            @if(count($details) > 0)
                <table class="table table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>Kunjungan</th>
                            <th>Tindakan</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($details as $detail)
                            <tr>
                                <td>{{ $detail->kunjungan->pasien->nama ?? '-' }}</td>
                                <td>{{ $detail->tindakan->nama_tindakan ?? '-' }}</td>
                                <td>{{ $detail->keterangan }}</td>
                                <td class="d-flex gap-2">
                                    <a href="{{ route('detailtindakan.edit', $detail->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('detailtindakan.destroy', $detail->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
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
                    <td colspan="4" class="text-center text-muted">Belum ada data Detail Tindakan.</td>
                 </tr>
            @endif
        </div>
    </div>
</div>
@endsection
