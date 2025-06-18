<?php

namespace App\Http\Controllers\Pengunjung;

use App\Http\Controllers\Controller;
use App\Models\HariLibur;
use App\Models\Kunjungan;
use App\Models\WargaBinaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class KunjunganController extends Controller
{
    /**
     * Display a listing of the resource.
     * Method ini belum kita gunakan.
     */
    public function index()
    {
        //
    }

    public function create()
    {
        // Ambil warga binaan yang aktif
        $wargaBinaan = WargaBinaan::where('status', 'Aktif')->orderBy('nama_lengkap')->get();

        // Ambil semua tanggal libur dari database dalam format Y-m-d
        $hariLibur = HariLibur::pluck('tanggal')->map(function ($date) {
            return $date->format('Y-m-d');
        })->toArray();

        // Kirim kedua data tersebut ke view
        return view('pengunjung.kunjungan.create', compact('wargaBinaan', 'hariLibur'));
    }


    public function store(Request $request)
    {
        // ... (Logika ambil $tanggalLibur tetap sama) ...
        $tanggalLibur = HariLibur::all()->map(function ($libur) {
            return $libur->tanggal->format('Y-m-d');
        })->toArray();

        // 1. Validasi Input (dengan perubahan pada 'nama_pengikut')
        $request->validate([
            'warga_binaan_id' => [ /* ... aturan validasi tetap sama ... */ ],
            'tanggal_kunjungan' => [ /* ... aturan validasi tetap sama ... */ ],
            'sesi_kunjungan' => 'required|string',

            // PERUBAHAN VALIDASI DI SINI
            'nama_pengikut' => 'nullable|array', // Sekarang divalidasi sebagai array
            'nama_pengikut.*' => 'nullable|string|max:255', // Validasi setiap item di dalam array

            'path_ktp' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'tanggal_kunjungan.not_in' => 'Tanggal yang dipilih adalah hari libur.'
        ]);

        // ... (Logika handle file upload tetap sama) ...
        $path = null;
        if ($request->hasFile('path_ktp')) {
            $path = $request->file('path_ktp')->store('ktp', 'public');
        }

        // PERUBAHAN LOGIKA PENYIMPANAN DI SINI
        // 1. Filter nama pengikut yang kosong
        $followers = array_filter($request->nama_pengikut ?? []);
        // 2. Gabungkan array nama menjadi satu string, dipisahkan koma
        $namaPengikutString = implode(', ', $followers);

        // 3. Simpan Data ke Database
        Kunjungan::create([
            'user_id' => Auth::id(),
            'warga_binaan_id' => $request->warga_binaan_id,
            'tanggal_kunjungan' => $request->tanggal_kunjungan,
            'sesi_kunjungan' => $request->sesi_kunjungan,
            'nama_pengikut' => $namaPengikutString, // Simpan string yang sudah digabung
            'path_ktp' => $path,
            'status' => 'Menunggu Persetujuan',
        ]);

        // ... (Logika redirect tetap sama) ...
        return redirect()->route('dashboard')
                        ->with('success', 'Pengajuan kunjungan berhasil dikirim. Silakan tunggu konfirmasi dari petugas.');
    }


    public function show(Kunjungan $kunjungan)
    {
        //
    }

    public function edit(Kunjungan $kunjungan)
    {
        //
    }


    public function update(Request $request, Kunjungan $kunjungan)
    {
        //
    }


    public function destroy(Kunjungan $kunjungan)
    {
        //
    }


    public function downloadPDF(Kunjungan $kunjungan)
    {
        // Keamanan: Pastikan hanya pemilik kunjungan yang bisa download
        if (auth()->id() !== $kunjungan->user_id) {
            abort(403, 'AKSES DITOLAK');
        }

        // Keamanan: Pastikan statusnya sudah disetujui
        if ($kunjungan->status !== 'Disetujui') {
            abort(403, 'Kunjungan belum disetujui atau ditolak.');
        }

        // Load relasi agar bisa digunakan di view PDF
        $kunjungan->load(['user', 'wargaBinaan', 'approver']);

        // Buat PDF dari view
        $pdf = Pdf::loadView('pdf.bukti_kunjungan', compact('kunjungan'));
        $pdf->setPaper('a4', 'portrait');

        // Buat nama file yang akan diunduh
        $filename = 'bukti-kunjungan-' . $kunjungan->wargaBinaan->nama_lengkap . '.pdf';

        // Download file
        return $pdf->download($filename);
    }
}
