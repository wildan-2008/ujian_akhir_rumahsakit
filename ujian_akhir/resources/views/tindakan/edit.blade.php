@extends('layouts.sidebar')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Tindakan</h2>
    <form action="{{ route('tindakan.update', $tindakan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nama Tindakan</label>
            <input type="text" class="form-control" name="nama_tindakan" value="{{ $tindakan->nama_tindakan }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Biaya</label>
            <input type="number" class="form-control" name="biaya" value="{{ $tindakan->biaya }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Kode ICD</label>
            <input type="text" class="form-control" name="kode_icd" value="{{ $tindakan->kode_icd }}" required>
        </div>
        <button type="submit" class="btn btn-warning">Perbarui</button>
        <a href="{{ route('tindakan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
