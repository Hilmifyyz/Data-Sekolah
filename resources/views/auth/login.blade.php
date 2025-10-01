@extends('layouts.auth')

@section('content')
<div class="bg-gray-800/60 backdrop-blur rounded-xl shadow border border-gray-700 p-6">
    <h1 class="text-2xl font-semibold mb-6 text-gray-100">Masuk</h1>
    <form action="{{ url('/login') }}" method="POST" class="space-y-5">
        @csrf
        <div>
            <label class="block text-sm mb-1 text-gray-300">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="w-full bg-gray-900 border border-gray-700 rounded px-3 py-2 text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-600/50" placeholder="you@example.com" required />
        </div>
        <div>
            <label class="block text-sm mb-1 text-gray-300">Password</label>
            <input type="password" name="password" class="w-full bg-gray-900 border border-gray-700 rounded px-3 py-2 text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-600/50" placeholder="••••••••" required />
        </div>
        <div class="flex items-center justify-between">
            <label class="inline-flex items-center gap-2 text-sm text-gray-300">
                <input type="checkbox" name="remember" class="rounded bg-gray-900 border-gray-700" /> Ingat saya
            </label>
            <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Masuk</button>
        </div>
    </form>
</div>
@endsection
