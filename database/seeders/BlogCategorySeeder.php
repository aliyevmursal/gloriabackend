<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use Illuminate\Database\Seeder;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name_en' => 'Fashion',
                'name_az' => 'Moda',
                'slug' => 'fashion',
                'is_active' => true,
            ],
            [
                'name_en' => 'Style',
                'name_az' => 'Stil',
                'slug' => 'style',
                'is_active' => true,
            ],
            [
                'name_en' => 'Inspiration',
                'name_az' => 'İlham',
                'slug' => 'inspiration',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $cat) {
            BlogCategory::create($cat);
        }
    }
}
