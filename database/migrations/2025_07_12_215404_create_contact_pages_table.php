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
        Schema::create('contact_pages', function (Blueprint $table) {
            $table->id();
            $table->text('description_en')->nullable();
            $table->text('description_az')->nullable();
            $table->text('description_ru')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('meta_title_en')->nullable();
            $table->string('meta_title_az')->nullable();
            $table->string('meta_title_ru')->nullable();
            $table->text('meta_description_en')->nullable();
            $table->text('meta_description_az')->nullable();
            $table->text('meta_description_ru')->nullable();
            $table->text('meta_keywords_en')->nullable();
            $table->text('meta_keywords_az')->nullable();
            $table->text('meta_keywords_ru')->nullable();
            $table->string('og_title_en')->nullable();
            $table->string('og_title_az')->nullable();
            $table->string('og_title_ru')->nullable();
            $table->text('og_description_en')->nullable();
            $table->text('og_description_az')->nullable();
            $table->text('og_description_ru')->nullable();
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
        Schema::dropIfExists('contact_pages');
    }
};
