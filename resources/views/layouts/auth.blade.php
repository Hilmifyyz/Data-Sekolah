<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title ?? 'Masuk - CRUD Magang' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-900 text-gray-100 flex items-center justify-center p-6">
    <main class="w-full max-w-md">
        @if (session('success'))
            <div class="mb-4 p-3 rounded bg-emerald-900/50 text-emerald-300 border border-emerald-700">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="mb-4 p-3 rounded bg-red-900/50 text-red-300 border border-red-700">
                <div class="font-semibold mb-2">Terjadi kesalahan:</div>
                <ul class="list-disc ml-6">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </main>
</body>
</html>
