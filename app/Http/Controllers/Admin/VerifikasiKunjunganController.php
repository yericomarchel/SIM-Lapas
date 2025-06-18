<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kunjungan;
use Illuminate\Http\Request;

class VerifikasiKunjunganController extends Controller
{
    public function index()
    {
        $requests = Kunjungan::with(['user', 'wargaBinaan']) // Eager loading untuk performa
                             ->where('status', 'Menunggu Persetujuan')
                             ->latest()
                             ->paginate(10);

        return view('admin.verifikasi.index', compact('requests'));
    }
    // ... (setelah method index)
public function show(Kunjungan $kunjungan)
{
    // load relasi untuk memastikan data ada
    $kunjungan->load(['user', 'wargaBinaan']);
    return view('admin.verifikasi.show', compact('kunjungan'));
}

public function approve(Kunjungan $kunjungan)
{
    $kunjungan->status = 'Disetujui';
    $kunjungan->approved_by_id = auth()->id();
    $kunjungan->save();

    return redirect()->route('admin.verifikasi.index')->with('success', 'Kunjungan telah disetujui.');
}

public function reject(Kunjungan $kunjungan)
{
    $kunjungan->status = 'Ditolak';
    $kunjungan->approved_by_id = auth()->id();
    $kunjungan->save();

    return redirect()->route('admin.verifikasi.index')->with('success', 'Kunjungan telah ditolak.');
}

}
