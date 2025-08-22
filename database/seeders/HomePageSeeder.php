<?php

namespace Database\Seeders;

use App\Models\HomePage;
use Illuminate\Database\Seeder;

class HomePageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HomePage::create([
            'title_en' => 'Welcome to Our Fashion Store',
            'title_az' => 'Moda Mağazamıza Xoş Gəlmisiniz',
            'description_en' => "Discover the latest trends in fashion and style with our curated collection of high-quality clothing and accessories.\n\n## Why Choose Us?\n\n- **Premium Quality**: We source only the finest materials\n- **Latest Trends**: Stay ahead with our fashion-forward designs\n- **Worldwide Shipping**: Fast and reliable delivery to your doorstep\n- **Customer Satisfaction**: Your happiness is our priority\n\n> *Fashion is the armor to survive the reality of everyday life.* - Bill Cunningham",
            'description_az' => "Yüksək keyfiyyətli geyim və aksesuarların seçilmiş kolleksiyası ilə moda və stil sahəsində ən son tendensiyaları kəşf edin.\n\n## Niyə Bizi Seçməlisiniz?\n\n- **Premium Keyfiyyət**: Yalnız ən yaxşı materialları seçirik\n- **Ən Son Tendensiyalar**: Moda-öncü dizaynlarımızla irəlidə qalın\n- **Dünya Üzrə Çatdırılma**: Tez və etibarlı çatdırılma\n- **Müştəri Məmnuniyyəti**: Sizin xoşbəxtliyiniz bizim prioritetimizdir\n\n> *Moda gündəlik həyatın reallığında yaşamaq üçün zirehdir.* - Bill Cunningham",
            'meta_title_en' => 'Fashion Store - Premium Clothing & Accessories',
            'meta_title_az' => 'Moda Mağazası - Premium Geyim və Aksesuarlar',
            'meta_description_en' => 'Discover the latest fashion trends with our premium collection of clothing and accessories. Quality materials, innovative designs, and worldwide shipping.',
            'meta_description_az' => 'Geyim və aksesuarların premium kolleksiyası ilə ən son moda tendensiyalarını kəşf edin. Keyfiyyətli materiallar, innovativ dizaynlar və dünya üzrə çatdırılma.',
            'meta_keywords_en' => 'fashion store, clothing, accessories, premium quality, latest trends, worldwide shipping',
            'meta_keywords_az' => 'moda mağazası, geyim, aksesuarlar, premium keyfiyyət, ən son tendensiyalar, dünya üzrə çatdırılma',
            'og_title_en' => 'Fashion Store - Premium Clothing & Accessories',
            'og_title_az' => 'Moda Mağazası - Premium Geyim və Aksesuarlar',
            'og_description_en' => 'Discover the latest fashion trends with our premium collection of clothing and accessories.',
            'og_description_az' => 'Geyim və aksesuarların premium kolleksiyası ilə ən son moda tendensiyalarını kəşf edin.',
            'og_image' => null,
            'is_active' => true,
        ]);
    }
}