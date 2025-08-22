<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banners = [
            [
                'cover' => 'banners/IMG_1655.JPG',
                'title_az' => 'GNL Couture x GEZALIK',
                'title_en' => 'GNL Couture x GEZALIK',
                'slogan_az' => '',
                'slogan_en' => '',
                'helper_text_az' => '',
                'helper_text_en' => '',
                'link' => '/products?category=gezalik',
                'is_active' => true,
                'position' => 0,
                'image_url' => 'https://gnlstorage.s3.eu-central-1.amazonaws.com/banners/IMG_1655.JPG',
            ],
            [
                'cover' => 'banners/IMG_5823_2.JPG',
                'title_az' => 'THE GLIMMER',
                'title_en' => 'THE GLIMMER',
                'slogan_az' => '',
                'slogan_en' => '',
                'helper_text_az' => '',
                'helper_text_en' => '',
                'link' => '/products?category=fw24',
                'is_active' => true,
                'position' => 1,
                'image_url' => 'https://gnlstorage.s3.eu-central-1.amazonaws.com/banners/IMG_5823_2.JPG',
            ],
            [
                'cover' => 'banners/IMG_3801.JPG',
                'title_az' => 'FALL - WINTER 2025',
                'title_en' => 'FALL - WINTER 2025',
                'slogan_az' => '',
                'slogan_en' => '',
                'helper_text_az' => '',
                'helper_text_en' => '',
                'link' => '/products?category=fw25',
                'is_active' => true,
                'position' => 2,
                'image_url' => 'https://gnlstorage.s3.eu-central-1.amazonaws.com/banners/IMG_3801.JPG',
            ],
            [
                'cover' => 'banners/IMG_4191.jpg',
                'title_az' => 'COCTAIL DRESSES 2025',
                'title_en' => 'COCTAIL DRESSES 2025',
                'slogan_az' => '',
                'slogan_en' => '',
                'helper_text_az' => '',
                'helper_text_en' => '',
                'link' => '/products?category=coctail25',
                'is_active' => true,
                'position' => 3,
                'image_url' => 'https://gnlstorage.s3.eu-central-1.amazonaws.com/banners/IMG_4191.jpg',
            ],
            [
                'cover' => 'banners/IMG_3123.JPG',
                'title_az' => 'HIJAB COLLECTION',
                'title_en' => 'HIJAB COLLECTION',
                'slogan_az' => '',
                'slogan_en' => '',
                'helper_text_az' => '',
                'helper_text_en' => '',
                'link' => '/products?category=hijab',
                'is_active' => true,
                'position' => 4,
                'image_url' => 'https://gnlstorage.s3.eu-central-1.amazonaws.com/banners/IMG_3123.JPG',
            ],
            [
                'cover' => 'banners/IMG_7920.JPG',
                'title_az' => 'FALL - WINTER 2023',
                'title_en' => 'FALL - WINTER 2023',
                'slogan_az' => '',
                'slogan_en' => '',
                'helper_text_az' => '',
                'helper_text_en' => '',
                'link' => '/products?category=fw23',
                'is_active' => true,
                'position' => 5,
                'image_url' => 'https://gnlstorage.s3.eu-central-1.amazonaws.com/banners/IMG_7920.JPG',
            ],
            [
                'cover' => 'banners/am301262.JPG',
                'title_az' => 'PRE FALL 2022',
                'title_en' => 'PRE FALL 2022',
                'slogan_az' => '',
                'slogan_en' => '',
                'helper_text_az' => '',
                'helper_text_en' => '',
                'link' => '/products?category=fw22',
                'is_active' => true,
                'position' => 6,
                'image_url' => 'https://gnlstorage.s3.eu-central-1.amazonaws.com/banners/am301262.JPG',
            ],
            [
                'cover' => 'banners/photo_52627773770528.jpg',
                'title_az' => 'CRUISE 2023',
                'title_en' => 'CRUISE 2023',
                'slogan_az' => '',
                'slogan_en' => '',
                'helper_text_az' => '',
                'helper_text_en' => '',
                'link' => '/products?category=cruise23',
                'is_active' => true,
                'position' => 7,
                'image_url' => 'https://gnlstorage.s3.eu-central-1.amazonaws.com/banners/photo_52627773770528.jpg',
            ],
            [
                'cover' => 'banners/IMG_6054.jpg',
                'title_az' => 'SHOP',
                'title_en' => 'SHOP',
                'slogan_az' => '',
                'slogan_en' => '',
                'helper_text_az' => '',
                'helper_text_en' => '',
                'link' => '/products?category=shop',
                'is_active' => true,
                'position' => 8,
                'image_url' => 'https://gnlstorage.s3.eu-central-1.amazonaws.com/banners/IMG_6054.jpg',
            ],
        ];

        foreach ($banners as $banner) {
            // Download and store the image if it doesn't exist
            $imagePath = $banner['cover'];
            if (!Storage::disk('public')->exists($imagePath)) {
                $imageContents = @file_get_contents($banner['image_url']);
                if ($imageContents !== false) {
                    Storage::disk('public')->put($imagePath, $imageContents);
                }
            }
            // Remove image_url before creating the Banner
            $bannerData = $banner;
            unset($bannerData['image_url']);
            \App\Models\Banner::create($bannerData);
        }
    }
}