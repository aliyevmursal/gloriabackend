<?php

namespace Database\Seeders;

use App\Models\ProductPage;
use Illuminate\Database\Seeder;

class ProductPageSeeder extends Seeder
{
    public function run(): void
    {
        ProductPage::create([
            'title_en' => 'Our Products',
            'title_az' => 'Məhsullarımız',
            'description_en' => 'You can find what you are looking for here.',
            'description_az' => 'Axtardığınızı burada tapa bilərsiniz.',
            'meta_title_en' => 'Fashion Products - Quality & Style',
            'meta_title_az' => 'Moda Məhsulları - Keyfiyyət və Stil',
            'meta_description_en' => 'Browse our collection of fashion products. Premium quality, latest trends, and affordable prices.',
            'meta_description_az' => 'Moda məhsullarımızı kəşf edin. Premium keyfiyyət, ən son tendensiyalar və əlverişli qiymətlər.',
            'meta_keywords_en' => 'fashion, products, quality, style, affordable',
            'meta_keywords_az' => 'moda, məhsullar, keyfiyyət, stil, əlverişli',
            'og_title_en' => 'Fashion Products - Quality & Style',
            'og_title_az' => 'Moda Məhsulları - Keyfiyyət və Stil',
            'og_description_en' => 'Browse our collection of fashion products. Premium quality, latest trends, and affordable prices.',
            'og_description_az' => 'Moda məhsullarımızı kəşf edin. Premium keyfiyyət, ən son tendensiyalar və əlverişli qiymətlər.',
            'og_image' => null,
            'is_active' => true,
        ]);
    }
}