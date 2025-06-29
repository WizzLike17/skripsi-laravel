<?php

namespace App\Http\Controllers;

use App\Models\Sertifikat;
use App\Models\Aktifitas;
use App\Models\KompetisiMandiri;
use App\Models\Kemendikbud;
use App\Models\Mbkm;
use App\Models\Rekognisi;
use App\Models\Periode;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua periode untuk dropdown
        $periodes = Periode::all();

        // Ambil periode yang dipilih (atau default ke periode aktif)
        $periodeId = $request->get('periode_id');
        $periodeAktif = $periodeId ? Periode::find($periodeId) : Periode::where('status', 1)->first();

        // Validasi jika periode tidak ditemukan
        if (!$periodeAktif) {
            return redirect()->back()->with('error', 'Periode tidak ditemukan.');
        }

        // Gunakan id dari periode aktif
        $periodeId = $periodeAktif->periode_id;

        // Ambil sertifikat berdasarkan periode yang dipilih
        $sertifikat = Sertifikat::with(['aktifitas', 'kompetisiMandiri', 'kemendikbud', 'mbkm', 'rekognisi', 'mahasiswa'])
            ->where('periode_id', $periodeId)
            ->get();

        // Hitung total sertifikat
        $totalSertifikat = $sertifikat->count();

        // Hitung berdasarkan status
        $pending = $sertifikat->where('status', 'pending')->count();
        $revisi = $sertifikat->where('status', 'revisi')->count();
        $diterima = $sertifikat->where('status', 'terima')->count();
        $ditolak = $sertifikat->where('status', 'tolak')->count();

        // Ambil id kategori dari sertifikat yang ada
        $aktifitasIds = $sertifikat->pluck('id_aktifitas')->filter()->unique();
        $kompetisiMandiriIds = $sertifikat->pluck('id_kompetisi')->filter()->unique();
        $kemendikbudIds = $sertifikat->pluck('id_kmdb')->filter()->unique();
        $mbkmIds = $sertifikat->pluck('id_mbkm')->filter()->unique();
        $rekognisiIds = $sertifikat->pluck('id_rekognisi')->filter()->unique();

        // Ambil kategori terkait
        $aktifitas = Aktifitas::whereIn('id_aktifitas', $aktifitasIds)->get();
        $kompetisiMandiri = KompetisiMandiri::whereIn('id_kompetisi', $kompetisiMandiriIds)->get();
        $kemendikbud = Kemendikbud::whereIn('id_kmdb', $kemendikbudIds)->get();
        $mbkm = Mbkm::whereIn('id_mbkm', $mbkmIds)->get();
        $rekognisi = Rekognisi::whereIn('id_rekognisi', $rekognisiIds)->get();

        // Riwayat pengajuan terbaru
        $riwayat = $sertifikat->sortByDesc('created_at')->take(10);

        return view('admin.dashboard', compact('periodes', 'periodeAktif', 'totalSertifikat', 'pending', 'revisi', 'diterima', 'ditolak', 'aktifitas', 'kompetisiMandiri', 'kemendikbud', 'mbkm', 'rekognisi', 'riwayat'));
    }
}
