<?php

namespace App\Http\Controllers\sertifikat;

use App\Http\Controllers\Controller;
use App\Models\KompetisiMandiri;
use Illuminate\Http\Request;
use App\Models\Sertifikat;
use App\Models\Periode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class KompetisiMandiriController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $kompetisi = KompetisiMandiri::where('mahasiswa_id', $user->user_id)->get();
        return view('mahasiswa.kompetisi-mandiri.daftar', compact('kompetisi'));
    }

    public function create()
    {
        $periode = Periode::where('status', true)
            ->where('tanggal_mulai', '<=', now())
            ->where('tanggal_selesai', '>=', now())
            ->first();
        return view('mahasiswa.kompetisi-mandiri.pengajuan', compact('periode'));
    }

public function store(Request $request)
{
    $request->validate([
        'nama_kegiatan' => 'required|string',
        'link_penyelenggara' => 'nullable|url',
        'dospem' => 'required|string',
        'capaian_prestasi' => 'nullable|string',
        'jenis_kepesertaan' => 'required|string',
        'tanggal_pelaksanaan' => 'required|date',
        'tanggal_selesai' => 'required|date|after_or_equal:tanggal_pelaksanaan',
        'jumlah_anggota' => 'required|integer|min:1',
        'nidn_nidk' => 'nullable|string',
        'sertifikat' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'foto_penyerahan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'surat_tugas' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
    ]);

    $periode = Periode::where('status', true)
        ->where('tanggal_mulai', '<=', now())
        ->where('tanggal_selesai', '>=', now())
        ->first();

    if (!$periode) {
        return back()->with('error', 'Tidak ada periode aktif. Pengajuan tidak dapat dilakukan.');
    }

    $user = Auth::user();

    $kompetisi = new KompetisiMandiri();
    $kompetisi->mahasiswa_id = $user->user_id;
    $kompetisi->status = 'pending'; // default
    $kompetisi->nama_kegiatan = $request->nama_kegiatan;
    $kompetisi->link_penyelenggara = $request->link_penyelenggara;
    $kompetisi->dospem = $request->dospem;
    $kompetisi->capaian_prestasi = $request->capaian_prestasi;
    $kompetisi->jenis_kepesertaan = $request->jenis_kepesertaan;
    $kompetisi->tanggal_pelaksanaan = $request->tanggal_pelaksanaan;
    $kompetisi->tanggal_selesai = $request->tanggal_selesai;
    $kompetisi->jumlah_anggota = $request->jumlah_anggota;
    $kompetisi->nidn_nidk = $request->nidn_nidk;

    // File uploads
    if ($request->hasFile('sertifikat')) {
        $file = $request->file('sertifikat');
        $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('uploads/sertifikat', $filename, 'public');
        $kompetisi->sertifikat = $filename;
    }

    if ($request->hasFile('foto_penyerahan')) {
        $file = $request->file('foto_penyerahan');
        $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('uploads/foto_penyerahan', $filename, 'public');
        $kompetisi->foto_penyerahan = $filename;
    }

    if ($request->hasFile('surat_tugas')) {
        $file = $request->file('surat_tugas');
        $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('uploads/surat_tugas', $filename, 'public');
        $kompetisi->surat_tugas = $filename;
    }

    $kompetisi->save();

    // Setelah kompetisi disimpan, tambahkan entri ke tabel sertifikat
    Sertifikat::create([
        'periode_id' => $periode->periode_id,
        'id_kompetisi' => $kompetisi->id_kompetisi,
        'mahasiswa_id' => $user->user_id,
        'nama_kegiatan' => $request->nama_kegiatan,
        'status' => 'pending',
        'validator_id' => null,
    ]);

    return redirect()->route('daftar')->with('success', 'Data kompetisi mandiri berhasil disimpan.');
}


public function update(Request $request, $id)
{
    $request->validate([
        'nama_kegiatan' => 'required|string',
        'link_penyelenggara' => 'nullable|url',
        'dospem' => 'required|string',
        'capaian_prestasi' => 'nullable|string',
        'jenis_kepesertaan' => 'required|string',
        'tanggal_pelaksanaan' => 'required|date',
        'tanggal_selesai' => 'required|date|after_or_equal:tanggal_pelaksanaan',
        'jumlah_anggota' => 'required|integer|min:1',
        'nidn_nidk' => 'nullable|string',
        'sertifikat' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'foto_penyerahan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'surat_tugas' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
    ]);

    $user = Auth::user();

    $kompetisi = KompetisiMandiri::where('id_kompetisi', $id)
        ->where('mahasiswa_id', $user->user_id)
        ->firstOrFail();

    // Reset status ke pending agar divalidasi ulang
    $kompetisi->status = 'pending';
    $kompetisi->nama_kegiatan = $request->nama_kegiatan;
    $kompetisi->link_penyelenggara = $request->link_penyelenggara;
    $kompetisi->dospem = $request->dospem;
    $kompetisi->capaian_prestasi = $request->capaian_prestasi;
    $kompetisi->jenis_kepesertaan = $request->jenis_kepesertaan;
    $kompetisi->tanggal_pelaksanaan = $request->tanggal_pelaksanaan;
    $kompetisi->tanggal_selesai = $request->tanggal_selesai;
    $kompetisi->jumlah_anggota = $request->jumlah_anggota;
    $kompetisi->nidn_nidk = $request->nidn_nidk;

    // Handle file upload - Simpan hanya nama file
    if ($request->hasFile('sertifikat')) {
        if ($kompetisi->sertifikat && Storage::disk('public')->exists('uploads/sertifikat/' . $kompetisi->sertifikat)) {
            Storage::disk('public')->delete('uploads/sertifikat/' . $kompetisi->sertifikat);
        }

        $file = $request->file('sertifikat');
        $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('uploads/sertifikat', $filename, 'public');
        $kompetisi->sertifikat = $filename;
    }

    if ($request->hasFile('foto_penyerahan')) {
        if ($kompetisi->foto_penyerahan && Storage::disk('public')->exists('uploads/foto_penyerahan/' . $kompetisi->foto_penyerahan)) {
            Storage::disk('public')->delete('uploads/foto_penyerahan/' . $kompetisi->foto_penyerahan);
        }

        $file = $request->file('foto_penyerahan');
        $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('uploads/foto_penyerahan', $filename, 'public');
        $kompetisi->foto_penyerahan = $filename;
    }

    if ($request->hasFile('surat_tugas')) {
        if ($kompetisi->surat_tugas && Storage::disk('public')->exists('uploads/surat_tugas/' . $kompetisi->surat_tugas)) {
            Storage::disk('public')->delete('uploads/surat_tugas/' . $kompetisi->surat_tugas);
        }

        $file = $request->file('surat_tugas');
        $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('uploads/surat_tugas', $filename, 'public');
        $kompetisi->surat_tugas = $filename;
    }

    $kompetisi->save();

    // Update juga entri Sertifikat terkait
    $sertifikat = Sertifikat::where('id_kompetisi', $kompetisi->id_kompetisi)->first();
    if ($sertifikat) {
        $sertifikat->update([
            'nama_kegiatan' => $request->nama_kegiatan,
            'status' => 'pending',
            'revisi_alasan' => null,
            'validator_id' => null,
        ]);
    }

    return redirect()->route('daftar')->with('success', 'Data kompetisi mandiri berhasil diperbarui dan status dikembalikan ke pending.');
}

}
