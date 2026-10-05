<div class="mb-4">
    <x-input-label for="title" value="Judul" />
    <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                  :value="old('title', $post->title ?? '')" required />
    <x-input-error :messages="$errors->get('title')" class="mt-2" />
</div>

<div class="mb-4">
    <x-input-label for="body" value="Isi" />
    <textarea id="body" name="body" rows="6" required
              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('body', $post->body ?? '') }}</textarea>
    <x-input-error :messages="$errors->get('body')" class="mt-2" />
</div>

<label class="mb-4 inline-flex items-center gap-2">
    <input type="checkbox" name="published" value="1" class="rounded border-gray-300"
           @checked(old('published', $post->published ?? true))>
    <span>Terbitkan</span>
</label>

<div class="mt-4 flex items-center gap-3">
    <x-primary-button>{{ $button ?? 'Simpan' }}</x-primary-button>
    <a href="{{ route('posts.index') }}" class="text-gray-600 underline">Batal</a>
</div>
