<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Post $post): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    /** Edit: pemilik post, editor (semua post), atau admin. */
    public function update(User $user, Post $post): bool
    {
        return $user->id === $post->user_id
            || in_array($user->role, ['editor', 'admin'], true);
    }

    /** Hapus: pemilik post atau admin (editor TIDAK boleh menghapus post orang lain). */
    public function delete(User $user, Post $post): bool
    {
        return $user->id === $post->user_id || $user->role === 'admin';
    }
}
