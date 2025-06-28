<?php

namespace App\Http\Controllers\sertifikat;

use App\Http\Controllers\Controller;
use App\Models\Rekognisi;
use App\Models\Sertifikat;
use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RekognisiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $rekognisi = Rekognisi::where('mahasiswa_id', $user->user_id)->get();
        return view('mahasiswa.rekognisi.daftar', compact('rekognisi'));
    }

    public function create()
    {
        $periode = Periode::where('status', true)->where('tanggal_mulai', '<=', now())->where('tanggal_selesai', '>=', now())->first();
        return view('mahasiswa.rekognisi.pengajuan', compact('periode'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string',
            'ketua' => 'required|string',
            'anggota' => 'nullable|string',
            'dospem' => 'required|string',
            'deskripsi_karya' => 'nullable|string',
            'nama_lembaga_mitra' => 'nullable|string',
            'no_surat_rekognisi' => 'nullable|string',
            'jenis_karya' => 'required|string',
            'link_acara' => 'nullable|url',
            'tahun' => 'required|integer',
            'surat_tugas' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'bukti_penyerahan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $periode = Periode::where('status', true)->where('tanggal_mulai', '<=', now())->where('tanggal_selesai', '>=', now())->first();

        if (!$periode) {
            return back()->with('error', 'Tidak ada periode aktif. Pengajuan tidak dapat dilakukan.');
        }
        $user = Auth::user();

        $rekognisi = new Rekognisi();
        $rekognisi->mahasiswa_id = $user->user_id;
        $rekognisi->nama_kegiatan = $request->nama_kegiatan;
        $rekognisi->ketua = $request->ketua;
        $rekognisi->anggota = $request->anggota;
        $rekognisi->dospem = $request->dospem;
        $rekognisi->deskripsi_karya = $request->deskripsi_karya;
        $rekognisi->nama_lembaga_mitra = $request->nama_lembaga_mitra;
        $rekognisi->no_surat_rekognisi = $request->no_surat_rekognisi;
        $rekognisi->jenis_karya = $request->jenis_karya;
        $rekognisi->link_acara = $request->link_acara;
        $rekognisi->tahun = $request->tahun;
        $rekognisi->status = 'pending'; // Status awal pengajuan

        // Upload files jika ada
        if ($request->hasFile('surat_tugas')) {
            $file = $request->file('surat_tugas');
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('uploads/surat_tugas', $filename, 'public');
            $rekognisi->surat_tugas = 'uploads/surat_tugas/' . $filename;
        }

        if ($request->hasFile('bukti_penyerahan')) {
            $file = $request->file('bukti_penyerahan');
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('uploads/bukti_penyerahan', $filename, 'public');
            $rekognisi->bukti_penyerahan = 'uploads/bukti_penyerahan/' . $filename;
        }

        $rekognisi->save();
        // Simpan data ke tabel sertifikat jika ada
        Sertifikat::create([
            'periode_id' => $periode->periode_id,
            'id_rekognisi' => $rekognisi->id_rekognisi,
            'mahasiswa_id' => $user->user_id,
            'nama_kegiatan' => $request->nama_kegiatan,
            'status' => 'pending',
            'validator_id' => null, // Belum ada validator pada saat pengajuan
        ]);
        return redirect()->route('rekognisi.index')->with('success', 'Data rekognisi berhasil disimpan.');
    }

    public function edit($id)
    {
        $user = Auth::user();
        $rekognisi = Rekognisi::where('id_rekognisi', $id)->where('mahasiswa_id', $user->user_id)->firstOrFail();

        return view('mahasiswa.rekognisi.edit', compact('rekognisi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string',
            'ketua' => 'required|string',
            'anggota' => 'nullable|string',
            'dospem' => 'required|string',
            'deskripsi_karya' => 'nullable|string',
            'nama_lembaga_mitra' => 'nullable|string',
            'no_surat_rekognisi' => 'nullable|string',
            'jenis_karya' => 'required|string',
            'link_acara' => 'nullable|url',
            'tahun' => 'required|integer',
            'surat_tugas' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'bukti_penyerahan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();

        $rekognisi = Rekognisi::where('id_rekognisi', $id)->where('mahasiswa_id', $user->user_id)->firstOrFail();

        $rekognisi->nama_kegiatan = $request->nama_kegiatan;
        $rekognisi->ketua = $request->ketua;
        $rekognisi->anggota = $request->anggota;
        $rekognisi->dospem = $request->dospem;
        $rekognisi->deskripsi_karya = $request->deskripsi_karya;
        $rekognisi->nama_lembaga_mitra = $request->nama_lembaga_mitra;
        $rekognisi->no_surat_rekognisi = $request->no_surat_rekognisi;
        $rekognisi->jenis_karya = $request->jenis_karya;
        $rekognisi->link_acara = $request->link_acara;
        $rekognisi->tahun = $request->tahun;
        $rekognisi->status = 'pending'; // Reset status agar divalidasi ulang

        // Update file surat_tugas jika ada
        if ($request->hasFile('surat_tugas')) {
            if ($rekognisi->surat_tugas && Storage::disk('public')->exists($rekognisi->surat_tugas)) {
                Storage::disk('public')->delete($rekognisi->surat_tugas);
            }
            $file = $request->file('surat_tugas');
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('uploads/surat_tugas', $filename, 'public');
            $rekognisi->surat_tugas = 'uploads/surat_tugas/' . $filename;
        }

        // Update file bukti_penyerahan jika ada
        if ($request->hasFile('bukti_penyerahan')) {
            if ($rekognisi->bukti_penyerahan && Storage::disk('public')->exists($rekognisi->bukti_penyerahan)) {
                Storage::disk('public')->delete($rekognisi->bukti_penyerahan);
            }
            $file = $request->file('bukti_penyerahan');
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('uploads/bukti_penyerahan', $filename, 'public');
            $rekognisi->bukti_penyerahan = 'uploads/bukti_penyerahan/' . $filename;
        }

        $rekognisi->save();

        // Update data sertifikat terkait
        Sertifikat::where('mahasiswa_id', $user->user_id)
            ->where('jenis', 'rekognisi')
            ->update([
                'nama_kegiatan' => $request->nama_kegiatan,
                'tahun' => $request->tahun,
                'status' => 'pending', // Reset status agar divalidasi ulang

            ]);

        return redirect()->route('rekognisi.index')->with('success', 'Data rekognisi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $rekognisi = Rekognisi::findOrFail($id);

        if ($rekognisi->surat_tugas && Storage::disk('public')->exists($rekognisi->surat_tugas)) {
            Storage::disk('public')->delete($rekognisi->surat_tugas);
        }

        if ($rekognisi->bukti_penyerahan && Storage::disk('public')->exists($rekognisi->bukti_penyerahan)) {
            Storage::disk('public')->delete($rekognisi->bukti_penyerahan);
        }

        $rekognisi->delete();

        return redirect()->route('rekognisi.index')->with('success', 'Data rekognisi berhasil dihapus.');
    }
}
