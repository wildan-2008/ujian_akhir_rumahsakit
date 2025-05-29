<?php

namespace App\Http\Controllers;

use App\Models\DetailTindakan;
use App\Models\Kunjungan;
use App\Models\Tindakan;
use Illuminate\Http\Request;

class DetailTindakanController extends Controller
{
    public function index()
    {
        $details = DetailTindakan::with(['kunjungan', 'tindakan'])->get();
        return view('detailtindakan.index', compact('details'));
    }

    public function create()
    {
        $kunjungans = Kunjungan::all();
        $tindakans = Tindakan::all();
        return view('detailtindakan.create', compact('kunjungans', 'tindakans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kunjungan_id' => 'required|exists:kunjungans,id',
            'tindakan_id'  => 'required|exists:tindakans,id',
            'keterangan'   => 'nullable|string|max:255',
        ]);

        DetailTindakan::create($validated);
        return redirect()->route('detailtindakan.index')->with('success', 'Detail tindakan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $detail = DetailTindakan::findOrFail($id);
        $kunjungans = Kunjungan::all();
        $tindakans = Tindakan::all();
        return view('detailtindakan.edit', compact('detail', 'kunjungans', 'tindakans'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'kunjungan_id' => 'required|exists:kunjungans,id',
            'tindakan_id'  => 'required|exists:tindakans,id',
            'keterangan'   => 'nullable|string|max:255',
        ]);

        $detail = DetailTindakan::findOrFail($id);
        $detail->update($validated);
        return redirect()->route('detailtindakan.index')->with('success', 'Detail tindakan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $detail = DetailTindakan::findOrFail($id);
        $detail->delete();
        return redirect()->route('detailtindakan.index')->with('success', 'Detail tindakan berhasil dihapus.');
    }
}
