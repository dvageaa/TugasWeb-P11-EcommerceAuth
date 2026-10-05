<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ShopSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();

        // 6 kategori x 5 jenis produk x 2 merek = 60 produk realistis
        $catalog = [
            'Elektronik' => [
                ['Smartphone', 2500000], ['Laptop', 8500000], ['Headphone Bluetooth', 450000],
                ['Smartwatch', 900000], ['Power Bank 20000mAh', 250000],
            ],
            'Fashion Pria' => [
                ['Kemeja Flannel', 175000], ['Kaos Polos Cotton Combed', 85000], ['Celana Chino', 220000],
                ['Jaket Bomber', 310000], ['Sepatu Sneakers', 420000],
            ],
            'Fashion Wanita' => [
                ['Blouse Katun', 150000], ['Rok Plisket', 130000], ['Hijab Voal', 65000],
                ['Dress Casual', 260000], ['Tas Selempang', 240000],
            ],
            'Peralatan Dapur' => [
                ['Rice Cooker 1.8L', 380000], ['Set Panci Stainless', 450000], ['Blender Multifungsi', 320000],
                ['Wajan Anti Lengket', 180000], ['Pisau Chef', 120000],
            ],
            'Buku & Alat Tulis' => [
                ['Novel Fiksi', 85000], ['Buku Catatan A5', 35000], ['Pulpen Gel Set', 28000],
                ['Buku Panduan Laravel', 150000], ['Ransel Laptop', 275000],
            ],
            'Olahraga' => [
                ['Matras Yoga', 110000], ['Dumbbell 5kg', 165000], ['Sepatu Lari', 550000],
                ['Botol Minum 1L', 60000], ['Raket Badminton', 280000],
            ],
        ];
        $brands = ['Aurora', 'Nusantara', 'Zenith', 'Kartika'];

        $tags = collect(['Terlaris', 'Diskon', 'Baru', 'Garansi Resmi', 'Gratis Ongkir'])
            ->map(fn ($n) => Tag::firstOrCreate(['name' => $n]));

        $i = 0;
        foreach ($catalog as $catName => $items) {
            $category = Category::firstOrCreate(
                ['name' => $catName],
                ['slug' => Str::slug($catName)]
            );

            foreach ($items as $j => [$type, $base]) {
                foreach ([$brands[($i + $j) % 4], $brands[($i + $j + 1) % 4]] as $brand) {
                    $name = "{$brand} {$type}";

                    $product = Product::factory()->create([
                        'category_id' => $category->id,
                        'user_id'     => $admin->id,
                        'name'        => $name,
                        'slug'        => Str::slug($name),
                        'price'       => round($base * fake()->randomFloat(2, 0.9, 1.15) / 1000) * 1000,
                        'stock'       => fake()->numberBetween(0, 150),
                        'is_active'   => true,
                    ]);

                    // many-to-many: 1-3 tag acak
                    $product->tags()->attach($tags->random(fake()->numberBetween(1, 3))->pluck('id'));
                }
            }
            $i++;
        }

        // Order + item untuk tiap user (snapshot harga saat transaksi)
        $products = Product::all();
        User::all()->each(function (User $user) use ($products) {
            foreach (range(1, fake()->numberBetween(1, 3)) as $_) {
                $order = Order::create([
                    'user_id' => $user->id,
                    'status'  => Arr::random(['pending', 'paid', 'shipped', 'cancelled']),
                ]);

                foreach ($products->random(fake()->numberBetween(1, 4)) as $p) {
                    $order->items()->create([
                        'product_id' => $p->id,
                        'qty'        => fake()->numberBetween(1, 3),
                        'price'      => $p->price,
                    ]);
                }
            }
        });
    }
}
