<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Katalog Produk</h2></x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6 flex flex-wrap gap-2">
                <a href="{{ route('products.index') }}"
                   class="px-3 py-1 rounded border {{ request('category') ? '' : 'bg-indigo-600 text-white' }}">Semua</a>
                @foreach ($categories as $c)
                    <a href="{{ route('products.index', ['category' => $c->slug]) }}"
                       class="px-3 py-1 rounded border {{ request('category') === $c->slug ? 'bg-indigo-600 text-white' : '' }}">{{ $c->name }}</a>
                @endforeach
            </div>

            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($products as $p)
                    <div class="bg-white border rounded-lg p-4 flex flex-col">
                        <span class="text-xs text-indigo-600">{{ $p->category->name }}</span>
                        <h3 class="font-semibold">{{ $p->name }}</h3>
                        <p class="text-lg font-bold mt-1">Rp {{ number_format($p->price, 0, ',', '.') }}</p>
                        <p class="text-xs text-gray-500">Stok: {{ $p->stock }}</p>
                        <div class="mt-2 flex flex-wrap gap-1">
                            @foreach ($p->tags as $t)
                                <span class="text-xs px-2 py-0.5 bg-gray-100 rounded">{{ $t->name }}</span>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">{{ $products->links() }}</div>
        </div>
    </div>
</x-app-layout>
