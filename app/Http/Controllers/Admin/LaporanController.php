<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kunjungan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $kunjunganData = null;
        $stats = null;

        // Cek jika ada input tanggal dari form
        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            $tanggalMulai = Carbon::parse($request->tanggal_mulai)->startOfDay();
            $tanggalSelesai = Carbon::parse($request->tanggal_selesai)->endOfDay();

            // Ambil data kunjungan berdasarkan rentang tanggal
            $kunjunganData = Kunjungan::with(['user', 'wargaBinaan', 'approver'])
                                ->whereBetween('tanggal_kunjungan', [$tanggalMulai, $tanggalSelesai])
                                ->get();

            // Hitung statistik
            $stats = [
                'total' => $kunjunganData->count(),
                'disetujui' => $kunjunganData->where('status', 'Disetujui')->count(),
                'ditolak' => $kunjunganData->where('status', 'Ditolak')->count(),
                'menunggu' => $kunjunganData->where('status', 'Menunggu Persetujuan')->count(),
            ];
        }

        return view('admin.laporan.index', compact('kunjunganData', 'stats'));
    }

    public function exportPDF(Request $request)
    {
        $kunjunganData = null;
        $tanggalMulai = null;
        $tanggalSelesai = null;

        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            $tanggalMulai = Carbon::parse($request->tanggal_mulai)->startOfDay();
            $tanggalSelesai = Carbon::parse($request->tanggal_selesai)->endOfDay();

            $kunjunganData = Kunjungan::with(['user', 'wargaBinaan', 'approver'])
                                ->whereBetween('tanggal_kunjungan', [$tanggalMulai, $tanggalSelesai])
                                ->get();
        }

        $pdf = Pdf::loadView('pdf.laporan_kunjungan', compact('kunjunganData', 'tanggalMulai', 'tanggalSelesai'));
        return $pdf->download('laporan-kunjungan-'.now()->format('Y-m-d').'.pdf');
    }
}
