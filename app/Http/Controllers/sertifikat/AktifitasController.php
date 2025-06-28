<?php
namespace App\Http\Controllers\sertifikat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aktifitas;
use App\Models\Sertifikat;
use App\Models\Periode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AktifitasController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $aktifitas = Aktifitas::where('mahasiswa_id', $user->user_id)->get();
        return view('mahasiswa.aktifitas.daftar', compact('aktifitas'));
    }

    public function create()
    {
        $periode = Periode::where('status', true)->where('tanggal_mulai', '<=', now())->where('tanggal_selesai', '>=', now())->first();

        // Jika ada data pendukung yang ingin dikirim ke view, bisa ditambahkan di sini
        return view('mahasiswa.aktifitas.pengajuan', compact('periode'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string',
            'peserta' => 'required|string',
            'dospem' => 'required|string',
            'keterlibatan_dospem' => 'required|string',
            'surat_tugas' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'sertifikat' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'dokumentasi' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'deskripsi' => 'nullable|string',
            'link_penyelenggara' => 'nullable|url',
        ]);

        $periode = Periode::where('status', true)->where('tanggal_mulai', '<=', now())->where('tanggal_selesai', '>=', now())->first();

        if (!$periode) {
            return back()->with('error', 'Tidak ada periode aktif. Pengajuan tidak dapat dilakukan.');
        }

        $user = Auth::user();

        // Buat objek Aktifitas
        $aktifitas = new Aktifitas();
        $aktifitas->mahasiswa_id = $user->user_id;
        $aktifitas->nama_kegiatan = $request->nama_kegiatan;
        $aktifitas->peserta = $request->peserta;
        $aktifitas->dospem = $request->dospem;
        $aktifitas->keterlibatan_dospem = $request->keterlibatan_dospem;
        $aktifitas->deskripsi = $request->deskripsi;
        $aktifitas->link_penyelenggara = $request->link_penyelenggara;
        $aktifitas->status = 'pending';

        // Upload file jika ada
        if ($request->hasFile('surat_tugas')) {
            $file = $request->file('surat_tugas');
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('uploads/surat_tugas', $filename, 'public');
            $aktifitas->surat_tugas = 'uploads/surat_tugas/' . $filename;
        }

        if ($request->hasFile('sertifikat')) {
            $file = $request->file('sertifikat');
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('uploads/sertifikat', $filename, 'public');
            $aktifitas->sertifikat = 'uploads/sertifikat/' . $filename;
        }

        if ($request->hasFile('dokumentasi')) {
            $file = $request->file('dokumentasi');
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('uploads/dokumentasi', $filename, 'public');
            $aktifitas->dokumentasi = 'uploads/dokumentasi/' . $filename;
        }

        $aktifitas->save();

        // Simpan data ke tabel sertifikat
        Sertifikat::create([
            'periode_id' => $periode->periode_id,
            'id_aktifitas' => $aktifitas->id_aktifitas,
            'mahasiswa_id' => $user->user_id,
            'nama_kegiatan' => $aktifitas->nama_kegiatan,
            'status' => 'pending',
            'validator_id' => null,
        ]);

        return redirect()->route('aktifitas.index')->with('success', 'Data aktifitas berhasil disimpan.');
    }

    public function edit($id)
    {
        $user = Auth::user();
        $aktifitas = Aktifitas::where('id_aktifitas', $id)->where('mahasiswa_id', $user->user_id)->firstOrFail();

        return view('mahasiswa.aktifitas.edit', compact('aktifitas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string',
            'peserta' => 'required|string',
            'dospem' => 'required|string',
            'keterlibatan_dospem' => 'required|string',
            'surat_tugas' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'sertifikat' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'dokumentasi' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'deskripsi' => 'nullable|string',
            'link_penyelenggara' => 'nullable|url',
        ]);

        $user = Auth::user();

        $aktifitas = Aktifitas::where('id_aktifitas', $id)->where('mahasiswa_id', $user->user_id)->firstOrFail();

        // Handle file upload
        if ($request->hasFile('surat_tugas')) {
            if ($aktifitas->surat_tugas && Storage::disk('public')->exists($aktifitas->surat_tugas)) {
                Storage::disk('public')->delete($aktifitas->surat_tugas);
            }
            $file = $request->file('surat_tugas');
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('uploads/surat_tugas', $filename, 'public');
            $aktifitas->surat_tugas = 'uploads/surat_tugas/' . $filename;
        }

        if ($request->hasFile('sertifikat')) {
            if ($aktifitas->sertifikat && Storage::disk('public')->exists($aktifitas->sertifikat)) {
                Storage::disk('public')->delete($aktifitas->sertifikat);
            }
            $file = $request->file('sertifikat');
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('uploads/sertifikat', $filename, 'public');
            $aktifitas->sertifikat = 'uploads/sertifikat/' . $filename;
        }

        if ($request->hasFile('dokumentasi')) {
            if ($aktifitas->dokumentasi && Storage::disk('public')->exists($aktifitas->dokumentasi)) {
                Storage::disk('public')->delete($aktifitas->dokumentasi);
            }
            $file = $request->file('dokumentasi');
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('uploads/dokumentasi', $filename, 'public');
            $aktifitas->dokumentasi = 'uploads/dokumentasi/' . $filename;
        }

        // Update data aktifitas
        $aktifitas->nama_kegiatan = $request->nama_kegiatan;
        $aktifitas->peserta = $request->peserta;
        $aktifitas->dospem = $request->dospem;
        $aktifitas->keterlibatan_dospem = $request->keterlibatan_dospem;
        $aktifitas->deskripsi = $request->deskripsi;
        $aktifitas->link_penyelenggara = $request->link_penyelenggara;
        $aktifitas->status = 'pending'; // reset status agar divalidasi ulang
        $aktifitas->save();

        // Update entri di tabel sertifikat jika ada
        $sertifikat = Sertifikat::where('id_aktifitas', $aktifitas->id_aktifitas)->first();
        if ($sertifikat) {
            $sertifikat->update([
                'nama_kegiatan' => $aktifitas->nama_kegiatan,
                'status' => 'pending',
                'revisi_alasan' => null,
                'validator_id' => null,
            ]);
        }

        return redirect()->route('aktifitas.index')->with('success', 'Data aktifitas berhasil diperbarui dan status dikembalikan ke pending.');
    }

    public function destroy($id)
    {
        $user = Auth::user();

        $aktifitas = Aktifitas::where('id_aktifitas', $id)->where('mahasiswa_id', $user->user_id)->firstOrFail();

        // Hapus file-file terkait jika ada
        if ($aktifitas->surat_tugas && Storage::disk('public')->exists($aktifitas->surat_tugas)) {
            Storage::disk('public')->delete($aktifitas->surat_tugas);
        }
        if ($aktifitas->sertifikat && Storage::disk('public')->exists($aktifitas->sertifikat)) {
            Storage::disk('public')->delete($aktifitas->sertifikat);
        }
        if ($aktifitas->dokumentasi && Storage::disk('public')->exists($aktifitas->dokumentasi)) {
            Storage::disk('public')->delete($aktifitas->dokumentasi);
        }

        $aktifitas->delete();

        return redirect()->route('aktifitas.index')->with('success', 'Data aktifitas berhasil dihapus.');
    }
}
