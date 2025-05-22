<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception; // Tambahkan ini untuk menangkap Exception

use function Pest\Laravel\put;

class KunjunganController extends Controller
{
    public function index()
    {
        $kunjungans = Kunjungan::with(['pasien', 'doctor', 'detailtindakans.tindakan'])->get();
        return response()->json($kunjungans);
    }

    public function store(Request $request)
    {
        // Gunakan Validator facade untuk validasi yang lebih fleksibel
        $validator = Validator::make($request->all(), [
            'pasien_id' => 'required|exists:pasiens,id', // Pastikan nama tabelnya 'pasiens'
            'doctor_id' => 'required|exists:doctors,id', // Pastikan nama tabelnya 'doctors'
            'tanggal_kunjungan' => 'required|date',
            'keluhan' => 'required|string',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422); // Kode 422 Unprocessable Entity untuk error validasi
        }

        try {
            // Data yang sudah divalidasi
            $validatedData = $validator->validated();

            $kunjungan = Kunjungan::create($validatedData);

            return response()->json([
                'success' => true,
                'data' => $kunjungan,
                'message' => 'Kunjungan berhasil dibuat'
            ], 201); // Kode 201 Created
        } catch (Exception $e) {
            // Tangkap exception untuk debug yang lebih baik
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat kunjungan',
                'error_detail' => $e->getMessage(), // Pesan error dari exception
                'trace' => $e->getTraceAsString() 
            ], 500); 
        }
    }
   
     public function show($id)
    {
        // Mencari kunjungan berdasarkan ID dan memuat relasinya
        $kunjungan = Kunjungan::with(['pasien', 'dokter', 'detail   tindakans.tindakan'])->find($id);

        if (!$kunjungan) {
            return response()->json([
                'success' => false,
                'message' => 'Kunjungan tidak ditemukan'
            ], 404); // Kode 404 Not Found
        }

        return response()->json([
            'success' => true,
            'data' => $kunjungan
        ]);
    }

    /**
     * Memperbarui data kunjungan yang ada di database.
     */
    public function update(Request $request, $id)
    {
        // Mencari kunjungan yang akan diperbarui
        $kunjungan = Kunjungan::find($id);

        if (!$kunjungan) {
            return response()->json([
                'success' => false,
                'message' => 'Kunjungan tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'pasien_id' => 'sometimes|required|exists:pasiens,id', // 'sometimes' artinya opsional, tapi jika ada harus valid
            'doctor_id' => 'sometimes|required|exists:doctors,id',
            'tanggal_kunjungan' => 'sometimes|required|date',
            'keluhan' => 'sometimes|required|string|max:255', // Batasi panjang keluhan
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $validatedData = $validator->validated();
            $kunjungan->update($validatedData); // Memperbarui data kunjungan

            return response()->json([
                'success' => true,
                'data' => $kunjungan,
                'message' => 'Kunjungan berhasil diperbarui'
            ]); // Secara default, 200 OK
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui kunjungan',
                'error_detail' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    /**
     * Menghapus kunjungan dari database.
     */
    public function destroy($id)
    {
        // Mencari kunjungan yang akan dihapus
        $kunjungan = Kunjungan::find($id);

        if (!$kunjungan) {
            return response()->json([
                'success' => false,
                'message' => 'Kunjungan tidak ditemukan'
            ], 404);
        }

        try {
            $kunjungan->delete(); // Menghapus kunjungan

            return response()->json([
                'success' => true,
                'message' => 'Kunjungan berhasil dihapus'
            ], 200); // Kode 200 OK untuk sukses penghapusan (bisa juga 204 No Content)
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus kunjungan',
                'error_detail' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }
}
