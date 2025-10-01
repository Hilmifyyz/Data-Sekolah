@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-4 text-gray-100">Rekap Siswa, Kelas, dan Guru</h1>
<div class="bg-gray-800/60 border border-gray-700 shadow rounded overflow-hidden">
    <table class="min-w-full text-sm text-gray-200">
        <thead class="bg-gray-900/60 text-left text-gray-300">
            <tr>
                <th class="px-4 py-2">Kelas</th>
                <th class="px-4 py-2">Siswa</th>
                <th class="px-4 py-2">Guru</th>
            </tr>
        </thead>
        <tbody>
            @foreach($list as $k)
                <tr class="border-t border-gray-700 align-top">
                    <td class="px-4 py-2 font-medium">{{ $k->nama_kelas }}</td>
                    <td class="px-4 py-2">
                        @if($k->siswa->count())
                            <ul class="list-disc ml-5">
                                @foreach($k->siswa as $s)
                                    <li>{{ $s->nama_siswa }}</li>
                                @endforeach
                            </ul>
                        @else
                            <span class="text-gray-400">Tidak ada siswa</span>
                        @endif
                    </td>
                    <td class="px-4 py-2">
                        @if($k->guru->count())
                            <ul class="list-disc ml-5">
                                @foreach($k->guru as $g)
                                    <li>{{ $g->nama_guru }} — {{ $g->mapel }}</li>
                                @endforeach
                            </ul>
                        @else
                            <span class="text-gray-400">Tidak ada guru</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
