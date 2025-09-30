<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;

Route::get('/', function () {
    return view('welcome');
});

// Auth routes (session based)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes example (uncomment middleware if you want to guard)
// Route::middleware('auth')->group(function () {
    Route::resource('siswa', SiswaController::class);
    Route::resource('guru', GuruController::class);
    Route::resource('kelas', KelasController::class);

    // Aggregation endpoints
    Route::get('rekap/siswa-per-kelas', [KelasController::class, 'siswaPerKelas']);
    Route::get('rekap/guru-per-kelas', [KelasController::class, 'guruPerKelas']);
    Route::get('rekap/semua', [KelasController::class, 'rekapSemua']);
// });
