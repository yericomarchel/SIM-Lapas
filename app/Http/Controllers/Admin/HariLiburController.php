<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HariLibur;
use Illuminate\Http\Request;

class HariLiburController extends Controller
{
    public function index()
    {
        $hariLibur = HariLibur::orderBy('tanggal', 'desc')->paginate(10);
        return view('admin.harilibur.index', compact('hariLibur'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date|unique:hari_libur',
            'keterangan' => 'required|string|max:255',
        ]);

        HariLibur::create($request->all());

        return redirect()->route('admin.hari-libur.index')->with('success', 'Hari libur berhasil ditambahkan.');
    }

    public function destroy(HariLibur $hariLibur)
    {
        $hariLibur->delete();
        return redirect()->route('admin.hari-libur.index')->with('success', 'Hari libur berhasil dihapus.');
    }
}
