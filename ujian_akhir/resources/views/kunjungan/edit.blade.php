@extends('layouts.sidebar')

@section('content')
        <div class="container">
            <h2 class="mb-4">Edit Data Kunjungan</h2>
            <form action="{{ route('kunjungan.update', $kunjungan->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="pasien_id" class="form-label">Pasien</label>
                    <select name="pasien_id" id="pasien_id" class="form-control" required>
                        <option value="">-- Pilih Pasien --</option>
                        @foreach($pasiens as $pasien)
                            <option value="{{ $pasien->id }}" {{ $kunjungan->pasien_id == $pasien->id ? 'selected' : '' }}>
                                {{ $pasien->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="doctor_id" class="form-label">Dokter</label>
                    <select name="doctor_id" id="doctor_id" class="form-control" required>
                        <option value="">-- Pilih Dokter --</option>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}" {{ $kunjungan->doctor_id == $doctor->id ? 'selected' : '' }}>
                                {{ $doctor->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="tanggal_kunjungan" class="form-label">Tanggal Kunjungan</label>
                    <input type="date" class="form-control" id="tanggal_kunjungan" name="tanggal_kunjungan" value="{{ $kunjungan->tanggal_kunjungan }}" required>
                </div>

                <div class="mb-3">
                    <label for="keluhan" class="form-label">Keluhan</label>
                    <textarea class="form-control" id="keluhan" name="keluhan" rows="3" required>{{ $kunjungan->keluhan }}</textarea>
                </div>

                <button type="submit" class="btn btn-warning">Perbarui</button>
                <a href="{{ route('kunjungan.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection