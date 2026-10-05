<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Eager loading: 1 query produk + 1 kategori + 1 tags = 3 query (bukan 1 + N + N)
        $products = Product::with(['category', 'tags'])
            ->active()
            ->inStock()
            ->when($request->query('category'), function ($q, $slug) {
                $q->whereHas('category', fn ($c) => $c->where('slug', $slug));
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('products.index', compact('products', 'categories'));
    }
}
