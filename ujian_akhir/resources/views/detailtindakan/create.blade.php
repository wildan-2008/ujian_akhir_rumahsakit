@extends('layouts.sidebar')

@section('content')
<div class="container">
    <h2 class="mb-4">Tambah Detail Tindakan</h2>
    <form action="{{ route('detailtindakan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="kunjungan_id" class="form-label">Kunjungan</label>
            <select class="form-control" name="kunjungan_id" required>
                @foreach ($kunjungans as $kunjungan)
                    <option value="{{ $kunjungan->id }}">{{ $kunjungan->pasien->nama ?? 'Pasien ID: '.$kunjungan->id }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="tindakan_id" class="form-label">Tindakan</label>
            <select class="form-control" name="tindakan_id" required>
                @foreach ($tindakans as $tindakan)
                    <option value="{{ $tindakan->id }}">{{ $tindakan->nama_tindakan }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <input type="text" class="form-control" name="keterangan">
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('detailtindakan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
