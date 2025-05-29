<?php

namespace App\Http\Controllers;

use App\Models\Tindakan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TindakanController extends Controller
{
    public function index()
    {
        $tindakans = Tindakan::all();
        return view('tindakan.index', compact('tindakans'));
    }

    public function create()
    {
        return view('tindakan.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_tindakan' => 'required|string|max:255',
            'biaya'         => 'required|numeric|min:0',
            'kode_icd'      => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Tindakan::create($validator->validated());
        return redirect()->route('tindakan.index')->with('success', 'Tindakan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $tindakan = Tindakan::findOrFail($id);
        return view('tindakan.edit', compact('tindakan'));
    }

    public function update(Request $request, $id)
    {
        $tindakan = Tindakan::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama_tindakan' => 'required|string|max:255',
            'biaya'         => 'required|numeric|min:0',
            'kode_icd'      => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $tindakan->update($validator->validated());
        return redirect()->route('tindakan.index')->with('success', 'Tindakan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $tindakan = Tindakan::findOrFail($id);
        $tindakan->delete();
        return redirect()->route('tindakan.index')->with('success', 'Tindakan berhasil dihapus.');
    }
}
