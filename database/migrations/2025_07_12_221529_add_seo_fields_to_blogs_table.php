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
        Schema::table('blogs', function (Blueprint $table) {
            $table->string('meta_title_en')->nullable()->after('description_az');
            $table->string('meta_title_az')->nullable()->after('meta_title_en');
            $table->text('meta_description_en')->nullable()->after('meta_title_az');
            $table->text('meta_description_az')->nullable()->after('meta_description_en');
            $table->text('meta_keywords_en')->nullable()->after('meta_description_az');
            $table->text('meta_keywords_az')->nullable()->after('meta_keywords_en');
            $table->string('og_title_en')->nullable()->after('meta_keywords_az');
            $table->string('og_title_az')->nullable()->after('og_title_en');
            $table->text('og_description_en')->nullable()->after('og_title_az');
            $table->text('og_description_az')->nullable()->after('og_description_en');
            $table->string('og_image')->nullable()->after('og_description_az');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn([
                'meta_title_en',
                'meta_title_az',
                'meta_description_en',
                'meta_description_az',
                'meta_keywords_en',
                'meta_keywords_az',
                'og_title_en',
                'og_title_az',
                'og_description_en',
                'og_description_az',
                'og_image'
            ]);
        });
    }
};
