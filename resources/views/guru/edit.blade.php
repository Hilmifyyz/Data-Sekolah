@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-4 text-gray-100">Edit Guru</h1>
<form action="{{ route('guru.update', $guru) }}" method="POST" class="bg-gray-800/60 p-6 rounded shadow space-y-4 border border-gray-700">
    @csrf
    @method('PUT')
    <div>
        <label class="block text-sm mb-1 text-gray-300">Nama Guru</label>
        <input type="text" name="nama_guru" value="{{ old('nama_guru', $guru->nama_guru) }}" class="w-full bg-gray-900 border border-gray-700 rounded px-3 py-2 text-gray-100" required />
    </div>
    <div>
        <label class="block text-sm mb-1 text-gray-300">Kelas</label>
        <select name="kelas_id" class="w-full bg-gray-900 border border-gray-700 rounded px-3 py-2 text-gray-100" required>
            @foreach($kelas as $k)
                <option value="{{ $k->id }}" @selected(old('kelas_id', $guru->kelas_id)==$k->id)>{{ $k->nama_kelas }}</option>
            @endforeach
        </select>
    </div>
    <div class="grid md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm mb-1 text-gray-300">Alamat</label>
            <input type="text" name="alamat" value="{{ old('alamat', $guru->alamat) }}" class="w-full bg-gray-900 border border-gray-700 rounded px-3 py-2 text-gray-100" required />
        </div>
        <div>
            <label class="block text-sm mb-1 text-gray-300">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $guru->tanggal_lahir) }}" class="w-full bg-gray-900 border border-gray-700 rounded px-3 py-2 text-gray-100" required />
        </div>
    </div>
    <div class="grid md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm mb-1 text-gray-300">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="w-full bg-gray-900 border border-gray-700 rounded px-3 py-2 text-gray-100" required>
                <option value="L" @selected(old('jenis_kelamin', $guru->jenis_kelamin)=='L')>Laki-laki</option>
                <option value="P" @selected(old('jenis_kelamin', $guru->jenis_kelamin)=='P')>Perempuan</option>
            </select>
        </div>
        <div>
            <label class="block text-sm mb-1 text-gray-300">Mapel</label>
            <input type="text" name="mapel" value="{{ old('mapel', $guru->mapel) }}" class="w-full bg-gray-900 border border-gray-700 rounded px-3 py-2 text-gray-100" required />
        </div>
    </div>
    <div class="flex items-center gap-2">
        <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update</button>
        <a href="{{ route('guru.index') }}" class="px-4 py-2 bg-gray-700 text-gray-100 rounded hover:bg-gray-600">Batal</a>
    </div>
</form>
@endsection
