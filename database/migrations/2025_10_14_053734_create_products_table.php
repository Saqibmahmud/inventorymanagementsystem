<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {//product_name','sku','brands_id','product_categories_id','description','price','sstock_quantity','reorder_level
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('sku')->unique();
            $table->foreignId('brands_id')->constrained('brands')->onDelete('cascade');
            $table->foreignId('product_categories_id')->constrained('product_categories')->onDelete('cascade');
            $table->text('description');
            $table->decimal('price',10,2)->nullable();
            $table->integer('stock_quantity');
            $table->integer('reorder_level')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
