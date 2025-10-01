@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-4 text-gray-100">Edit Kelas</h1>
<form action="{{ route('kelas.update', $kelas) }}" method="POST" class="bg-gray-800/60 p-6 rounded shadow space-y-4 border border-gray-700">
    @csrf
    @method('PUT')
    <div>
        <label class="block text-sm mb-1 text-gray-300">Nama Kelas</label>
        <input type="text" name="nama_kelas" value="{{ old('nama_kelas', $kelas->nama_kelas) }}" class="w-full bg-gray-900 border border-gray-700 rounded px-3 py-2 text-gray-100" required />
    </div>
    <div class="flex items-center gap-2">
        <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update</button>
        <a href="{{ route('kelas.index') }}" class="px-4 py-2 bg-gray-700 text-gray-100 rounded hover:bg-gray-600">Batal</a>
    </div>
</form>
@endsection
