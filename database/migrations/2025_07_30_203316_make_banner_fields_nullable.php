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
        Schema::table('banners', function (Blueprint $table) {
            $table->string('cover')->nullable()->change();
            $table->string('title_az')->nullable()->change();
            $table->string('title_en')->nullable()->change();
            $table->string('title_ru')->nullable()->change();
            $table->string('slogan_az')->nullable()->change();
            $table->string('slogan_en')->nullable()->change();
            $table->string('slogan_ru')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->string('cover')->nullable(false)->change();
            $table->string('title_az')->nullable(false)->change();
            $table->string('title_en')->nullable(false)->change();
            $table->string('title_ru')->nullable(false)->change();
            $table->string('slogan_az')->nullable(false)->change();
            $table->string('slogan_en')->nullable(false)->change();
            $table->string('slogan_ru')->nullable(false)->change();
        });
    }
};
