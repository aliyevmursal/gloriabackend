<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('product_pages', function (Blueprint $table) {
            $table->id();
            $table->string('title_en')->nullable();
            $table->string('title_az')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_az')->nullable();
            $table->string('meta_title_en')->nullable();
            $table->string('meta_title_az')->nullable();
            $table->text('meta_description_en')->nullable();
            $table->text('meta_description_az')->nullable();
            $table->text('meta_keywords_en')->nullable();
            $table->text('meta_keywords_az')->nullable();
            $table->string('og_title_en')->nullable();
            $table->string('og_title_az')->nullable();
            $table->text('og_description_en')->nullable();
            $table->text('og_description_az')->nullable();
            $table->string('og_image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('product_pages');
    }
};
