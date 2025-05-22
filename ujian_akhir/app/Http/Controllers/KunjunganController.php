<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use Illuminate\Http\Request;

class KunjunganController extends Controller
{
    public function index()
    {
        $kunjungans = Kunjungan::with(['pasien', 'dokter', 'detailTindakans.tindakan'])->get();
        return response()->json($kunjungans);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pasien_id' => 'required|exists:pasiens,id',
            'dokter_id' => 'required|exists:dokters,id',
            'tanggal_kunjungan' => 'required|date',
            'keluhan' => 'required|string',
        ]);

        $kunjungan = Kunjungan::create($validated);

        return response()->json([
            'success' => true,
            'data' => $kunjungan,
            'message' => 'Kunjungan berhasil dibuat'
        ], 201);
    }

    // Tambah update, show, destroy sesuai kebutuhan
}

