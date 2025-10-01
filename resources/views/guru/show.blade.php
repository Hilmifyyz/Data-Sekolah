@extends('layouts.app')

@section('content')
<div class="bg-gray-800/60 border border-gray-700 rounded p-6 shadow">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-semibold text-gray-100">Detail Guru</h1>
        <a href="{{ route('guru.index') }}" class="px-3 py-1.5 rounded bg-gray-700 text-gray-100 hover:bg-gray-600">Kembali</a>
    </div>

    <dl class="grid md:grid-cols-2 gap-4 text-gray-200">
        <div>
            <dt class="text-sm text-gray-400">Nama Guru</dt>
            <dd class="text-lg">{{ $guru->nama_guru }}</dd>
        </div>
        <div>
            <dt class="text-sm text-gray-400">Kelas</dt>
            <dd class="text-lg">{{ $guru->kelas->nama_kelas ?? '-' }}</dd>
        </div>
        <div>
            <dt class="text-sm text-gray-400">Mapel</dt>
            <dd class="text-lg">{{ $guru->mapel }}</dd>
        </div>
        <div>
            <dt class="text-sm text-gray-400">Jenis Kelamin</dt>
            <dd class="text-lg">{{ $guru->jenis_kelamin }}</dd>
        </div>
        <div>
            <dt class="text-sm text-gray-400">Tanggal Lahir</dt>
            <dd class="text-lg">{{ $guru->tanggal_lahir }}</dd>
        </div>
        <div class="md:col-span-2">
            <dt class="text-sm text-gray-400">Alamat</dt>
            <dd class="text-lg">{{ $guru->alamat }}</dd>
        </div>
    </dl>

    <div class="mt-6 flex gap-2">
        <a href="{{ route('guru.edit', $guru) }}" class="px-4 py-2 rounded bg-yellow-500 text-white hover:bg-yellow-600">Edit</a>
        <form action="{{ route('guru.destroy', $guru) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
            @csrf
            @method('DELETE')
            <button class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700">Hapus</button>
        </form>
    </div>
</div>
@endsection
