<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gurus = Guru::with('kelas')->latest()->get();
        return view('guru.index', compact('gurus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelas = Kelas::orderBy('nama_kelas')->get(['id','nama_kelas']);
        return view('guru.create', compact('kelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kelas_id' => ['required', 'exists:kelas,id'],
            'nama_guru' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required', 'in:L,P,Laki-laki,Perempuan'],
            'mapel' => ['required', 'string', 'max:255'],
        ]);
        Guru::create($validated);
        return redirect()->route('guru.index')->with('success', 'Guru berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Guru $guru)
    {
        $guru->load('kelas');
        return view('guru.show', compact('guru'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guru $guru)
    {
        $guru->load('kelas');
        $kelas = Kelas::orderBy('nama_kelas')->get(['id','nama_kelas']);
        return view('guru.edit', compact('guru','kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guru $guru)
    {
        $validated = $request->validate([
            'kelas_id' => ['required', 'exists:kelas,id'],
            'nama_guru' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required', 'in:L,P,Laki-laki,Perempuan'],
            'mapel' => ['required', 'string', 'max:255'],
        ]);
        $guru->update($validated);
        return redirect()->route('guru.index')->with('success', 'Guru berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guru $guru)
    {
        $guru->delete();
        return redirect()->route('guru.index')->with('success', 'Guru berhasil dihapus');
    }
}
