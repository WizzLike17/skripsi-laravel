<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\sertifikat\MbkmController;
use App\Http\Controllers\sertifikat\KemendikbudController;
use App\Http\Controllers\sertifikat\AktifitasController;
use App\Http\Controllers\sertifikat\KompetisiMandiriController;
use App\Http\Controllers\sertifikat\RekognisiController;
use App\Http\Controllers\sertifikat\SertifikatController;
use App\Exports\MahasiswaSertifikatExport;
use App\Http\Controllers\DashboardAdminController;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')
    ->get('/dashboard', function () {
        $role = auth()->user()->role;

        if ($role == 'mahasiswa') {
            return redirect()->route('mahasiswa.dashboard');
        } elseif ($role == 'admin' || $role == 'validator') {
            return redirect()->route('admin.dashboard');
        } else {
            abort(403, 'Unauthorized.');
        }
    })
    ->name('dashboard');

Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/dashboard-mahasiswa', [MahasiswaController::class, 'dashboard'])->name('mahasiswa.dashboard');

    Route::get('/daftar-pengajuan', [MahasiswaController::class, 'daftarPengajuan'])->name('daftar');
    Route::get('/mahasiswa/edit/{id}', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');

    Route::get('/pengajuan', [MahasiswaController::class, 'P'])->name('pengajuan');
    Route::delete('/sertifikat/{id}', [MahasiswaController::class, 'destroy'])->name('hapus');

    Route::prefix('pengajuan')->group(function () {
        Route::resource('mbkm', MbkmController::class)->except(['show']);

        Route::resource('kemendikbud', KemendikbudController::class)->except(['show']);

        Route::resource('aktifitas', AktifitasController::class)->except(['show']);

        Route::resource('kompetisi-mandiri', KompetisiMandiriController::class)->except(['show']);

        Route::resource('rekognisi', RekognisiController::class)->except(['show']);
    });
});

Route::middleware(['auth', 'role:admin,validator'])->group(function () {
    Route::get('/dashboard-admin', [DashboardAdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/sertifikat/pengajuan', [SertifikatController::class, 'index'])->name('sertifikat.index');
    Route::get('/sertifikat/{id}', [SertifikatController::class, 'show'])->name('sertifikat.show');
    Route::patch('/sertifikat/{id}/validasi', [SertifikatController::class, 'validasi'])->name('sertifikat.validasi');

    Route::get('/Hasil', [SertifikatController::class, 'hasil'])->name('sertifikat.hasil');
    Route::get('/hasil/total', [SertifikatController::class, 'total'])->name('total');

    Route::get('/hasil/total/export', function () {
        return Excel::download(new MahasiswaSertifikatExport(), 'hasil_total_sertifikat.xlsx');
    })->name('sertifikat.export');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class)->except(['show']);

    Route::prefix('periodes')->group(function () {
        Route::get('/', [PeriodeController::class, 'index'])->name('periodes.index');
        Route::get('/create', [PeriodeController::class, 'create'])->name('periodes.create');
        Route::post('/', [PeriodeController::class, 'store'])->name('periodes.store');
        Route::get('/{periode}/edit', [PeriodeController::class, 'edit'])->name('periodes.edit');
        Route::put('/{periode}', [PeriodeController::class, 'update'])->name('periodes.update');
        Route::delete('/{periode}', [PeriodeController::class, 'destroy'])->name('periodes.destroy');
        Route::patch('/{periode}/toggle-status', [PeriodeController::class, 'toggleStatus'])->name('periodes.toggleStatus');
    });
});
