<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('product_name_az');
            $table->string('product_name_en');
            $table->text('product_description_az');
            $table->text('product_description_en');
            $table->string('product_cover');
            $table->decimal('product_price', 10, 2);
            $table->decimal('product_discounted_price', 10, 2)->nullable();
            $table->integer('quantity');
            $table->decimal('total_price', 10, 2);
            $table->json('product_categories')->nullable();
            $table->json('product_colors')->nullable();
            $table->json('product_sizes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};