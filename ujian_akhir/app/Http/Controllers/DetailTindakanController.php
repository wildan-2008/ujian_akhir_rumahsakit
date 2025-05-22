<?php

namespace App\Http\Controllers;

use App\Models\DetailTindakan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Detail_TindakanController extends Controller
{
    public function index()
    {
        $details = DetailTindakan::with(['kunjungan', 'tindakan'])->get();
        return response()->json($details, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kunjungan_id' => 'required|exists:kunjungans,id',
            'tindakan_id'  => 'required|exists:tindakans,id',
            'keterangan'   => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $detail = DetailTindakan::create($validator->validated());

        return response()->json([
            'success' => true,
            'data' => $detail,
            'message' => 'Detail tindakan berhasil ditambahkan',
        ], 201);
    }

    public function show($id)
    {
        $detail = DetailTindakan::with(['kunjungan', 'tindakan'])->find($id);

        if (!$detail) {
            return response()->json(['message' => 'Detail tindakan tidak ditemukan'], 404);
        }

        return response()->json($detail);
    }

    public function update(Request $request, $id)
    {
        $detail = DetailTindakan::find($id);

        if (!$detail) {
            return response()->json(['message' => 'Detail tindakan tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'kunjungan_id' => 'required|exists:kunjungans,id',
            'tindakan_id'  => 'required|exists:tindakans,id',
            'keterangan'   => 'nullable|string|max:255',
        ]);

        $detail->update($validated);

        return response()->json([
            'success' => true,
            'data' => $detail,
            'message' => 'Detail tindakan berhasil diperbarui',
        ]);
    }

    public function destroy($id)
    {
        $detail = DetailTindakan::find($id);

        if (!$detail) {
            return response()->json(['message' => 'Detail tindakan tidak ditemukan'], 404);
        }

        $detail->delete();

        return response()->json(['message' => 'Detail tindakan berhasil dihapus']);
    }
}
