<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Guru;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Ensure a test user exists (idempotent)
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ]
        );

        Kelas::factory()->create([
            'nama_kelas' => 'PPLG 1',
        ]);

        Kelas::factory()->create([
            'nama_kelas' => 'PPLG 2',
        ]);

        Kelas::factory()->create([
            'nama_kelas' => 'PPLG 3',
        ]);

        // Prepare kelas ids
        $kelasIds = Kelas::query()->pluck('id')->all();

        // Seed 12 siswa, each assigned to a random kelas
        for ($i = 0; $i < 12; $i++) {
            Siswa::factory()->create([
                'kelas_id' => $kelasIds[array_rand($kelasIds)],
                // normalize to short form for controller validation
                'jenis_kelamin' => rand(0,1) ? 'L' : 'P',
            ]);
        }

        // Seed 6 guru, each assigned to a random kelas
        for ($i = 0; $i < 6; $i++) {
            Guru::factory()->create([
                'kelas_id' => $kelasIds[array_rand($kelasIds)],
                'jenis_kelamin' => rand(0,1) ? 'L' : 'P',
            ]);
        }
    }
}
