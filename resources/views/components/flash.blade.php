{{-- Flash message sukses/gagal. Pakai: <x-flash /> --}}
@if (session('success'))
    <div class="mb-4 rounded border border-green-300 bg-green-100 p-3 text-green-800">{{ session('success') }}</div>
@endif
@if (session('error'))
    <div class="mb-4 rounded border border-red-300 bg-red-100 p-3 text-red-800">{{ session('error') }}</div>
@endif
