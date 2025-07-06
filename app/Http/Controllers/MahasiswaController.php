<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Sertifikat;
use Illuminate\Support\Facades\Storage;
use App\Models\Periode;
use App\Models\Aktifitas;
use App\Models\KompetisiMandiri;
use App\Models\Kemendikbud;
use App\Models\Mbkm;
use App\Models\Rekognisi;

class MahasiswaController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $periodeAktif = Periode::where('status', 1)->first();

        $sertifikat = Sertifikat::where('mahasiswa_id', $user->user_id)->get();
        $sertifikatPending = $sertifikat->where('status', 'pending')->count();
        $sertifikatRevisi = $sertifikat->where('status', 'revisi')->count();
        $sertifikatDiterima = $sertifikat->where('status', 'terima')->count();
        $sertifikatDitolak = $sertifikat->where('status', 'tolak')->count();

        $aktifitas = Aktifitas::where('mahasiswa_id', $user->user_id)
            ->get()
            ->map(function ($item) {
                $item->type = 'aktifitas';
                return $item;
            });

        $kompetisiMandiri = KompetisiMandiri::where('mahasiswa_id', $user->user_id)
            ->get()
            ->map(function ($item) {
                $item->type = 'kompetisiMandiri';
                return $item;
            });

        $kemendikbud = Kemendikbud::where('mahasiswa_id', $user->user_id)
            ->get()
            ->map(function ($item) {
                $item->type = 'kemendikbud';
                return $item;
            });

        $mbkm = Mbkm::where('mahasiswa_id', $user->user_id)
            ->get()
            ->map(function ($item) {
                $item->type = 'mbkm';
                return $item;
            });

        $rekognisi = Rekognisi::where('mahasiswa_id', $user->user_id)
            ->get()
            ->map(function ($item) {
                $item->type = 'rekognisi';
                return $item;
            });

        $items = collect()->merge($kompetisiMandiri)->merge($aktifitas)->merge($kemendikbud)->merge($mbkm)->merge($rekognisi)->sortByDesc('created_at')->values();

        return view('dashboard', compact('periodeAktif', 'sertifikat', 'sertifikatPending', 'sertifikatRevisi', 'sertifikatDiterima', 'sertifikatDitolak', 'aktifitas', 'kompetisiMandiri', 'kemendikbud', 'mbkm', 'rekognisi', 'items'));
    }

    public function daftarPengajuan()
    {
        $user = Auth::user();

        // Ambil semua sertifikat milik mahasiswa ini, urut berdasarkan tanggal terbaru
        $sertifikat = Sertifikat::with(['periode', 'aktifitas', 'kompetisiMandiri', 'kemendikbud', 'mbkm', 'rekognisi', 'validator'])
            ->where('mahasiswa_id', $user->user_id) // sesuaikan dengan pk user_id
            ->orderBy('created_at', 'desc')
            ->get();

        return view('mahasiswa.daftar', compact('sertifikat'));
    }

    public function edit($id)
    {
        $user = Auth::user();

        // Ambil sertifikat milik user yang login
        $sertifikat = Sertifikat::with(['aktifitas', 'kompetisiMandiri', 'kemendikbud', 'mbkm', 'rekognisi'])
            ->where('mahasiswa_id', $user->user_id)
            ->findOrFail($id);

        if ($sertifikat->aktifitas) {
            $aktifitas = $sertifikat->aktifitas;
            return view('mahasiswa.aktifitas.edit', compact('aktifitas', 'sertifikat'));
        } elseif ($sertifikat->kompetisiMandiri) {
            $kompetisi = $sertifikat->kompetisiMandiri; // Ambil dari relasi
            return view('mahasiswa.kompetisi-Mandiri.edit', compact('kompetisi', 'sertifikat'));
        } elseif ($sertifikat->kemendikbud) {
            $kemendikbud = $sertifikat->kemendikbud;
            return view('mahasiswa.kemen.edit', compact('kemendikbud', 'sertifikat'));
        } elseif ($sertifikat->mbkm) {
            $mbkm = $sertifikat->mbkm;
            return view('mahasiswa.mbkm.edit', compact('mbkm', 'sertifikat'));
        } elseif ($sertifikat->rekognisi) {
            $rekognisi = $sertifikat->rekognisi;
            return view('mahasiswa.rekognisi.edit', compact('rekognisi', 'sertifikat'));
        } else {
            return redirect()->route('daftar')->with('error', 'Data tidak dapat diedit.');
        }
    }

    public function P()
    {
        return view('mahasiswa.pengajuan'); // Atur ke path view yang kamu inginkan
    }

    public function destroy($id)
    {
        $sertifikat = Sertifikat::where('id', $id)
            ->where('mahasiswa_id', auth()->user()->user_id)
            ->firstOrFail();

        // Cek status melalui accessor
        if (!in_array($sertifikat->status, ['pending', 'revisi'])) {
            return redirect()->route('daftar')->with('error', 'Pengajuan tidak dapat dihapus.');
        }

        // Hapus file jika ada
        if ($sertifikat->file_path && Storage::exists($sertifikat->file_path)) {
            Storage::delete($sertifikat->file_path);
        }

        $sertifikat->delete();

        return redirect()->route('daftar')->with('success', 'Pengajuan berhasil dihapus.');
    }
}
