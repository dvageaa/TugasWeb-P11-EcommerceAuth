<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">{{ $post->title }}</h2></x-slot>
    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <x-flash />
            <article class="bg-white shadow-sm sm:rounded-lg p-6">
                <p class="text-sm text-gray-500 mb-4">oleh {{ $post->user->name }} · {{ $post->created_at->format('d M Y H:i') }}</p>
                <div class="whitespace-pre-line">{{ $post->body }}</div>
            </article>
            <div class="mt-4 flex gap-2">
                <a href="{{ route('posts.index') }}" class="px-3 py-1 border rounded">← Kembali</a>
                @can('update', $post)
                    <a href="{{ route('posts.edit', $post) }}" class="px-3 py-1 border rounded">Edit</a>
                @endcan
            </div>
        </div>
    </div>
</x-app-layout>
