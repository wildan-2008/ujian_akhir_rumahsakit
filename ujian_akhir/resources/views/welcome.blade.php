@extends('layouts.sidebar')

@section('title', 'Dashboard Rumah Sakit')

@section('content')
<div class="container">
    <h2 class="mb-4">Selamat Datang di Sistem Rumah Sakit</h2>

    {{-- Informasi Jumlah --}}
<div class="row mb-5">
    <!-- Jumlah Pasien -->
    <div class="col-md-6">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">Jumlah Pasien yang Datang</div>
            <div class="card-body text-center">
                <h3>{{ $jumlahPasien }}</h3>
            </div>
        </div>
    </div>

    <!-- Jumlah Dokter -->
    <div class="col-md-6">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">Jumlah Dokter Yang Tersedia</div>
            <div class="card-body text-center">
                <h3>{{ $jumlahDokter }}</h3>
            </div>
        </div>
    </div>
</div>


    {{-- Navigasi Menu Data --}}
    <div class="row g-4">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Pasien</h5>
                    <p class="card-text">Kelola data pasien rumah sakit.</p>
                    <a href="/pasien" class="btn btn-primary">Lihat Data</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Dokter</h5>
                    <p class="card-text">Kelola data dokter yang bertugas.</p>
                    <a href="/dokter" class="btn btn-primary">Lihat Data</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Kunjungan</h5>
                    <p class="card-text">Kelola data kunjungan pasien.</p>
                    <a href="/kunjungan" class="btn btn-primary">Lihat Data</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Tindakan</h5>
                    <p class="card-text">Kelola jenis tindakan medis.</p>
                    <a href="/tindakan" class="btn btn-primary">Lihat Data</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Detail Tindakan</h5>
                    <p class="card-text">Lihat dan kelola detail tindakan pasien.</p>
                    <a href="/detailtindakan" class="btn btn-primary">Lihat Data</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
