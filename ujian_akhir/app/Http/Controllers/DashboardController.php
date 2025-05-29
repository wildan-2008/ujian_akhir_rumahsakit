<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Models\Kunjungan;
use App\Models\Pasien;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
public function index()
{
    $jumlahPasien = Kunjungan::count();     // total semua kunjungan
    $jumlahDokter = Doctor::count();        // total semua dokter

    return view('welcome', compact('jumlahPasien', 'jumlahDokter'));
}

}