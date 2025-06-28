<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Periode;
use Carbon\Carbon;

class AutoTutupPeriode extends Command
{
    protected $signature = 'periode:autotutup';
    protected $description = 'Menutup periode otomatis jika tanggal selesai sudah lewat';

    public function handle()
    {
        $now = Carbon::now();
        Periode::where('status', true)
            ->where('tanggal_selesai', '<', $now)
            ->update(['status' => false]);

        $this->info('Periode yang sudah berakhir berhasil ditutup.');
    }
}
