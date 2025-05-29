@extends('layouts.sidebar')

@section('content')
        <div class="container">
            <h2 class="mb-4">Edit Data Dokter</h2>
            <form action="{{ route('dokter.update', $doctor->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $doctor->nama }}" required>
                </div>
                <div class="mb-3">
                    <label for="spesialisasi" class="form-label">Spesialisasi</label>
                    <input type="text" class="form-control" id="spesialisasi" name="spesialisasi" value="{{ $doctor->spesialisasi }}" required>
                </div>
                <div class="mb-3">
                    <label for="jadwal_praktek" class="form-label">Jadwal Praktek</label>
                    <input type="text" class="form-control" id="jadwal_praktek" name="jadwal_praktek" value="{{ $doctor->jadwal_praktek }}" required>
                </div>
                <div class="mb-3">
                    <label for="no_str" class="form-label">Nomor STR</label>
                    <input type="text" class="form-control" id="no_str" name="no_str" value="{{ $doctor->no_str }}" required>
                </div>
                <button type="submit" class="btn btn-warning">Perbarui</button>
                <a href="{{ route('dokter.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection