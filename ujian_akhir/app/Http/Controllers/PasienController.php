<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PasienController extends Controller
{
    public function index()
    {
        $data = Pasien::all();
        return view('pasien.index', compact('data'));
    }

    public function create()
    {
        return view('pasien.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'           => 'required|string|max:255',
            'nik'            => 'required|string|max:16|unique:pasiens,nik',
            'tanggal_lahir'  => 'required|date',
            'alamat'         => 'required|string|max:255',
            'no_hp'          => 'required|string|max:15',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Pasien::create($validator->validated());

        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil disimpan!');
    }

    public function show($id)
    {
        $pasien = Pasien::find($id);

        if (!$pasien) {
            return response()->json(['message' => 'Pasien tidak ditemukan'], 404);
        }

        return response()->json($pasien);
    }

    public function edit($id)
    {
        $pasien = Pasien::findOrFail($id);
        return view('pasien.edit', compact('pasien'));
    }

    public function update(Request $request, $id)
    {
        $pasien = Pasien::find($id);

        if (!$pasien) {
            return response()->json(['message' => 'Pasien tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'nama'           => 'required|string|max:255',
            'nik'            => 'required|string|max:16|unique:pasiens,nik,' . $id,
            'tanggal_lahir'  => 'required|date',
            'alamat'         => 'required|string|max:255',
            'no_hp'          => 'required|string|max:15',
        ]);

        $pasien->update($validated);

        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil diperbarui');
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
