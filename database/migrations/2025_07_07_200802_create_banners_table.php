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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('cover');
            $table->boolean('is_active')->default(true);
            $table->string('title_az');
            $table->string('title_en');
            $table->string('title_ru');
            $table->string('slogan_az');
            $table->string('slogan_en');
            $table->string('slogan_ru');
            $table->string('helper_text_az')->nullable();
            $table->string('helper_text_en')->nullable();
            $table->string('helper_text_ru')->nullable();
            $table->string('link')->nullable();
            $table->integer('position')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
