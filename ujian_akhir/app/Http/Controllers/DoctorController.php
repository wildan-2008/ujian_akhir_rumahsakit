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
        return view('doctor.index', compact('data'));
    }

    public function create()
    {
        return view('doctor.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'           => 'required|string|max:255',
            'spesialisasi'   => 'required|string|max:255',
            'jadwal_praktek' => 'required|string|max:255',
            'no_str'         => 'required|string|unique:doctors,no_str|max:6'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Doctor::create($validator->validated());

        return redirect()->route('dokter.index')->with('success', 'Dokter berhasil ditambahkan!');
    }

    public function show($id)
    {
        $doctor = Doctor::find($id);

        if (!$doctor) {
            return response()->json(['message' => 'Dokter tidak ditemukan'], 404);
        }

        return response()->json($doctor);
    }
    
    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('doctor.edit', compact('doctor'));
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

         return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil diperbarui');
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
