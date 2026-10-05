<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $t) {
            $t->id();
            $t->foreignId('category_id')->constrained()->restrictOnDelete();   // kategori tidak bisa dihapus jika masih punya produk
            $t->foreignId('user_id')->constrained()->cascadeOnDelete();        // penjual/admin pembuat produk
            $t->string('name', 150);
            $t->string('slug', 170)->unique();
            $t->text('description')->nullable();
            $t->decimal('price', 12, 2);                                       // uang = decimal, bukan float
            $t->unsignedInteger('stock')->default(0);
            $t->boolean('is_active')->default(true);
            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
