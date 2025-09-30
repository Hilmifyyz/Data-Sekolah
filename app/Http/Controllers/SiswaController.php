<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswas = Siswa::with('kelas')->latest()->get();
        return response()->json(['data' => $siswas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Typically returns a view. Returning schema info and kelas options.
        return response()->json([
            'fields' => [
                'kelas_id' => 'exists:kelas,id|required',
                'nama_siswa' => 'string|required',
                'alamat' => 'string|required',
                'tanggal_lahir' => 'date|required',
                'jenis_kelamin' => 'in:L,P|required',
            ],
            'options' => [
                'kelas' => Kelas::orderBy('nama_kelas')->get(['id','nama_kelas']),
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kelas_id' => ['required', 'exists:kelas,id'],
            'nama_siswa' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required', 'in:L,P'],
        ]);

        $siswa = Siswa::create($validated);

        return response()->json([
            'message' => 'Siswa created successfully',
            'data' => $siswa->load('kelas'),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa)
    {
        return response()->json(['data' => $siswa->load('kelas')]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
    {
        return response()->json([
            'data' => $siswa->load('kelas'),
            'options' => [
                'kelas' => Kelas::orderBy('nama_kelas')->get(['id','nama_kelas']),
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siswa $siswa)
    {
        $validated = $request->validate([
            'kelas_id' => ['required', 'exists:kelas,id'],
            'nama_siswa' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required', 'in:L,P'],
        ]);

        $siswa->update($validated);

        return response()->json([
            'message' => 'Siswa updated successfully',
            'data' => $siswa->refresh()->load('kelas'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return response()->json(['message' => 'Siswa deleted successfully']);
    }
}
