<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $kamar = Kamar::orderBy('blok')->orderBy('nama_kamar')->paginate(10);
        return view('admin.kamar.index', compact('kamar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.kamar.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nama_kamar' => 'required|string|max:255',
            'blok' => 'required|string|max:255',
            'kapasitas' => 'required|integer|min:0',
        ]);
        Kamar::create($request->all());
        return redirect()->route('admin.kamar.index')->with('success', 'Kamar berhasil ditambahkan.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Kamar $kamar)
    {
        //
        return redirect()->route('admin.kamar.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kamar $kamar)
    {
        //
        return view('admin.kamar.edit', compact('kamar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kamar $kamar)
    {
        //
        $request->validate([
            'nama_kamar' => 'required|string|max:255',
            'blok' => 'required|string|max:255',
            'kapasitas' => 'required|integer|min:0',
        ]);
        $kamar->update($request->all());
        return redirect()->route('admin.kamar.index')->with('success', 'Kamar berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kamar $kamar)
    {
        //
        $kamar->delete();
        return redirect()->route('admin.kamar.index')->with('success', 'Kamar berhasil dihapus.');
    }
}
