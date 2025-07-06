<?php

namespace App\Http\Controllers\sertifikat;

use App\Http\Controllers\Controller;
use App\Models\Kemendikbud;
use App\Models\Sertifikat;
use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KemendikbudController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $kemendikbud = Kemendikbud::where('mahasiswa_id', $user->user_id)->get();
        return view('mahasiswa.kemen.daftar', compact('kemendikbud'));
    }

    public function create()
    {
        $periode = Periode::where('status', true)->where('tanggal_mulai', '<=', now())->where('tanggal_selesai', '>=', now())->first();

        return view('mahasiswa.kemen.pengajuan', compact('periode'));
    }

    public function store(Request $request)
    {
$request->validate([
    'nama_kegiatan' => 'required',
    'tanggal' => 'required|date',
    'ketua' => 'required',
    'anggota' => 'required',
    'dospem' => 'required',
    'keterlibatan_dospem' => 'required',
    'prestasi' => 'required',
    'lingkup_kegiatan' => 'required',
    'lokasi_kegiatan' => 'required',
    'sumber_biaya' => 'required',
    'biaya' => 'required|numeric|min:0',
    'surat' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
    'sertifikat' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
]);

$periode = Periode::where('status', true)->where('tanggal_mulai', '<=', now())->where('tanggal_selesai', '>=', now())->first();

if (!$periode) {
    return back()->with('error', 'Tidak ada periode aktif. Pengajuan tidak dapat dilakukan.');
}

        $user = Auth::user();

        // Simpan file dengan nama unik supaya tidak bentrok
        $suratFile = $request->file('surat');
        $suratName = Str::random(20) . '.' . $suratFile->getClientOriginalExtension();
        $suratFile->storeAs('uploads/surat', $suratName, 'public');

        $sertifikatFile = $request->file('sertifikat');
        $sertifikatName = Str::random(20) . '.' . $sertifikatFile->getClientOriginalExtension();
        $sertifikatFile->storeAs('uploads/sertifikat', $sertifikatName, 'public');

$kemendikbud = Kemendikbud::create([
'mahasiswa_id' => $user->user_id,
'validator_id' => null,
'status' => 'pending',
'nama_kegiatan' => $request->nama_kegiatan,
'surat' => $suratName, // Simpan hanya nama file
'tanggal' => $request->tanggal,
'ketua' => $request->ketua,
'anggota' => $request->anggota,
'dospem' => $request->dospem,
'keterlibatan_dospem' => $request->keterlibatan_dospem,
'prestasi' => $request->prestasi,
'sertifikat' => $sertifikatName, // Simpan hanya nama file
'lingkup_kegiatan' => $request->lingkup_kegiatan,
'sumber_biaya' => $request->sumber_biaya,
'biaya' => $request->biaya,
'lokasi_kegiatan' => $request->lokasi_kegiatan,
]);

        Sertifikat::create([
            'periode_id' => $periode->periode_id,
            'id_kmdb' => $kemendikbud->id_kmdb,
            'mahasiswa_id' => $user->user_id,
            'nama_kegiatan' => $request->nama_kegiatan,
            'status' => 'pending',
            'validator_id' => null,
        ]);

        return redirect()->route('daftar')->with('success', 'Pengajuan berhasil disimpan.');
    }

    public function edit($id)
    {
        $user = Auth::user();
        $kemendikbud = Kemendikbud::with('sertifikatRel')->where('id_kmdb', $id)->where('mahasiswa_id', $user->user_id)->firstOrFail();

        return view('mahasiswa.kemen.edit', compact('kemendikbud'));
    }


    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_kegiatan' => 'required|string',
            'tanggal' => 'required|date',
            'ketua' => 'required|string',
            'anggota' => 'required|string',
            'dospem' => 'required|string',
            'keterlibatan_dospem' => 'required|string',
            'prestasi' => 'required|string',
            'lingkup_kegiatan' => 'required|string',
            'lokasi_kegiatan' => 'required|string',
            'sumber_biaya' => 'required|string',
            'biaya' => 'required|numeric|min:0',
            'surat' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'sertifikat' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // Ambil user yang login
        $user = Auth::user();

        // Ambil data berdasarkan id_kmdb (bukan 'id') dan pastikan data milik user
        $kemendikbud = Kemendikbud::where('id_kmdb', $id)->where('mahasiswa_id', $user->id)->firstOrFail();

        // Handle upload file surat jika ada
        if ($request->hasFile('surat')) {
            if ($kemendikbud->surat && Storage::disk('public')->exists('uploads/surat/' . $kemendikbud->surat)) {
                Storage::disk('public')->delete('uploads/surat/' . $kemendikbud->surat);
            }

            $suratFile = $request->file('surat');
            $suratName = Str::random(20) . '.' . $suratFile->getClientOriginalExtension();
            $suratFile->storeAs('uploads/surat', $suratName, 'public');
            $kemendikbud->surat = $suratName;
        }

        // Handle upload file sertifikat jika ada
        if ($request->hasFile('sertifikat')) {
            if ($kemendikbud->sertifikat && Storage::disk('public')->exists('uploads/sertifikat/' . $kemendikbud->sertifikat)) {
                Storage::disk('public')->delete('uploads/sertifikat/' . $kemendikbud->sertifikat);
            }

            $sertifikatFile = $request->file('sertifikat');
            $sertifikatName = Str::random(20) . '.' . $sertifikatFile->getClientOriginalExtension();
            $sertifikatFile->storeAs('uploads/sertifikat', $sertifikatName, 'public');
            $kemendikbud->sertifikat = $sertifikatName;
        }

        // Update field lain
        $kemendikbud->fill([
            'nama_kegiatan' => $request->nama_kegiatan,
            'tanggal' => $request->tanggal,
            'ketua' => $request->ketua,
            'anggota' => $request->anggota,
            'dospem' => $request->dospem,
            'keterlibatan_dospem' => $request->keterlibatan_dospem,
            'prestasi' => $request->prestasi,
            'lingkup_kegiatan' => $request->lingkup_kegiatan,
            'lokasi_kegiatan' => $request->lokasi_kegiatan,
            'sumber_biaya' => $request->sumber_biaya,
            'biaya' => $request->biaya,
            'status' => 'pending', // Reset status agar divalidasi ulang
        ]);

        $kemendikbud->save();

        Sertifikat::where('id_kmdb', $kemendikbud->id_kmdb)->update([
            'periode_id' => $kemendikbud->periode_id,
            'mahasiswa_id' => $user->user_id,
            'validator_id' => null,
            'nama_kegiatan' => $request->nama_kegiatan,
            'status' => 'pending', // Reset status sertifikat agar divalidasi ulang
        ]);
        return redirect()->route('daftar')->with('success', 'Data berhasil diperbarui dan status dikembalikan ke pending.');
    }

    public function destroy($id)
    {
        $data = Kemendikbud::findOrFail($id);

        if ($data->surat && Storage::exists($data->surat)) {
            Storage::delete($data->surat);
        }

        if ($data->sertifikat && Storage::exists($data->sertifikat)) {
            Storage::delete($data->sertifikat);
        }

        Sertifikat::where('id_kmdb', $data->id_kmdb)->delete();
        $data->delete();

        return redirect()->route('kemendikbud.index')->with('success', 'Data berhasil dihapus.');
    }
}
