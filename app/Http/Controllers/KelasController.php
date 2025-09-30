<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::latest()->get();
        return response()->json([
            'data' => $kelas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Typically returns a view. Returning schema info for API usage.
        return response()->json([
            'fields' => [
                'nama_kelas' => 'string|required',
            ],
        ]);
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

        return response()->json([
            'message' => 'Kelas created successfully',
            'data' => $kelas,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelas $kelas)
    {
        return response()->json([
            'data' => $kelas,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelas $kelas)
    {
        // Typically returns a view. Returning current resource for editing.
        return response()->json([
            'data' => $kelas,
            'fields' => [
                'nama_kelas' => 'string|required',
            ],
        ]);
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

        return response()->json([
            'message' => 'Kelas updated successfully',
            'data' => $kelas->refresh(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kelas)
    {
        $kelas->delete();
        return response()->json([
            'message' => 'Kelas deleted successfully',
        ]);
    }

    /**
     * List siswa grouped by kelas, each kelas appears once with its siswa.
     */
    public function siswaPerKelas(): JsonResponse
    {
        $list = Kelas::with(['siswa' => function ($q) {
            $q->orderBy('nama_siswa');
        }])->orderBy('nama_kelas')->get();

        return response()->json([
            'data' => $list,
        ]);
    }

    /**
     * List guru grouped by kelas, each kelas appears once with its guru.
     */
    public function guruPerKelas(): JsonResponse
    {
        $list = Kelas::with(['guru' => function ($q) {
            $q->orderBy('nama_guru');
        }])->orderBy('nama_kelas')->get();

        return response()->json([
            'data' => $list,
        ]);
    }

    /**
     * List siswa, kelas, dan guru in one table-like payload, kelas unique.
     */
    public function rekapSemua(): JsonResponse
    {
        $list = Kelas::with([
            'siswa' => function ($q) { $q->orderBy('nama_siswa'); },
            'guru' => function ($q) { $q->orderBy('nama_guru'); },
        ])->orderBy('nama_kelas')->get();

        return response()->json([
            'data' => $list,
        ]);
    }
}
