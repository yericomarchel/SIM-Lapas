<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kunjungan;
use Carbon\Carbon; // <-- Jangan lupa import Carbon

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Jika role adalah 'staf', langsung alihkan ke dashboard admin
        if ($user->role === 'staf') {
            return redirect()->route('admin.dashboard');
        }

        // Jika role adalah 'pengunjung', ambil semua data kunjungannya
        $kunjungan = Kunjungan::where('user_id', $user->id)
                            ->with('wargaBinaan')
                            ->latest()
                            ->paginate(10);

        // ==========================================================
        // === LOGIKA BARU: Cek jadwal di minggu ini ===
        // ==========================================================
        $awalMingguIni = now()->startOfWeek(Carbon::MONDAY);
        $akhirMingguIni = now()->endOfWeek(Carbon::SUNDAY);

        // Cek dari data kunjungan yang sudah diambil, apakah ada yang tanggalnya di minggu ini
        // dan statusnya masih Menunggu atau sudah Disetujui.
        $sudahAdaJadwalMingguIni = $kunjungan->contains(function ($item) use ($awalMingguIni, $akhirMingguIni) {
            $tanggalKunjungan = Carbon::parse($item->tanggal_kunjungan);
            return $tanggalKunjungan->between($awalMingguIni, $akhirMingguIni)
                   && in_array($item->status, ['Menunggu Persetujuan', 'Disetujui']);
        });
        // ==========================================================
        // === AKHIR LOGIKA BARU ===
        // ==========================================================

        // Kirim semua data yang dibutuhkan ke view, termasuk variabel boolean baru kita
        return view('dashboard', compact('kunjungan', 'sudahAdaJadwalMingguIni'));
    }
}
