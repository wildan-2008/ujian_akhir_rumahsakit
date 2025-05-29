<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\KunjunganController;
use App\Http\Controllers\TindakanController;
use App\Http\Controllers\DetailTindakanController;
use App\Http\Controllers\DashboardController;



// Halaman utama
Route::get('/', [DashboardController::class, 'index']);

// Pasien
Route::resource('pasien', PasienController::class);

// Dokter
Route::resource('dokter', DoctorController::class)->except(['edit', 'update']);
Route::get('dokter/edit/{id}', [DoctorController::class, 'edit'])->name('dokter.edit');
Route::put('dokter/update/{id}', [DoctorController::class, 'update'])->name('dokter.update');

// Kunjungan
Route::resource('kunjungan', KunjunganController::class);

// Tindakan
Route::resource('tindakan', TindakanController::class);

// Detail Tindakan
Route::resource('detailtindakan', DetailTindakanController::class);
