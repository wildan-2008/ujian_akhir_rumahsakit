@extends('layouts.sidebar')

@section('content')
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Tambah Kunjungan</h2>
                <a href="{{ route('kunjungan.index') }}" class="btn btn-secondary btn-sm">← Kembali</a>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Ups!</strong> Ada masalah dengan input:<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('kunjungan.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="pasien_id" class="form-label">Pasien</label>
                            <select name="pasien_id" class="form-select" required>
                                <option value="">-- Pilih Pasien --</option>
                                @foreach ($pasiens as $pasien)
                                    <option value="{{ $pasien->id }}">{{ $pasien->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="doctor_id" class="form-label">Dokter</label>
                            <select name="doctor_id" class="form-select" required>
                                <option value="">-- Pilih Dokter --</option>
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}">{{ $doctor->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_kunjungan" class="form-label">Tanggal Kunjungan</label>
                            <input type="date" name="tanggal_kunjungan" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="keluhan" class="form-label">Keluhan</label>
                            <textarea name="keluhan" class="form-control" rows="3" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-success">Simpan</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection