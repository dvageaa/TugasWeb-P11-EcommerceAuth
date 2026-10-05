<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Edit Post</h2></x-slot>
    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 bg-white shadow-sm sm:rounded-lg p-6">
            <form method="POST" action="{{ route('posts.update', $post) }}">
                @csrf
                @method('PUT')
                @include('posts._form', ['post' => $post, 'button' => 'Perbarui'])
            </form>
        </div>
    </div>
</x-app-layout>
