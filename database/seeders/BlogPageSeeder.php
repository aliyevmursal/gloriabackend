<?php

namespace Database\Seeders;

use App\Models\BlogPage;
use Illuminate\Database\Seeder;

class BlogPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BlogPage::create([
            'title_en' => null,
            'title_az' => null,
            'description_en' => null,
            'description_az' => null,
            'meta_title_en' => null,
            'meta_title_az' => null,
            'meta_description_en' => null,
            'meta_description_az' => null,
            'meta_keywords_en' => null,
            'meta_keywords_az' => null,
            'og_title_en' => null,
            'og_title_az' => null,
            'og_description_en' => null,
            'og_description_az' => null,
            'og_image' => null,
            'is_active' => true,
        ]);
    }
}
