<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kunjungan;
use App\Models\WargaBinaan;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // 1. Data untuk Kartu Statistik
        $jumlahPengajuanBaru = Kunjungan::where('status', 'Menunggu Persetujuan')->count();
        $totalWargaBinaan = WargaBinaan::where('status', 'Aktif')->count();
        $kunjunganDisetujuiHariIni = Kunjungan::where('status', 'Disetujui')->whereDate('tanggal_kunjungan', today())->count();

        // 2. Data untuk daftar "Pengajuan Terbaru"
        $pengajuanTerbaru = Kunjungan::with(['user', 'wargaBinaan'])
                                ->where('status', 'Menunggu Persetujuan')
                                ->latest()
                                ->take(5) // Ambil 5 data terbaru
                                ->get();

        // 3. Data untuk "Jadwal Kunjungan Hari Ini"
        $jadwalHariIni = Kunjungan::with(['user', 'wargaBinaan'])
                            ->where('status', 'Disetujui')
                            ->whereDate('tanggal_kunjungan', today())
                            ->get();

        // Kirim semua data ke view
        return view('admin.dashboard', compact(
            'jumlahPengajuanBaru',
            'totalWargaBinaan',
            'kunjunganDisetujuiHariIni',
            'pengajuanTerbaru',
            'jadwalHariIni'
        ));
    }
}
