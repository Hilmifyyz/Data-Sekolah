<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::latest()->get();
        return view('kelas.index', compact('kelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kelas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kelas' => ['required', 'string', 'max:255'],
        ]);

        $kelas = Kelas::create($validated);
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelas $kelas)
    {
        return view('kelas.show', compact('kelas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelas $kelas)
    {
        return view('kelas.edit', compact('kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kelas $kelas)
    {
        $validated = $request->validate([
            'nama_kelas' => ['required', 'string', 'max:255'],
        ]);

        $kelas->update($validated);
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kelas)
    {
        $kelas->delete();
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dihapus');
    }

    /**
     * List siswa grouped by kelas, each kelas appears once with its siswa.
     */
    public function siswaPerKelas()
    {
        $list = Kelas::with(['siswa' => function ($q) {
            $q->orderBy('nama_siswa');
        }])->orderBy('nama_kelas')->get();
        return view('rekap.siswa_per_kelas', compact('list'));
    }

    /**
     * List guru grouped by kelas, each kelas appears once with its guru.
     */
    public function guruPerKelas()
    {
        $list = Kelas::with(['guru' => function ($q) {
            $q->orderBy('nama_guru');
        }])->orderBy('nama_kelas')->get();
        return view('rekap.guru_per_kelas', compact('list'));
    }

    /**
     * List siswa, kelas, dan guru in one table-like payload, kelas unique.
     */
    public function rekapSemua()
    {
        $list = Kelas::with([
            'siswa' => function ($q) { $q->orderBy('nama_siswa'); },
            'guru' => function ($q) { $q->orderBy('nama_guru'); },
        ])->orderBy('nama_kelas')->get();
        return view('rekap.semua', compact('list'));
    }
}
