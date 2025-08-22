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
        Schema::create('about_pages', function (Blueprint $table) {
            $table->id();
            $table->text('description_en')->nullable();
            $table->text('description_az')->nullable();
            $table->string('video_url')->nullable(); // Vimeo video URL
            $table->string('quality_title_en')->nullable();
            $table->string('quality_title_az')->nullable();
            $table->text('quality_description_en')->nullable();
            $table->text('quality_description_az')->nullable();
            $table->string('individual_approach_title_en')->nullable();
            $table->string('individual_approach_title_az')->nullable();
            $table->text('individual_approach_description_en')->nullable();
            $table->text('individual_approach_description_az')->nullable();
            $table->string('worldwide_shipping_title_en')->nullable();
            $table->string('worldwide_shipping_title_az')->nullable();
            $table->text('worldwide_shipping_description_en')->nullable();
            $table->text('worldwide_shipping_description_az')->nullable();
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

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_pages');
    }
};
