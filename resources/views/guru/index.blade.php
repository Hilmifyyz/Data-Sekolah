@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-4">
    <h1 class="text-2xl font-semibold">Daftar Guru</h1>
    <a href="{{ route('guru.create') }}" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Tambah Guru</a>
</div>

<div class="bg-gray-800/60 border border-gray-700 shadow rounded overflow-hidden">
    <table class="min-w-full text-sm text-gray-200">
        <thead class="bg-gray-900/60 text-left text-gray-300">
            <tr>
                <th class="px-4 py-2">#</th>
                <th class="px-4 py-2">Nama</th>
                <th class="px-4 py-2">Kelas</th>
                <th class="px-4 py-2">Mapel</th>
                <th class="px-4 py-2">Jenis Kelamin</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($gurus as $i => $guru)
                <tr class="border-t border-gray-700">
                    <td class="px-4 py-2">{{ $i + 1 }}</td>
                    <td class="px-4 py-2">{{ $guru->nama_guru }}</td>
                    <td class="px-4 py-2">{{ $guru->kelas->nama_kelas ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $guru->mapel }}</td>
                    <td class="px-4 py-2">{{ $guru->jenis_kelamin }}</td>
                    <td class="px-4 py-2 flex gap-2">
                        <a href="{{ route('guru.edit', $guru) }}" class="px-3 py-1.5 rounded bg-yellow-500 text-white hover:bg-yellow-600">Edit</a>
                        <form action="{{ route('guru.destroy', $guru) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="px-3 py-1.5 rounded bg-red-600 text-white hover:bg-red-700">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-4 py-6 text-center text-gray-400">Belum ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
