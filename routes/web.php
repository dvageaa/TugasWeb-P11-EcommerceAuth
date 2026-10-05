<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Models\Order;
use App\Models\Post;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Katalog produk: publik (tanpa login)
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Semua route di grup ini WAJIB login
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Otorisasi edit/delete ditangani PostPolicy di dalam PostController
    Route::resource('posts', PostController::class);
});

// Khusus role admin (middleware custom 'role' = EnsureRole)
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard', [
                'totalUsers'    => User::count(),
                'totalProducts' => Product::count(),
                'totalPosts'    => Post::count(),
                'totalOrders'   => Order::count(),
                'latestOrders'  => Order::with('user')->withCount('items')->latest()->take(8)->get(),
            ]);
        })->name('dashboard');
    });

require __DIR__ . '/auth.php';
