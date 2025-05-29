@extends('layouts.sidebar')

@section('content')
        <div class="container">
            <h2 class="mb-4">Tambah Data Dokter</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('dokter.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" required>
                </div>
                <div class="mb-3">
                    <label for="spesialisasi" class="form-label">Spesialisasi</label>
                    <input type="text" class="form-control" id="spesialisasi" name="spesialisasi" value="{{ old('spesialisasi') }}" required>
                </div>
                <div class="mb-3">
                    <label for="jadwal_praktek" class="form-label">Jadwal Praktek</label>
                    <input type="text" class="form-control" id="jadwal_praktek" name="jadwal_praktek" value="{{ old('jadwal_praktek') }}" required>
                </div>
                <div class="mb-3">
                    <label for="no_str" class="form-label">Nomor STR</label>
                    <input type="text" class="form-control" id="no_str" name="no_str" value="{{ old('no_str') }}" required>
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
              <a href="{{ route('dokter.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>
@endsection