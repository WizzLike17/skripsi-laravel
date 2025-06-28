<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    public function index()
    {
        $periodes = Periode::all();
        return view('admin.periode.index', compact('periodes'));
    }

    public function create()
    {
        return view('admin.periode.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'jenis_periode' => 'required|in:ganjil,genap',
            'status' => 'required|boolean',
        ]);
        // Nonaktifkan semua periode aktif lainnya
        if ($request->status == true || $request->status == '1') {
            Periode::where('status', true)->update(['status' => false]);
        }

        Periode::create($request->all());

        return redirect()->route('periodes.index')->with('success', 'Periode berhasil ditambahkan.');
    }

    public function edit(Periode $periode)
    {
        return view('admin.periode.edit', compact('periode'));
    }

    public function update(Request $request, Periode $periode)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'jenis_periode' => 'required|in:ganjil,genap',
            'status' => 'required|boolean',
        ]);
        // Nonaktifkan semua periode aktif lainnya
        if ($request->status == true || $request->status == '1') {
            Periode::where('status', true)
                ->where('periode_id', '!=', $periode->periode_id)
                ->update(['status' => false]);
        }

        $periode->update($request->all());

        return redirect()->route('periodes.index')->with('success', 'Periode berhasil diperbarui.');
    }

    public function destroy(Periode $periode)
    {
        $periode->delete();
        return redirect()->route('periodes.index')->with('success', 'Periode berhasil dihapus.');
    }

    public function toggleStatus(Periode $periode)
    {
        // Jika periode ini belum aktif, aktifkan dan nonaktifkan periode lain
        if (!$periode->status) {
            Periode::where('status', true)->update(['status' => false]);
            $periode->status = true;
        } else {
            // Jika sudah aktif, bisa juga dinonaktifkan lewat toggle
            $periode->status = false;
        }
        $periode->save();

        return redirect()->route('periodes.index')->with('success', 'Status periode berhasil diperbarui.');
    }
}
