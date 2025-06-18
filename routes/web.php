<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Pengunjung\KunjunganController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\WargaBinaanController;
use App\Http\Controllers\Admin\HariLiburController;
use App\Http\Controllers\Admin\VerifikasiKunjunganController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\KamarController; // <-- TAMBAHKAN INI

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rute Halaman Depan (Publik)
Route::get('/', function () {
    return view('welcome');
});

// RUTE UNTUK SEMUA PENGGUNA YANG SUDAH LOGIN (AUTH)
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('verified')
        ->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/kunjungan/create', [KunjunganController::class, 'create'])->name('kunjungan.create');
    Route::post('/kunjungan', [KunjunganController::class, 'store'])->name('kunjungan.store');
    Route::get('/kunjungan/{kunjungan}/download', [KunjunganController::class, 'downloadPDF'])->name('kunjungan.download');
});

// GRUP RUTE KHUSUS UNTUK STAF ADMIN
Route::middleware(['auth', 'role:staf'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Master Data
    Route::resource('warga-binaan', WargaBinaanController::class);
    Route::resource('hari-libur', HariLiburController::class)->except(['show', 'edit', 'update']);
    Route::resource('kamar', KamarController::class); // <-- TAMBAHKAN RUTE INI

    // Transaksi
    Route::get('verifikasi', [VerifikasiKunjunganController::class, 'index'])->name('verifikasi.index');
    Route::get('verifikasi/{kunjungan}', [VerifikasiKunjunganController::class, 'show'])->name('verifikasi.show');
    Route::patch('verifikasi/{kunjungan}/approve', [VerifikasiKunjunganController::class, 'approve'])->name('verifikasi.approve');
    Route::patch('verifikasi/{kunjungan}/reject', [VerifikasiKunjunganController::class, 'reject'])->name('verifikasi.reject');

    // Laporan
    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('laporan/export', [LaporanController::class, 'exportPDF'])->name('laporan.export');
});


// Rute Autentikasi dari Breeze
require __DIR__.'/auth.php';
