<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MahasiswaSertifikatExport implements FromView
{
    public function view(): View
    {
        $mahasiswaSertifikat = User::where('role', 'mahasiswa')
            ->with([
                'sertifikats' => function ($q) {
                    $q->whereHas('aktifitas', fn($q2) => $q2->where('status', 'terima'))
                      ->orWhereHas('kompetisiMandiri', fn($q2) => $q2->where('status', 'terima'))
                      ->orWhereHas('kemendikbud', fn($q2) => $q2->where('status', 'terima'))
                      ->orWhereHas('mbkm', fn($q2) => $q2->where('status', 'terima'))
                      ->orWhereHas('rekognisi', fn($q2) => $q2->where('status', 'terima'));
                    $q->with(['aktifitas', 'kompetisiMandiri', 'kemendikbud', 'mbkm', 'rekognisi']);
                },
            ])
            ->get()
            ->map(function ($user) {
                $totalNilai = $user->sertifikats->sum('nilai');
                return (object)[
                    'mahasiswa' => $user,
                    'total_nilai' => $totalNilai,
                    'hasil' => $totalNilai / 5,
                    'sertifikat' => $user->sertifikats,
                ];
            })
            ->filter(fn($item) => $item->total_nilai > 0)
            ->values();

        return view('admin.exports.hasiltotal-excel', compact('mahasiswaSertifikat'));
    }
}
