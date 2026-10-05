<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Panel Admin</h2></x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4 mb-8">
                @foreach ([['Users', $totalUsers], ['Produk', $totalProducts], ['Post', $totalPosts], ['Order', $totalOrders]] as [$label, $value])
                    <div class="bg-white shadow-sm rounded-lg p-5">
                        <p class="text-sm text-gray-500">{{ $label }}</p>
                        <p class="text-3xl font-bold">{{ $value }}</p>
                    </div>
                @endforeach
            </div>

            <div class="bg-white shadow-sm rounded-lg p-5">
                <h3 class="font-semibold mb-3">Order Terbaru</h3>
                <table class="w-full text-sm">
                    <thead><tr class="text-left border-b"><th class="py-2">#</th><th>Pelanggan</th><th>Status</th><th>Item</th></tr></thead>
                    <tbody>
                    @foreach ($latestOrders as $o)
                        <tr class="border-b"><td class="py-2">{{ $o->id }}</td><td>{{ $o->user->name }}</td><td>{{ $o->status }}</td><td>{{ $o->items_count }}</td></tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
