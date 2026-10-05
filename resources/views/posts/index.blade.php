<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftar Post</h2>
            @can('create', App\Models\Post::class)
                <a href="{{ route('posts.create') }}" class="px-3 py-1.5 bg-indigo-600 text-white rounded text-sm">+ Post Baru</a>
            @endcan
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <x-flash />

            <div class="bg-white shadow-sm sm:rounded-lg divide-y">
                @forelse ($posts as $post)
                    <div class="p-4 flex items-start justify-between gap-4">
                        <div>
                            <a href="{{ route('posts.show', $post) }}" class="font-semibold text-lg hover:text-indigo-600">{{ $post->title }}</a>
                            @unless ($post->published)
                                <span class="ml-2 text-xs px-2 py-0.5 bg-yellow-100 text-yellow-800 rounded">draft</span>
                            @endunless
                            <p class="text-sm text-gray-500">oleh {{ $post->user->name }} · {{ $post->created_at->diffForHumans() }}</p>
                        </div>

                        <div class="flex gap-2 shrink-0">
                            {{-- @can hanya untuk UX; server tetap menolak lewat $this->authorize() --}}
                            @can('update', $post)
                                <a href="{{ route('posts.edit', $post) }}" class="px-3 py-1 border rounded text-sm">Edit</a>
                            @endcan
                            @can('delete', $post)
                                <form method="POST" action="{{ route('posts.destroy', $post) }}"
                                      onsubmit="return confirm('Hapus post ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="px-3 py-1 border border-red-400 text-red-600 rounded text-sm">Hapus</button>
                                </form>
                            @endcan
                        </div>
                    </div>
                @empty
                    <p class="p-6 text-gray-500">Belum ada post.</p>
                @endforelse
            </div>

            <div class="mt-6">{{ $posts->links() }}</div>
        </div>
    </div>
</x-app-layout>
