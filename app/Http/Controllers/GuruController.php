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
        return response()->json(['data' => $gurus]);
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
                'nama_guru' => 'string|required',
                'alamat' => 'string|required',
                'tanggal_lahir' => 'date|required',
                'jenis_kelamin' => 'in:L,P,Laki-laki,Perempuan|required',
                'mapel' => 'string|required',
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
            'nama_guru' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required', 'in:L,P,Laki-laki,Perempuan'],
            'mapel' => ['required', 'string', 'max:255'],
        ]);

        $guru = Guru::create($validated);

        return response()->json([
            'message' => 'Guru created successfully',
            'data' => $guru->load('kelas'),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Guru $guru)
    {
        return response()->json(['data' => $guru->load('kelas')]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guru $guru)
    {
        return response()->json([
            'data' => $guru->load('kelas'),
            'options' => [
                'kelas' => Kelas::orderBy('nama_kelas')->get(['id','nama_kelas']),
            ]
        ]);
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

        return response()->json([
            'message' => 'Guru updated successfully',
            'data' => $guru->refresh()->load('kelas'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guru $guru)
    {
        $guru->delete();
        return response()->json(['message' => 'Guru deleted successfully']);
    }
}
