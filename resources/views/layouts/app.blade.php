<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title ?? 'CRUD Magang' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-gray-100">
    <nav class="bg-gray-900/70 backdrop-blur border-b border-gray-800 sticky top-0 z-10">
        <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">
            <div class="flex items-center gap-6">
                <a href="{{ url('/') }}" class="font-semibold text-lg text-gray-100">CRUD Magang</a>
                <a href="{{ route('kelas.index') }}" class="hover:text-blue-400 text-gray-300">Kelas</a>
                <a href="{{ route('siswa.index') }}" class="hover:text-blue-400 text-gray-300">Siswa</a>
                <a href="{{ route('guru.index') }}" class="hover:text-blue-400 text-gray-300">Guru</a>
                <a href="{{ url('rekap/siswa-per-kelas') }}" class="hover:text-blue-400 text-gray-300">Siswa/Kelas</a>
                <a href="{{ url('rekap/guru-per-kelas') }}" class="hover:text-blue-400 text-gray-300">Guru/Kelas</a>
                <a href="{{ url('rekap/semua') }}" class="hover:text-blue-400 text-gray-300">Rekap Semua</a>
            </div>
            <div class="flex items-center gap-4">
                @auth
                <span class="text-sm text-gray-300">{{ auth()->user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="px-3 py-1.5 rounded bg-red-600 text-white text-sm hover:bg-red-700">Logout</button>
                </form>
                @else
                <a class="px-3 py-1.5 rounded bg-blue-600 text-white text-sm hover:bg-blue-700" href="{{ route('login') }}">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto p-4 md:p-6">
        @if (session('success'))
            <div class="mb-4 p-3 rounded bg-emerald-900/40 text-emerald-300 border border-emerald-800">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="mb-4 p-3 rounded bg-red-900/40 text-red-300 border border-red-800">
                <div class="font-semibold mb-2">Terjadi kesalahan:</div>
                <ul class="list-disc ml-6">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{ $slot ?? '' }}
        @yield('content')
    </main>
</body>
</html>
