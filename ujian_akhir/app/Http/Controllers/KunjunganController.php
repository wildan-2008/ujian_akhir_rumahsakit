<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use App\Models\Pasien;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class KunjunganController extends Controller
{
    public function index()
    {
        $kunjungans = Kunjungan::with(['pasien', 'doctor', 'detailtindakans.tindakan'])->get();
        return view('kunjungan.index', compact('kunjungans'));
    }

    public function create()
    {
        $pasiens = Pasien::all();
        $doctors = Doctor::all();
        return view('kunjungan.create', compact('pasiens', 'doctors'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pasien_id' => 'required|exists:pasiens,id',
            'doctor_id' => 'required|exists:doctors,id',
            'tanggal_kunjungan' => 'required|date',
            'keluhan' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $validatedData = $validator->validated();
            Kunjungan::create($validatedData);

            return redirect()->route('kunjungan.index')->with('success', 'Kunjungan berhasil ditambahkan.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function show($id)
    {
        $kunjungan = Kunjungan::with(['pasien', 'doctor', 'detailtindakans.tindakan'])->find($id);

        if (!$kunjungan) {
            return redirect()->back()->with('error', 'Kunjungan tidak ditemukan.');
        }

        return view('kunjungan.show', compact('kunjungan'));
    }

    public function edit($id)
    {
        $kunjungan = Kunjungan::find($id);
        $pasiens = Pasien::all();
        $doctors = Doctor::all();

        if (!$kunjungan) {
            return redirect()->back()->with('error', 'Kunjungan tidak ditemukan.');
        }

        return view('kunjungan.edit', compact('kunjungan', 'pasiens', 'doctors'));
    }

    public function update(Request $request, $id)
    {
        $kunjungan = Kunjungan::find($id);

        if (!$kunjungan) {
            return redirect()->back()->with('error', 'Kunjungan tidak ditemukan.');
        }

        $validator = Validator::make($request->all(), [
            'pasien_id' => 'required|exists:pasiens,id',
            'doctor_id' => 'required|exists:doctors,id',
            'tanggal_kunjungan' => 'required|date',
            'keluhan' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $validatedData = $validator->validated();
            $kunjungan->update($validatedData);

            return redirect()->route('kunjungan.index')->with('success', 'Kunjungan berhasil diperbarui.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        $kunjungan = Kunjungan::find($id);

        if (!$kunjungan) {
            return redirect()->back()->with('error', 'Kunjungan tidak ditemukan.');
        }

        try {
            $kunjungan->delete();
            return redirect()->route('kunjungan.index')->with('success', 'Kunjungan berhasil dihapus.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
