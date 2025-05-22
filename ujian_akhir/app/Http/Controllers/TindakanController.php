<?php

namespace App\Http\Controllers;

use App\Models\Tindakan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TindakanController extends Controller
{
    public function index()
    {
        return response()->json(Tindakan::all());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_tindakan' => 'required|string|max:255',
            'biaya'         => 'required|numeric|min:0',
            'kode_icd'      => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $tindakan = Tindakan::create($validator->validated());

        return response()->json([
            'success' => true,
            'data'    => $tindakan,
            'message' => 'Tindakan berhasil ditambahkan'
        ], 201);
    }

    public function show($id)
    {
        $tindakan = Tindakan::find($id);
        if (!$tindakan) {
            return response()->json(['message' => 'Tindakan tidak ditemukan'], 404);
        }
        return response()->json($tindakan);
    }

    public function update(Request $request, $id)
    {
        $tindakan = Tindakan::find($id);
        if (!$tindakan) {
            return response()->json(['message' => 'Tindakan tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama_tindakan' => 'required|string|max:255',
            'biaya'         => 'required|numeric|min:0',
            'kode_icd'      => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $tindakan->update($validator->validated());

        return response()->json([
            'success' => true,
            'data'    => $tindakan,
            'message' => 'Tindakan berhasil diperbarui'
        ]);
    }

    public function destroy($id)
    {
        $tindakan = Tindakan::find($id);
        if (!$tindakan) {
            return response()->json(['message' => 'Tindakan tidak ditemukan'], 404);
        }

        $tindakan->delete();

        return response()->json(['message' => 'Tindakan berhasil dihapus']);
    }
}
