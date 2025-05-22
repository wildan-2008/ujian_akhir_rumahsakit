<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
    public function index()
    {
        $data = Doctor::all();
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'           => 'required|string|max:255',
            'spesialisasi'   => 'required|string|max:255',
            'jadwal_praktek' => 'required|string|max:255',
            'no_str'         => 'required|string|unique:doctors,no_str|max:50'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors()
            ], 422);
        }

        $doctor = Doctor::create($validator->validated());

        return response()->json([
            'success' => true,
            'data'    => $doctor,
            'message' => 'Dokter berhasil ditambahkan'
        ], 201);
    }

    public function show($id)
    {
        $doctor = Doctor::find($id);

        if (!$doctor) {
            return response()->json(['message' => 'Dokter tidak ditemukan'], 404);
        }

        return response()->json($doctor);
    }

    public function update(Request $request, $id)
    {
        $doctor = Doctor::find($id);

        if (!$doctor) {
            return response()->json(['message' => 'Dokter tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'nama'           => 'required|string|max:255',
            'spesialisasi'   => 'required|string|max:255',
            'jadwal_praktek' => 'required|string|max:255',
            'no_str'         => 'required|string|max:50|unique:doctors,no_str,' . $id,
        ]);

        $doctor->update($validated);

        return response()->json([
            'message' => 'Data dokter berhasil diperbarui!',
            'data'    => $doctor
        ]);
    }

    public function destroy($id)
    {
        $doctor = Doctor::find($id);

        if (!$doctor) {
            return response()->json(['message' => 'Dokter tidak ditemukan'], 404);
        }

        $doctor->delete();

        return response()->json(['message' => 'Data dokter berhasil dihapus!']);
    }
}
