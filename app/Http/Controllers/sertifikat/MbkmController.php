<?php

namespace App\Http\Controllers\sertifikat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mbkm;
use App\Models\Sertifikat;
use App\Models\Periode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MbkmController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $mbkm = Mbkm::where('mahasiswa_id', $user->user_id)->get();
        return view('mahasiswa.mbkm.daftar', compact('mbkm'));
    }

    public function create()
    {
        $periode = Periode::where('status', true)->where('tanggal_mulai', '<=', now())->where('tanggal_selesai', '>=', now())->first();

        return view('mahasiswa.mbkm.pengajuan', compact('periode'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required',
            'ketua' => 'required',
            'anggota' => 'required',
            'dospem' => 'required',
            'keterlibatan_dospem' => 'required',
            'sumber_biaya' => 'required',
            'sertifikat' => 'required|file|mimes:pdf,jpg,png|max:2048',
            'nama_mitra' => 'required',
            'lokasi_mitra' => 'required',
            'surat_kerja_sama' => 'required|file|mimes:pdf,jpg,png|max:2048',
            'tanggal_pelaksanaan' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_pelaksanaan',
        ]);

        $sertifikatName = $request->file('sertifikat')->store('uploads/sertifikat', 'public');
        $suratKerjaSamaName = $request->file('surat_kerja_sama')->store('uploads/surat_kerja_sama', 'public');

        $user = Auth::user();

        // Simpan MBKM
        $mbkm = Mbkm::create([
            'mahasiswa_id' => $user->user_id,
            'nama_kegiatan' => $request->nama_kegiatan,
            'ketua' => $request->ketua,
            'anggota' => $request->anggota,
            'dospem' => $request->dospem,
            'keterlibatan_dospem' => $request->keterlibatan_dospem,
            'sumber_biaya' => $request->sumber_biaya,
            'sertifikat' => $sertifikatName,
            'nama_mitra' => $request->nama_mitra,
            'lokasi_mitra' => $request->lokasi_mitra,
            'surat_kerja_sama' => $suratKerjaSamaName,
            'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => 'pending',
        ]);

        // Cek apakah ada periode aktif
        $periode = Periode::where('status', true)->where('tanggal_mulai', '<=', now())->where('tanggal_selesai', '>=', now())->first();

        if (!$periode) {
            return back()->with('error', 'Tidak ada periode aktif. Pengajuan tidak dapat dilakukan.');
        }
        // Simpan Sertifikat
        Sertifikat::create([
            'periode_id' => $periode->periode_id ?? 1, // fallback jika tidak ada
            'id_mbkm' => $mbkm->id_mbkm,
            'mahasiswa_id' => $user->user_id,
            'nama_kegiatan' => $request->nama_kegiatan,
            'status' => 'pending',
            'validator_id' => null,
        ]);

        return redirect()->route('mbkm.index')->with('success', 'Pengajuan MBKM berhasil disimpan dan sertifikat dibuat.');
    }

    public function edit($id)
    {
        $user = Auth::user();
        $mbkm = Mbkm::with('sertifikatRel')->where('id_mbkm', $id)->where('mahasiswa_id', $user->user_id)->firstOrFail();

        return view('mahasiswa.mbkm.edit', compact('mbkm'));
    }

    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'nama_kegiatan' => 'required|string',
    //         'ketua' => 'required|string',
    //         'anggota' => 'required|string',
    //         'dospem' => 'required|string',
    //         'keterlibatan_dospem' => 'required|string',
    //         'sumber_biaya' => 'required|string',
    //         'sertifikat' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
    //         'nama_mitra' => 'required|string',
    //         'lokasi_mitra' => 'required|string',
    //         'surat_kerja_sama' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
    //         'tanggal_pelaksanaan' => 'required|date',
    //         'tanggal_selesai' => 'required|date|after_or_equal:tanggal_pelaksanaan',
    //     ]);

    //     $user = Auth::user();
    //     $mbkm = Mbkm::where('id_mbkm', $id)
    //                 ->where('mahasiswa_id', $user->user_id)
    //                 ->firstOrFail();

    //     // Sertifikat
    //     if ($request->hasFile('sertifikat')) {
    //         if ($mbkm->sertifikat && Storage::exists($mbkm->sertifikat)) {
    //             Storage::delete($mbkm->sertifikat);
    //         }
    //         $mbkm->sertifikat = $request->file('sertifikat')->store('uploads/sertifikat');
    //     }

    //     // Surat Kerja Sama
    //     if ($request->hasFile('surat_kerja_sama')) {
    //         if ($mbkm->surat_kerja_sama && Storage::exists($mbkm->surat_kerja_sama)) {
    //             Storage::delete($mbkm->surat_kerja_sama);
    //         }
    //         $mbkm->surat_kerja_sama = $request->file('surat_kerja_sama')->store('uploads/surat_kerja_sama');
    //     }

    //     // Update data lainnya
    //     $mbkm->update([
    //         'nama_kegiatan' => $request->nama_kegiatan,
    //         'ketua' => $request->ketua,
    //         'anggota' => $request->anggota,
    //         'dospem' => $request->dospem,
    //         'keterlibatan_dospem' => $request->keterlibatan_dospem,
    //         'sumber_biaya' => $request->sumber_biaya,
    //         'nama_mitra' => $request->nama_mitra,
    //         'lokasi_mitra' => $request->lokasi_mitra,
    //         'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan,
    //         'tanggal_selesai' => $request->tanggal_selesai,
    //         'status' => 'pending',// Reset status ke pending saat update

    //     ]);

    //     return redirect()->route('mbkm.index')->with('success', 'Data MBKM berhasil diperbarui.');
    // }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string',
            'ketua' => 'required|string',
            'anggota' => 'required|string',
            'dospem' => 'required|string',
            'keterlibatan_dospem' => 'required|string',
            'sumber_biaya' => 'required|string',
            'sertifikat' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'nama_mitra' => 'required|string',
            'lokasi_mitra' => 'required|string',
            'surat_kerja_sama' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'tanggal_pelaksanaan' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_pelaksanaan',
        ]);

        $user = Auth::user();

        $mbkm = Mbkm::where('id_mbkm', $id)->where('mahasiswa_id', $user->user_id)->firstOrFail();

        // Handle file - Sertifikat
        if ($request->hasFile('sertifikat')) {
            if ($mbkm->sertifikat && Storage::disk('public')->exists('uploads/sertifikat/' . $mbkm->sertifikat)) {
                Storage::disk('public')->delete('uploads/sertifikat/' . $mbkm->sertifikat);
            }

            $sertifikatFile = $request->file('sertifikat');
            $sertifikatName = Str::random(20) . '.' . $sertifikatFile->getClientOriginalExtension();
            $sertifikatFile->storeAs('uploads/sertifikat', $sertifikatName, 'public');
            $mbkm->sertifikat = $sertifikatName;
        }

        // Handle file - Surat Kerja Sama
        if ($request->hasFile('surat_kerja_sama')) {
            if ($mbkm->surat_kerja_sama && Storage::disk('public')->exists('uploads/surat_kerja_sama/' . $mbkm->surat_kerja_sama)) {
                Storage::disk('public')->delete('uploads/surat_kerja_sama/' . $mbkm->surat_kerja_sama);
            }

            $suratFile = $request->file('surat_kerja_sama');
            $suratName = Str::random(20) . '.' . $suratFile->getClientOriginalExtension();
            $suratFile->storeAs('uploads/surat_kerja_sama', $suratName, 'public');
            $mbkm->surat_kerja_sama = $suratName;
        }

        // Update fields lainnya
        $mbkm->fill([
            'nama_kegiatan' => $request->nama_kegiatan,
            'ketua' => $request->ketua,
            'anggota' => $request->anggota,
            'dospem' => $request->dospem,
            'keterlibatan_dospem' => $request->keterlibatan_dospem,
            'sumber_biaya' => $request->sumber_biaya,
            'nama_mitra' => $request->nama_mitra,
            'lokasi_mitra' => $request->lokasi_mitra,
            'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => 'pending',
        ]);

        $mbkm->save();

        return redirect()->route('mbkm.index')->with('success', 'Data MBKM berhasil diperbarui dan status dikembalikan ke pending.');
    }

    public function destroy($id)
    {
        $data = Mbkm::findOrFail($id);

        // Hapus file surat kerja sama
        if ($data->surat_kerja_sama && Storage::exists($data->surat_kerja_sama)) {
            Storage::delete($data->surat_kerja_sama);
        }

        // Hapus file sertifikat
        if ($data->sertifikat && Storage::exists($data->sertifikat)) {
            Storage::delete($data->sertifikat);
        }

        // Hapus sertifikat terkait jika ada
        Sertifikat::where('id_mbkm', $data->id_mbkm)->delete();

        // Hapus data MBKM
        $data->delete();

        return redirect()->route('mbkm.index')->with('success', 'Data MBKM dan sertifikat berhasil dihapus.');
    }
}
