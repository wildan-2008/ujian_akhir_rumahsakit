<?php

use App\Http\Controllers\DetailTindakanController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\KunjunganController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\TindakanController;
use App\Models\DetailTindakan;
use App\Models\Doctor;
use App\Models\Kunjungan;
use Illuminate\Routing\Route as RoutingRoute;

Route::apiResource('pasien',PasienController::class);
Route::apiResource('doctor',DoctorController::class);
Route::apiResource('kunjungan',KunjunganController::class);
Route::apiResource('tindakan',TindakanController::class);
Route::apiResource('detailtindakan',DetailTindakan::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});