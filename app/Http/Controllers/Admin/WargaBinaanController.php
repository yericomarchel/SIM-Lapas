<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WargaBinaan;
use App\Models\Kamar; // <-- IMPORT KAMAR
use Illuminate\Http\Request;

class WargaBinaanController extends Controller
{
    public function index()
    {
        // Ambil data warga binaan dengan relasi kamarnya (Eager Loading)
        $wargaBinaan = WargaBinaan::with('kamar')->latest()->paginate(10);
        return view('admin.wargabinaan.index', compact('wargaBinaan'));
    }

    public function create()
    {
        // Ambil semua data kamar untuk ditampilkan di dropdown
        $kamar = Kamar::orderBy('nama_kamar')->get();
        return view('admin.wargabinaan.create', compact('kamar'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nomor_registrasi' => 'required|string|max:255|unique:warga_binaan',
            'kamar_id' => 'required|exists:kamar,id', // <-- Validasi baru
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        WargaBinaan::create($request->all());

        return redirect()->route('admin.warga-binaan.index')->with('success', 'Data Warga Binaan berhasil ditambahkan.');
    }

    public function edit(WargaBinaan $warga_binaan)
    {
        $kamar = Kamar::orderBy('nama_kamar')->get();
        return view('admin.wargabinaan.edit', compact('warga_binaan', 'kamar'));
    }

    public function update(Request $request, WargaBinaan $warga_binaan)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nomor_registrasi' => 'required|string|max:255|unique:warga_binaan,nomor_registrasi,' . $warga_binaan->id,
            'kamar_id' => 'required|exists:kamar,id', // <-- Validasi baru
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        $warga_binaan->update($request->all());

        return redirect()->route('admin.warga-binaan.index')->with('success', 'Data Warga Binaan berhasil diupdate.');
    }

    public function destroy(WargaBinaan $warga_binaan)
    {
        $warga_binaan->delete();
        return redirect()->route('admin.warga-binaan.index')->with('success', 'Data Warga Binaan berhasil dihapus.');
    }
}
