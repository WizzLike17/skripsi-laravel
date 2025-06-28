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

        // Ambil sertifikat berdasarkan periode yang dipilih
        $sertifikat = Sertifikat::with(['aktifitas', 'kompetisiMandiri', 'kemendikbud', 'mbkm', 'rekognisi', 'mahasiswa'])
            ->when($periodeAktif, function ($query) use ($periodeAktif) {
                $query->where('periode_id', $periodeAktif->periode_id);
            })
            ->get();

        // Hitung total sertifikat
        $totalSertifikat = $sertifikat->count();

        // Hitung berdasarkan status
        $pending = $sertifikat->filter(fn($item) => $item->status === 'pending')->count();
        $revisi = $sertifikat->filter(fn($item) => $item->status === 'revisi')->count();
        $diterima = $sertifikat->filter(fn($item) => $item->status === 'terima')->count();
        $ditolak = $sertifikat->filter(fn($item) => $item->status === 'tolak')->count();

        // Summary Cards
        $aktifitas = Aktifitas::whereIn('id_aktifitas', function ($query) use ($periodeId) {
            $query->select('id_aktifitas')->from('sertifikat')->where('periode_id', $periodeId)->whereNotNull('id_aktifitas'); // Tambahkan ini untuk memastikan id_aktifitas ada
        })->get();

        $kompetisiMandiri = KompetisiMandiri::whereIn('id_kompetisi', function ($query) use ($periodeId) {
            $query->select('id_kompetisi')->from('sertifikat')->where('periode_id', $periodeId)->whereNotNull('id_kompetisi');
        })->get();

        $kemendikbud = Kemendikbud::whereIn('id_kmdb', function ($query) use ($periodeId) {
            $query->select('id_kmdb')->from('sertifikat')->where('periode_id', $periodeId)->whereNotNull('id_kmdb');
        })->get();

        $mbkm = Mbkm::whereIn('id_mbkm', function ($query) use ($periodeId) {
            $query->select('id_mbkm')->from('sertifikat')->where('periode_id', $periodeId)->whereNotNull('id_mbkm');
        })->get();

        $rekognisi = Rekognisi::whereIn('id_rekognisi', function ($query) use ($periodeId) {
            $query->select('id_rekognisi')->from('sertifikat')->where('periode_id', $periodeId)->whereNotNull('id_rekognisi');
        })->get();

        // Riwayat pengajuan terbaru
        $riwayat = $sertifikat->sortByDesc('created_at')->take(10);

        return view('admin.dashboard', compact('periodes', 'periodeAktif', 'totalSertifikat', 'pending', 'revisi', 'diterima', 'ditolak', 'aktifitas', 'kompetisiMandiri', 'kemendikbud', 'mbkm', 'rekognisi', 'riwayat'));
    }
}
