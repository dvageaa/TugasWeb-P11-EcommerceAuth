<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun tetap untuk testing 3 role (password semuanya: "password")
        // 'role' diisi lewat factory (bypass $fillable) — aman karena hanya di seeder.
        User::factory()->create(['name' => 'Admin',  'email' => 'admin@example.com',  'role' => 'admin']);
        User::factory()->create(['name' => 'Editor', 'email' => 'editor@example.com', 'role' => 'editor']);
        User::factory()->create(['name' => 'User',   'email' => 'user@example.com',   'role' => 'user']);

        User::factory()->count(7)->create(); // role default: user

        // 20 post dengan pemilik acak dari user yang ada
        Post::factory()->count(20)->recycle(User::all())->create();

        $this->call(ShopSeeder::class);
    }
}
