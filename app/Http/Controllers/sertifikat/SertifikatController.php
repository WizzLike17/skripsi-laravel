<?php

namespace App\Http\Controllers\sertifikat;

use App\Http\Controllers\Controller;
use App\Models\Sertifikat;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class SertifikatController extends Controller
{

    public function index()
    {
        $query = Sertifikat::with(['periode', 'aktifitas', 'kompetisiMandiri', 'kemendikbud', 'mbkm', 'rekognisi', 'mahasiswa', 'validator'])
            ->whereHas('periode', fn($q) => $q->where('status', 1))

            ->where(function ($query) {
                $query->whereHas('aktifitas', fn($q) => $q->whereIn('status', ['pending', 'revisi']))->orWhereHas('kompetisiMandiri', fn($q) => $q->whereIn('status', ['pending', 'revisi']))->orWhereHas('kemendikbud', fn($q) => $q->whereIn('status', ['pending', 'revisi']))->orWhereHas('mbkm', fn($q) => $q->whereIn('status', ['pending', 'revisi']))->orWhereHas('rekognisi', fn($q) => $q->whereIn('status', ['pending', 'revisi']));
            });

        $sertifikat = $query
            ->latest()
            ->paginate(10)
            ->appends(request()->query());

        return view('admin.daftarpengajuan', compact('sertifikat'));
    }

    public function show($id)
    {
        $sertifikat = Sertifikat::with(['periode', 'aktifitas', 'kompetisiMandiri', 'kemendikbud', 'mbkm', 'rekognisi', 'mahasiswa', 'validator'])->findOrFail($id);

        return view('admin.validasi', compact('sertifikat'));
    }

    public function validasi(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:terima,tolak,revisi',
            'nilai' => 'nullable|numeric|min:0|max:100',
            'alasan_revisi' => $request->status === 'revisi' ? 'required|string|max:255' : 'nullable',
        ]);

        $sertifikat = Sertifikat::findOrFail($id);
        $sertifikat->validator_id = auth()->user()->user_id;
        $sertifikat->nilai = $request->nilai;

        if ($request->status === 'revisi') {
            $sertifikat->revisi_alasan = trim($request->alasan_revisi);
        } else {
            $sertifikat->revisi_alasan = null;
        }

        $sertifikat->save();

        if ($sertifikat->mbkm) {
            $sertifikat->mbkm->status = $request->status;
            $sertifikat->mbkm->save();
        }

        if ($sertifikat->kemendikbud) {
            $sertifikat->kemendikbud->status = $request->status;
            $sertifikat->kemendikbud->save();
        }

        if ($sertifikat->kompetisiMandiri) {
            $sertifikat->kompetisiMandiri->status = $request->status;
            $sertifikat->kompetisiMandiri->save();
        }

        if ($sertifikat->aktifitas) {
            $sertifikat->aktifitas->status = $request->status;
            $sertifikat->aktifitas->save();
        }

        if ($sertifikat->rekognisi) {
            $sertifikat->rekognisi->status = $request->status;
            $sertifikat->rekognisi->save();
        }

        return redirect()->route('sertifikat.index')->with('success', 'Sertifikat berhasil divalidasi.');
    }

    public function hasil(Request $request)
    {
        $query = Sertifikat::with(['mahasiswa', 'validator', 'kompetisiMandiri', 'aktifitas', 'kemendikbud', 'mbkm', 'rekognisi', 'periode']);

        if (!$request->has('periode_id')) {
            $periodeAktif = \App\Models\Periode::whereDate('tanggal_mulai', '<=', now())->whereDate('tanggal_selesai', '>=', now())->first();

            if ($periodeAktif) {
                $query->where('periode_id', $periodeAktif->periode_id);
                $request->merge(['periode_id' => $periodeAktif->id]); 
            }
        } elseif ($request->filled('periode_id')) {
            $query->where('periode_id', $request->periode_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('mahasiswa', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%")->orWhere('nim', 'like', "%{$search}%");
                })
                    ->orWhere('nama_kegiatan', 'like', "%{$search}%")
                    ->orWhereHas('validator', fn($q) => $q->where('nama', 'like', "%{$search}%"))
                    ->orWhereHas('periode', function ($q) use ($search) {
                        $q->where('jenis_periode', 'like', "%{$search}%")
                            ->orWhereYear('tanggal_mulai', 'like', "%{$search}%")
                            ->orWhereYear('tanggal_selesai', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('status')) {
            $status = $request->status;
            $query->where(function ($q) use ($status) {
                $q->whereHas('aktifitas', fn($q2) => $q2->where('status', $status))->orWhereHas('kompetisiMandiri', fn($q2) => $q2->where('status', $status))->orWhereHas('kemendikbud', fn($q2) => $q2->where('status', $status))->orWhereHas('mbkm', fn($q2) => $q2->where('status', $status))->orWhereHas('rekognisi', fn($q2) => $q2->where('status', $status));
            });
        }

        $sertifikat = $query->latest()->paginate(10)->appends($request->query());

        $periodes = \App\Models\Periode::orderBy('tanggal_mulai', 'desc')->get();

        return view('admin.hasil', compact('sertifikat', 'periodes'));
    }

    public function getSertifikatWithMahasiswaNim()
    {
        $sertifikats = Sertifikat::with('mahasiswa')->get();

        foreach ($sertifikats as $sertifikat) {
            echo 'Tabel: ' . $sertifikat->getTable() . '<br>';
            echo 'NIM Mahasiswa: ' . ($sertifikat->mahasiswa->nim ?? 'NIM tidak ada') . '<br>';
            echo '---------------------------------<br>';
        }
    }

    public function total(Request $request)
    {
        $periodeAktif = \App\Models\Periode::where('status', 1)->first();

        if (!$request->has('periode_id')) {
            $periodeId = $periodeAktif->periode_id ?? null;
        } elseif ($request->filled('periode_id')) {
            $periodeId = $request->periode_id; 
        } else {
            $periodeId = null; 
        }

        $allData = \App\Models\User::where('role', 'mahasiswa')
            ->with([
                'sertifikats' => function ($q) use ($periodeId) {
                    
                    $q->where(function ($q2) {
                        $q2->whereHas('aktifitas', fn($sub) => $sub->where('status', 'terima'))->orWhereHas('kompetisiMandiri', fn($sub) => $sub->where('status', 'terima'))->orWhereHas('kemendikbud', fn($sub) => $sub->where('status', 'terima'))->orWhereHas('mbkm', fn($sub) => $sub->where('status', 'terima'))->orWhereHas('rekognisi', fn($sub) => $sub->where('status', 'terima'));
                    });

                    
                    if ($periodeId) {
                        $q->where('periode_id', $periodeId);
                    }

                    $q->with(['aktifitas', 'kompetisiMandiri', 'kemendikbud', 'mbkm', 'rekognisi']);
                },
            ])
            
            ->when($request->filled('search'), function ($q) use ($request) {
                $q->where(function ($query) use ($request) {
                    $query->where('nama', 'like', '%' . $request->search . '%')->orWhere('nim', 'like', '%' . $request->search . '%');
                });
            })
            ->get()
            
            ->map(function ($user) {
                $totalNilai = $user->sertifikats->sum('nilai');

                return (object) [
                    'mahasiswa' => $user,
                    'total_nilai' => $totalNilai,
                    'hasil' => $totalNilai / 5,
                    'sertifikat' => $user->sertifikats,
                ];
            })
            
            ->filter(fn($item) => $item->total_nilai > 0)
            ->values(); 

        
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
        $currentItems = $allData->slice(($currentPage - 1) * $perPage, $perPage)->values();
        $paginated = new LengthAwarePaginator($currentItems, $allData->count(), $perPage, $currentPage, [
            'path' => request()->url(),
            'query' => array_merge($request->query(), ['periode_id' => $periodeId]),
        ]);

        
        $periodes = \App\Models\Periode::orderBy('tanggal_mulai', 'desc')->get();

        return view('admin.hasiltotal', [
            'mahasiswaSertifikat' => $paginated,
            'periodes' => $periodes,
            'periodeAktif' => $periodeAktif,
        ]);
    }
}
