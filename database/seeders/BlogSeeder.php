<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = BlogCategory::where('slug', 'fashion')->first();
        if (!$category)
            return;

        $blogs = [
            [
                'name_en' => 'Black Lace: Timeless Elegance',
                'name_az' => 'Black Lace: Zamansız Zəriflik',
                'description_en' => "## The elegance of lace\n\nThis dress, where the elegance of lace meets modern design, is the favorite of the season.\n\n- Timeless style\n- Modern silhouette\n- Perfect for special occasions\n",
                'description_az' => "## Dantelin zərifliyi\n\nDantelin zərifliyi ilə müasir dizaynın birləşdiyi bu don, mövsümün sevimlisidir.\n\n- Zamansız üslub\n- Müasir siluet\n- Xüsusi günlər üçün ideal\n",
                'cover' => 'products/coctail25_black-lace_0.JPG',
            ],
            [
                'name_en' => 'Cobalt Dress: Bold Colors',
                'name_az' => 'Cobalt Dress: Cəsur Rənglər',
                'description_en' => "### Cobalt blue is the trend\n\nCobalt blue, one of the most preferred colors of the season, offers an energetic and bold style.\n",
                'description_az' => "### Kobalt mavisi trenddir\n\nMövsümün ən çox seçilən rənglərindən biri olan kobalt mavisi, enerjili və cəsur bir stil təqdim edir.\n",
                'cover' => 'products/coctail25_cobalt-dress_0.JPG',
            ],
            [
                'name_en' => 'Black Lace: Details Matter',
                'name_az' => 'Black Lace: Detallarda Zəriflik',
                'description_en' => "**Every woman should have a black lace dress in her wardrobe.**\n\nClassic and modern style together.\n\n- Style tips\n- Care suggestions\n",
                'description_az' => "**Hər qadının qarderobunda qara dantel don olmalıdır.**\n\nKlassik və müasir üslub bir arada.\n\n- Stil məsləhətləri\n- Baxım tövsiyələri\n",
                'cover' => 'products/coctail25_black-lace_1.JPG',
            ],
        ];

        foreach ($blogs as $blog) {
            Blog::create([
                'blog_category_id' => $category->id,
                'name_en' => $blog['name_en'],
                'name_az' => $blog['name_az'],
                'description_en' => $blog['description_en'],
                'description_az' => $blog['description_az'],
                'cover' => $blog['cover'],
                'slug' => Str::slug($blog['name_en']),
                'is_active' => true,
            ]);
        }
    }
}
