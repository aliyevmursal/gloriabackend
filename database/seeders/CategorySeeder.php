<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = [
            'gezalik',
            'fw25',
            'coctail25',
            'fw24',
            'fw23',
            'cruise23',
            'prefall23',
            'prefall22',
            'fw22',
            'shop22',
            'hijab',
        ];

        foreach ($categories as $i => $cat) {
            \App\Models\Category::create([
                'name_en' => strtoupper($cat),
                'name_az' => strtoupper($cat),
                'slug' => $cat,
                'is_active' => true,
                'position' => $i + 1
            ]);
        }
    }
}