<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <p class="mb-1">Halo, <strong>{{ auth()->user()->name }}</strong>!</p>
                <p class="mb-4 text-sm text-gray-600">
                    Role kamu:
                    <span class="px-2 py-0.5 rounded bg-indigo-100 text-indigo-700 font-medium">{{ auth()->user()->role }}</span>
                </p>

                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('posts.index') }}" class="px-4 py-2 bg-indigo-600 text-white rounded">Kelola Post</a>
                    <a href="{{ route('products.index') }}" class="px-4 py-2 bg-slate-700 text-white rounded">Katalog Produk</a>

                    {{-- Tombol disembunyikan untuk UX saja. Keamanan sebenarnya: middleware role:admin di route. --}}
                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-red-600 text-white rounded">Panel Admin</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
