<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class PasienController extends Controller

{
    public function index()
    {
        $data = Pasien::all();
        return response()->json($data, 200);
    }

    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'nama'      => 'required|string|max:255',
        'nik'       => 'required|string|unique:pasiens|max:20',
        'tgl_lahir' => 'required|date',
        'alamat'    => 'required|string',
        'no_hp'     => 'required|string|max:20'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Validasi gagal',
            'errors'  => $validator->errors()
        ], 422);
    }

    $validated = $validator->validated();

    $pasien = Pasien::create([
        'user_id'   => Auth::id(), // Pastikan kolom user_id ada di tabel
        'nama'      => $validated['nama'],
        'nik'       => $validated['nik'],
        'tgl_lahir' => $validated['tgl_lahir'],
        'alamat'    => $validated['alamat'],
        'no_hp'     => $validated['no_hp'],
    ]);

    return response()->json([
        'success' => true,
        'data'    => $pasien,
        'message' => 'Pasien berhasil ditambahkan'
    ], 201);
}

    public function show($id)
    {
        $pasien = Pasien::find($id);

        if (!$pasien) {
            return response()->json(['message' => 'Pasien tidak ditemukan'], 404);
        }

        return response()->json($pasien);
    }

    public function update(Request $request, $id)
    {
        $pasien = Pasien::find($id);

        if (!$pasien) {
            return response()->json(['message' => 'Pasien tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'nama' => 'required',
            'nik' => 'required|unique:pasiens,nik,' . $id,
            'tgl_lahir' => 'required|date',
            'alamat' => 'required',
            'no_hp' => 'required'
        ]);

        $pasien->update($validated);

        return response()->json([
            'message' => 'Data pasien berhasil diperbarui!',
            'data' => $pasien
        ]);
    }

    public function destroy($id)
    {
        $pasien = Pasien::find($id);

        if (!$pasien) {
            return response()->json(['message' => 'Pasien tidak ditemukan'], 404);
        }

        $pasien->delete();

        return response()->json(['message' => 'Data pasien berhasil dihapus!']);
    }
}