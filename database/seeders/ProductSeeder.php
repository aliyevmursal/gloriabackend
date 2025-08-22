<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use App\Models\Discount;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        $discounts = Discount::all();

        // GEZALIK kategorisi ürünleri (HTML'den ayıklananlar)
        $gezalikProducts = [
            [
                'name_en' => 'Opera Royale',
                'name_az' => 'Opera Royale',
                'description_en' => 'The black-and-white off-shoulder gown with draped elegance — reminiscent of old Hollywood grandeur.',
                'description_az' => 'Qara-ağ, çiyinləri açıq, drapeli zərif don — köhnə Hollivud dəbdəbəsini xatırladır.',
                'price' => 588,
                'images' => [
                    'https://static.tildacdn.one/tild3861-6533-4137-a336-616330333034/IMG_2015.JPG',
                    'https://static.tildacdn.one/tild6566-3962-4334-b361-656631636262/IMG_2014.JPG',
                ]
            ],
            [
                'name_en' => 'Velvet Versailles',
                'name_az' => 'Velvet Versailles',
                'description_en' => 'Pale pink velvet with corset boning and dramatic volume — pure French aristocratic energy.',
                'description_az' => 'Solğun çəhrayı məxmər, korset və dramatik həcm — saf fransız aristokrat enerjisi.',
                'price' => 700,
                'images' => [
                    'https://static.tildacdn.one/tild6130-6231-4139-b835-633635363064/IMG_1649.jpg',
                    'https://static.tildacdn.one/tild3536-3538-4633-a339-303432353532/IMG_2033.JPG',
                ]
            ],
            [
                'name_en' => 'Dark Bloom',
                'name_az' => 'Dark Bloom',
                'description_en' => 'A ruched sheer corset dress with gloves — sophisticated, seductive, and blooming with allure.',
                'description_az' => 'Qollu, şəffaf, büzgülü korset don — zərif, cazibədar və cəlbedici.',
                'price' => 580,
                'images' => [
                    'https://static.tildacdn.one/tild6462-3432-4861-b166-303733616237/IMG_1650.jpg',
                    'https://static.tildacdn.one/tild6166-3136-4433-b461-373234393263/IMG_1682.jpg',
                ]
            ],
            [
                'name_en' => 'Crystal Rose',
                'name_az' => 'Crystal Rose',
                'description_en' => 'A couture masterpiece with 3D florals and a sculpted bodice — modern bridal elegance at its peak.',
                'description_az' => '3D güllü və formalaşdırılmış bodisi olan kütür şah əsəri — müasir gəlin zərifliyinin zirvəsi.',
                'price' => 1200,
                'images' => [
                    'https://static.tildacdn.one/tild3766-6664-4965-a164-633233383634/IMG_1653.JPG',
                    'https://static.tildacdn.one/tild3235-6635-4364-a336-366633663338/IMG_2056.jpg',
                ]
            ],
            [
                'name_en' => 'La Perla Nera',
                'name_az' => 'La Perla Nera',
                'description_en' => 'A sultry sheer black lace gown with dramatic flair and mystery.',
                'description_az' => 'Cazibədar, şəffaf qara dantelli don — dramatik və sirli.',
                'price' => 588,
                'images' => [
                    'https://static.tildacdn.one/tild6262-3866-4635-a431-303139386163/IMG_1651.JPG',
                    'https://static.tildacdn.one/tild6139-3264-4137-a165-336164396132/IMG_2038.JPG',
                ]
            ],
            [
                'name_en' => 'Ivory Bloom',
                'name_az' => 'Ivory Bloom',
                'description_en' => 'A sheer lace dress adorned with oversized white flowers — soft, feminine, and ethereal.',
                'description_az' => 'Böyük ağ güllərlə bəzədilmiş şəffaf dantelli don — yumşaq, qadınsı və efir.',
                'price' => 880,
                'images' => [
                    'https://static.tildacdn.one/tild3264-6534-4262-b438-643634653431/IMG_1994.jpg',
                    'https://static.tildacdn.one/tild6266-3765-4137-a666-653336333738/IMG_1996.jpg',
                ]
            ],
            [
                'name_en' => 'Midnight Web',
                'name_az' => 'Midnight Web',
                'description_en' => 'A daring lace illusion dress with bold straps — perfect for the fearless femme fatale.',
                'description_az' => 'Cəsarətli bantlı dantel illüziya donu — qorxusuz femme fatale üçün.',
                'price' => 580,
                'images' => [
                    'https://static.tildacdn.one/tild3337-3036-4230-b663-323733316135/IMG_1681.jpg',
                    'https://static.tildacdn.one/tild3139-3533-4435-b366-356631643433/IMG_2022.jpg',
                ]
            ],
            [
                'name_en' => 'Lace Éclair',
                'name_az' => 'Lace Éclair',
                'description_en' => 'A playful, vintage-inspired white dress with layers of lace and tulle — sweet and bridal-chic.',
                'description_az' => 'Dantelli və tüllü, vintajdan ilhamlanan ağ don — şirin və gəlin-şık.',
                'price' => 2300,
                'images' => [
                    'https://static.tildacdn.one/tild3663-3661-4264-a365-636139626162/IMG_1687.JPG',
                    'https://static.tildacdn.one/tild3263-3537-4236-b166-633764643861/IMG_1980.JPG',
                ]
            ],
            [
                'name_en' => 'Château Belle',
                'name_az' => 'Château Belle',
                'description_en' => 'Black lace wrapped over a soft blush gown — sophisticated, romantic, and perfect for a couture soirée.',
                'description_az' => 'Qara dantel, yumşaq çəhrayı don üzərində — zərif, romantik və kütür gecəsi üçün ideal.',
                'price' => 580,
                'images' => [
                    'https://static.tildacdn.one/tild6436-6130-4139-b434-366336383139/IMG_2051.JPG',
                    'https://static.tildacdn.one/tild3633-6362-4532-a333-666538336334/IMG_2053.JPG',
                ]
            ],
        ];

        $gezalikCategory = Category::where('name_en', 'GEZALIK')->first();
        if ($gezalikCategory) {
            foreach ($gezalikProducts as $prod) {
                // Resimleri indir ve kaydet
                $gallery = [];
                foreach ($prod['images'] as $imgIndex => $imgUrl) {
                    $ext = pathinfo(parse_url($imgUrl, PHP_URL_PATH), PATHINFO_EXTENSION);
                    $fileName = 'products/gezalik_' . Str::slug($prod['name_en']) . '_' . $imgIndex . '.' . $ext;
                    if (!Storage::disk('public')->exists($fileName)) {
                        $imgData = @file_get_contents($imgUrl);
                        if ($imgData) {
                            Storage::disk('public')->put($fileName, $imgData);
                        }
                    }
                    $gallery[] = $fileName;
                }
                $cover = $gallery[0] ?? null;
                $product = Product::create([
                    'name_en' => $prod['name_en'],
                    'name_az' => $prod['name_az'],
                    'description_en' => $prod['description_en'],
                    'description_az' => $prod['description_az'],
                    'cover' => $cover,
                    'gallery' => $gallery,
                    'price' => $prod['price'],
                    'slug' => Str::slug($prod['name_en']),
                    'is_active' => true
                ]);
                $product->categories()->attach($gezalikCategory->id);
            }
        }
        // FW25 kategorisi ürünleri (HTML'den ayıklananlar)
        $fw25Products = [
            [
                'name_en' => 'LACE SPARKLE',
                'name_az' => 'LACE SPARKLE',
                'description_en' => $this->generateDescription('LACE SPARKLE'),
                'description_az' => $this->generateDescription('LACE SPARKLE'),
                'price' => 550,
                'images' => [
                    'https://static.tildacdn.one/tild3033-6232-4732-a631-666630643636/IMG_3744.JPG',
                    'https://static.tildacdn.one/tild3662-3865-4130-b565-313432643330/IMG_3752.JPG',
                ]
            ],
            [
                'name_en' => 'RED ELEGANCE',
                'name_az' => 'RED ELEGANCE',
                'description_en' => $this->generateDescription('RED ELEGANCE'),
                'description_az' => $this->generateDescription('RED ELEGANCE'),
                'price' => 1800,
                'images' => [
                    'https://static.tildacdn.one/tild3836-3361-4838-a339-383231363432/IMG_3801.JPG',
                    'https://static.tildacdn.one/tild3431-3564-4335-a465-353132373665/IMG_3800.JPG',
                ]
            ],
            [
                'name_en' => 'SPARK',
                'name_az' => 'SPARK',
                'description_en' => $this->generateDescription('SPARK'),
                'description_az' => $this->generateDescription('SPARK'),
                'price' => 1200,
                'images' => [
                    'https://static.tildacdn.one/tild3363-6634-4036-b733-313761643430/IMG_3805.JPG',
                    'https://static.tildacdn.one/tild3166-6332-4565-b133-316462356536/IMG_3803.JPG',
                ]
            ],
            [
                'name_en' => 'RED BEADED',
                'name_az' => 'RED BEADED',
                'description_en' => $this->generateDescription('RED BEADED'),
                'description_az' => $this->generateDescription('RED BEADED'),
                'price' => 1650,
                'images' => [
                    'https://static.tildacdn.one/tild3761-3962-4962-b934-306638353465/IMG_3806.JPG',
                ]
            ],
            [
                'name_en' => 'FLORAL BRIDE',
                'name_az' => 'FLORAL BRIDE',
                'description_en' => $this->generateDescription('FLORAL BRIDE'),
                'description_az' => $this->generateDescription('FLORAL BRIDE'),
                'price' => 985,
                'images' => [
                    'https://static.tildacdn.one/tild6632-3237-4261-a430-343531386237/IMG_3745.JPG',
                    'https://static.tildacdn.one/tild6638-3930-4035-b138-623632353734/IMG_3746.JPG',
                ]
            ],
            [
                'name_en' => 'BEIGE SEQUIN',
                'name_az' => 'BEIGE SEQUIN',
                'description_en' => $this->generateDescription('BEIGE SEQUIN'),
                'description_az' => $this->generateDescription('BEIGE SEQUIN'),
                'price' => 880,
                'images' => [
                    'https://static.tildacdn.one/tild6335-3839-4338-a232-623734623730/IMG_4470.jpg',
                    'https://static.tildacdn.one/tild3239-6232-4262-b831-663666633563/9c2956a2-3cba-4cc1-a.JPG',
                ]
            ],
            [
                'name_en' => 'MINT SWAROVSKI',
                'name_az' => 'MINT SWAROVSKI',
                'description_en' => $this->generateDescription('MINT SWAROVSKI'),
                'description_az' => $this->generateDescription('MINT SWAROVSKI'),
                'price' => 880,
                'images' => [
                    'https://static.tildacdn.one/tild6135-6335-4966-a561-643332626537/IMG_4464.jpg',
                    'https://static.tildacdn.one/tild3532-6239-4135-a663-393362303830/IMG_4465.jpg',
                ]
            ],
            [
                'name_en' => 'FLORAL TULLE GOWN',
                'name_az' => 'FLORAL TULLE GOWN',
                'description_en' => $this->generateDescription('FLORAL TULLE GOWN'),
                'description_az' => $this->generateDescription('FLORAL TULLE GOWN'),
                'price' => 1650,
                'images' => [
                    'https://static.tildacdn.one/tild3937-6238-4138-a463-303638383334/IMG_4482.jpg',
                    'https://static.tildacdn.one/tild6439-3132-4537-b132-356664303837/IMG_4484.jpg',
                ]
            ],
            [
                'name_en' => 'SWAROVSKI BEIGE',
                'name_az' => 'SWAROVSKI BEIGE',
                'description_en' => $this->generateDescription('SWAROVSKI BEIGE'),
                'description_az' => $this->generateDescription('SWAROVSKI BEIGE'),
                'price' => 1300,
                'images' => [
                    'https://static.tildacdn.one/tild3966-3262-4334-b833-333966656666/IMG_4468.jpg',
                    'https://static.tildacdn.one/tild3130-3962-4836-b730-383138646464/IMG_4469.jpg',
                ]
            ],
            [
                'name_en' => 'LIGHT BLUE',
                'name_az' => 'LIGHT BLUE',
                'description_en' => $this->generateDescription('LIGHT BLUE'),
                'description_az' => $this->generateDescription('LIGHT BLUE'),
                'price' => 1180,
                'images' => [
                    'https://static.tildacdn.one/tild6231-3864-4833-a132-323639343666/IMG_4474.jpg',
                    'https://static.tildacdn.one/tild3165-3439-4165-b563-663136383638/46100c71-f0a2-419b-9.JPG',
                ]
            ],
            [
                'name_en' => 'MINI FEATHER BRIDAL',
                'name_az' => 'MINI FEATHER BRIDAL',
                'description_en' => $this->generateDescription('MINI FEATHER BRIDAL'),
                'description_az' => $this->generateDescription('MINI FEATHER BRIDAL'),
                'price' => 880,
                'images' => [
                    'https://static.tildacdn.one/tild6166-3239-4964-b466-636463353465/IMG_6048.JPG',
                    'https://static.tildacdn.one/tild3137-6261-4530-a661-333437353135/IMG_6042.JPG',
                ]
            ],
            [
                'name_en' => 'IVORY WHITE',
                'name_az' => 'IVORY WHITE',
                'description_en' => $this->generateDescription('IVORY WHITE'),
                'description_az' => $this->generateDescription('IVORY WHITE'),
                'price' => 580,
                'images' => [
                    'https://static.tildacdn.one/tild6339-3935-4138-a365-373334383565/IMG_6052.JPG',
                    'https://static.tildacdn.one/tild3833-3638-4930-b736-303936396438/IMG_6043.JPG',
                ]
            ],
            [
                'name_en' => 'FLORAL MINI GOWN WITH TRAIN',
                'name_az' => 'FLORAL MINI GOWN WITH TRAIN',
                'description_en' => $this->generateDescription('FLORAL MINI GOWN WITH TRAIN'),
                'description_az' => $this->generateDescription('FLORAL MINI GOWN WITH TRAIN'),
                'price' => 900,
                'images' => [
                    'https://static.tildacdn.one/tild6436-3163-4036-a261-386232353337/IMG_6054_2.JPG',
                    'https://static.tildacdn.one/tild3931-3539-4765-b038-663562656665/IMG_6049.JPG',
                ]
            ],
            [
                'name_en' => 'HAND-BEADED PEARL GOWN',
                'name_az' => 'HAND-BEADED PEARL GOWN',
                'description_en' => $this->generateDescription('HAND-BEADED PEARL GOWN'),
                'description_az' => $this->generateDescription('HAND-BEADED PEARL GOWN'),
                'price' => 1180,
                'images' => [
                    'https://static.tildacdn.one/tild6635-3666-4064-a335-383265366464/IMG_6055.JPG',
                    'https://static.tildacdn.one/tild3362-6130-4561-b237-333461336533/IMG_6053.JPG',
                ]
            ],
            [
                'name_en' => 'BEADED LACE',
                'name_az' => 'BEADED LACE',
                'description_en' => $this->generateDescription('BEADED LACE'),
                'description_az' => $this->generateDescription('BEADED LACE'),
                'price' => 2000,
                'images' => [
                    'https://static.tildacdn.one/tild6566-3538-4530-b231-656466643138/IMG_6046.JPG',
                    'https://static.tildacdn.one/tild6638-3934-4265-a465-613535316632/IMG_6050.JPG',
                ]
            ],
        ];

        $fw25Category = Category::where('name_en', 'FW25')->first();
        if ($fw25Category) {
            foreach ($fw25Products as $prod) {
                // Resimleri indir ve kaydet
                $gallery = [];
                foreach ($prod['images'] as $imgIndex => $imgUrl) {
                    $ext = pathinfo(parse_url($imgUrl, PHP_URL_PATH), PATHINFO_EXTENSION);
                    $fileName = 'products/fw25_' . Str::slug($prod['name_en']) . '_' . $imgIndex . '.' . $ext;
                    if (!Storage::disk('public')->exists($fileName)) {
                        $imgData = @file_get_contents($imgUrl);
                        if ($imgData) {
                            Storage::disk('public')->put($fileName, $imgData);
                        }
                    }
                    $gallery[] = $fileName;
                }
                $cover = $gallery[0] ?? null;
                $product = Product::create([
                    'name_en' => $prod['name_en'],
                    'name_az' => $prod['name_az'],
                    'description_en' => $prod['description_en'],
                    'description_az' => $prod['description_az'],
                    'cover' => $cover,
                    'gallery' => $gallery,
                    'price' => $prod['price'],
                    'slug' => Str::slug($prod['name_en']),
                    'is_active' => true
                ]);
                $product->categories()->attach($fw25Category->id);
            }
        }
        // COCTAIL25 kategorisi ürünleri (HTML'den ayıklananlar)
        $coctail25Products = [
            [
                'name_en' => 'SATIN ROSE',
                'name_az' => 'SATIN ROSE',
                'description_en' => $this->generateDescription('SATIN ROSE'),
                'description_az' => $this->generateDescription('SATIN ROSE'),
                'price' => 495,
                'images' => [
                    'https://static.tildacdn.one/tild3539-6264-4831-b664-353265323734/IMG_4223.JPG',
                    'https://static.tildacdn.one/tild6431-6236-4263-a265-383166306638/IMG_4224.JPG',
                ]
            ],
            [
                'name_en' => 'SULTRY RED',
                'name_az' => 'SULTRY RED',
                'description_en' => $this->generateDescription('SULTRY RED'),
                'description_az' => $this->generateDescription('SULTRY RED'),
                'price' => 390,
                'images' => [
                    'https://static.tildacdn.one/tild3362-3239-4133-b339-343466626531/IMG_4191.jpg',
                    'https://static.tildacdn.one/tild6564-3761-4664-b630-613165313261/IMG_4193.JPG',
                ]
            ],
            [
                'name_en' => 'BLACK LACE',
                'name_az' => 'BLACK LACE',
                'description_en' => $this->generateDescription('BLACK LACE'),
                'description_az' => $this->generateDescription('BLACK LACE'),
                'price' => 485,
                'images' => [
                    'https://static.tildacdn.one/tild3932-6464-4131-b065-656139353061/IMG_4216.JPG',
                    'https://static.tildacdn.one/tild3238-6638-4937-a131-636265633933/IMG_4214.JPG',
                ]
            ],
            [
                'name_en' => 'COBALT DRESS',
                'name_az' => 'COBALT DRESS',
                'description_en' => $this->generateDescription('COBALT DRESS'),
                'description_az' => $this->generateDescription('COBALT DRESS'),
                'price' => 450,
                'images' => [
                    'https://static.tildacdn.one/tild3232-3931-4335-b863-623933343330/IMG_4217.JPG',
                    'https://static.tildacdn.one/tild3362-3039-4539-b438-333564623134/IMG_4218.JPG',
                ]
            ],
            [
                'name_en' => 'ELEGANCY',
                'name_az' => 'ELEGANCY',
                'description_en' => $this->generateDescription('ELEGANCY'),
                'description_az' => $this->generateDescription('ELEGANCY'),
                'price' => 455,
                'images' => [
                    'https://static.tildacdn.one/tild6464-3430-4233-b163-333835376161/IMG_4220.JPG',
                    'https://static.tildacdn.one/tild3134-3834-4566-a337-306462663632/IMG_4222.JPG',
                ]
            ],
        ];

        $coctail25Category = Category::where('name_en', 'COCTAIL25')->first();
        if ($coctail25Category) {
            foreach ($coctail25Products as $prod) {
                // Resimleri indir ve kaydet
                $gallery = [];
                foreach ($prod['images'] as $imgIndex => $imgUrl) {
                    $ext = pathinfo(parse_url($imgUrl, PHP_URL_PATH), PATHINFO_EXTENSION);
                    $fileName = 'products/coctail25_' . Str::slug($prod['name_en']) . '_' . $imgIndex . '.' . $ext;
                    if (!Storage::disk('public')->exists($fileName)) {
                        $imgData = @file_get_contents($imgUrl);
                        if ($imgData) {
                            Storage::disk('public')->put($fileName, $imgData);
                        }
                    }
                    $gallery[] = $fileName;
                }
                $cover = $gallery[0] ?? null;
                $product = Product::create([
                    'name_en' => $prod['name_en'],
                    'name_az' => $prod['name_az'],
                    'description_en' => $prod['description_en'],
                    'description_az' => $prod['description_az'],
                    'cover' => $cover,
                    'gallery' => $gallery,
                    'price' => $prod['price'],
                    'slug' => Str::slug($prod['name_en']),
                    'is_active' => true
                ]);
                $product->categories()->attach($coctail25Category->id);
            }
        }
        // FW24 kategorisi ürünleri (HTML'den ayıklananlar)
        $fw24Products = [
            [
                'name_en' => 'Sea Empress',
                'name_az' => 'Sea Empress',
                'description_en' => $this->generateDescription('Sea Empress'),
                'description_az' => $this->generateDescription('Sea Empress'),
                'price' => 2235,
                'images' => [
                    'https://static.tildacdn.one/tild3161-3834-4736-b037-303663346635/IMG_5791_2.jpg',
                    'https://static.tildacdn.one/tild3531-3136-4830-b836-326661316530/IMG_5788_2.JPG',
                ]
            ],
            [
                'name_en' => 'Liquid Lines',
                'name_az' => 'Liquid Lines',
                'description_en' => $this->generateDescription('Liquid Lines'),
                'description_az' => $this->generateDescription('Liquid Lines'),
                'price' => 1650,
                'images' => [
                    'https://static.tildacdn.one/tild3062-3937-4863-b962-333961646430/ggg.jpg',
                    'https://static.tildacdn.one/tild3337-3735-4539-b430-633239353431/IMG_5780_3.JPG',
                ]
            ],
            [
                'name_en' => 'Blooming Grace',
                'name_az' => 'Blooming Grace',
                'description_en' => $this->generateDescription('Blooming Grace'),
                'description_az' => $this->generateDescription('Blooming Grace'),
                'price' => 1100,
                'images' => [
                    'https://static.tildacdn.one/tild6134-3734-4334-a262-626466336366/IMG_5809_2.jpg',
                    'https://static.tildacdn.one/tild6139-3338-4339-b739-373930373430/IMG_5812_2.jpg',
                ]
            ],
            [
                'name_en' => 'Pink Mermaid',
                'name_az' => 'Pink Mermaid',
                'description_en' => $this->generateDescription('Pink Mermaid'),
                'description_az' => $this->generateDescription('Pink Mermaid'),
                'price' => 1100,
                'images' => [
                    'https://static.tildacdn.one/tild3536-6537-4534-a563-396638383936/IMG_5777_3.JPG',
                    'https://static.tildacdn.one/tild6634-3335-4830-b662-373933646436/IMG_5778_3.JPG',
                ]
            ],
            [
                'name_en' => 'Petal Whisper',
                'name_az' => 'Petal Whisper',
                'description_en' => $this->generateDescription('Petal Whisper'),
                'description_az' => $this->generateDescription('Petal Whisper'),
                'price' => 2800,
                'images' => [
                    'https://static.tildacdn.one/tild3931-3433-4330-b832-346166376464/IMG_5814_2.jpg',
                    'https://static.tildacdn.one/tild3635-6232-4365-b463-636262666237/IMG_5831_2.jpg',
                ]
            ],
            [
                'name_en' => 'Ivory Reverie',
                'name_az' => 'Ivory Reverie',
                'description_en' => $this->generateDescription('Ivory Reverie'),
                'description_az' => $this->generateDescription('Ivory Reverie'),
                'price' => 4700,
                'images' => [
                    'https://static.tildacdn.one/tild3238-6161-4333-a165-386531646264/IMG_5816_2.jpg',
                    'https://static.tildacdn.one/tild3661-6333-4132-b962-633664613339/IMG_5828_2.jpg',
                ]
            ],
        ];

        $fw24Category = Category::where('name_en', 'FW24')->first();
        if ($fw24Category) {
            foreach ($fw24Products as $prod) {
                // Resimleri indir ve kaydet
                $gallery = [];
                foreach ($prod['images'] as $imgIndex => $imgUrl) {
                    $ext = pathinfo(parse_url($imgUrl, PHP_URL_PATH), PATHINFO_EXTENSION);
                    $fileName = 'products/fw24_' . Str::slug($prod['name_en']) . '_' . $imgIndex . '.' . $ext;
                    if (!Storage::disk('public')->exists($fileName)) {
                        $imgData = @file_get_contents($imgUrl);
                        if ($imgData) {
                            Storage::disk('public')->put($fileName, $imgData);
                        }
                    }
                    $gallery[] = $fileName;
                }
                $cover = $gallery[0] ?? null;
                $product = Product::create([
                    'name_en' => $prod['name_en'],
                    'name_az' => $prod['name_az'],
                    'description_en' => $prod['description_en'],
                    'description_az' => $prod['description_az'],
                    'cover' => $cover,
                    'gallery' => $gallery,
                    'price' => $prod['price'],
                    'slug' => Str::slug($prod['name_en']),
                    'is_active' => true
                ]);
                $product->categories()->attach($fw24Category->id);
            }
        }
        // FW23 kategorisi ürünleri (HTML'den ayıklananlar)
        $fw23Products = [
            [
                'name_en' => 'Bridal gown decorated with embroidery',
                'name_az' => 'Bridal gown decorated with embroidery',
                'description_en' => $this->generateDescription('Bridal gown decorated with embroidery'),
                'description_az' => $this->generateDescription('Bridal gown decorated with embroidery'),
                'price' => 2950,
                'images' => [
                    'https://static.tildacdn.one/tild3637-3635-4866-a539-376336636431/IMG_7924.JPG',
                    'https://static.tildacdn.one/tild3664-3366-4264-b361-396664303732/IMG_7925.JPG',
                ]
            ],
            [
                'name_en' => 'Elegant beige gown',
                'name_az' => 'Elegant beige gown',
                'description_en' => $this->generateDescription('Elegant beige gown'),
                'description_az' => $this->generateDescription('Elegant beige gown'),
                'price' => 880,
                'images' => [
                    'https://static.tildacdn.one/tild6261-3939-4136-a330-356336666562/IMG_7951.JPG',
                    'https://static.tildacdn.one/tild6132-3766-4565-b032-353139313034/IMG_7952.JPG',
                ]
            ],
            [
                'name_en' => 'Beige gown decorated with embroidery',
                'name_az' => 'Beige gown decorated with embroidery',
                'description_en' => $this->generateDescription('Beige gown decorated with embroidery'),
                'description_az' => $this->generateDescription('Beige gown decorated with embroidery'),
                'price' => 1770,
                'images' => [
                    'https://static.tildacdn.one/tild3236-3064-4331-b164-613037636337/IMG_7948.JPG',
                    'https://static.tildacdn.one/tild3130-6132-4635-b034-616134313333/IMG_7950.JPG',
                ]
            ],
            [
                'name_en' => 'Beige maxi gown',
                'name_az' => 'Beige maxi gown',
                'description_en' => $this->generateDescription('Beige maxi gown'),
                'description_az' => $this->generateDescription('Beige maxi gown'),
                'price' => 1060,
                'images' => [
                    'https://static.tildacdn.one/tild6634-3433-4064-b336-383231653337/IMG_7938.JPG',
                    'https://static.tildacdn.one/tild3130-6639-4464-a362-323732323063/IMG_7937.JPG',
                ]
            ],
            [
                'name_en' => 'Tulle gown with large rhinestones',
                'name_az' => 'Tulle gown with large rhinestones',
                'description_en' => $this->generateDescription('Tulle gown with large rhinestones'),
                'description_az' => $this->generateDescription('Tulle gown with large rhinestones'),
                'price' => 880,
                'images' => [
                    'https://static.tildacdn.one/tild6635-6263-4038-b336-373863373136/IMG_7920.JPG',
                    'https://static.tildacdn.one/tild6134-3433-4136-b335-343733613463/IMG_7916.JPG',
                ]
            ],
            [
                'name_en' => 'Maxi gown with beads',
                'name_az' => 'Maxi gown with beads',
                'description_en' => $this->generateDescription('Maxi gown with beads'),
                'description_az' => $this->generateDescription('Maxi gown with beads'),
                'price' => 700,
                'images' => [
                    'https://static.tildacdn.one/tild3138-3665-4063-b564-373161376639/IMG_7947.JPG',
                    'https://static.tildacdn.one/tild3530-3634-4432-a261-636136386262/IMG_7945.JPG',
                ]
            ],
            [
                'name_en' => 'Corset gown, hand-embroidered with large rhinestones',
                'name_az' => 'Corset gown, hand-embroidered with large rhinestones',
                'description_en' => $this->generateDescription('Corset gown, hand-embroidered with large rhinestones'),
                'description_az' => $this->generateDescription('Corset gown, hand-embroidered with large rhinestones'),
                'price' => 880,
                'images' => [
                    'https://static.tildacdn.one/tild3266-3264-4261-a639-616464303330/IMG_7913.JPG',
                    'https://static.tildacdn.one/tild3466-3431-4762-a466-343239363339/IMG_7914.JPG',
                ]
            ],
            [
                'name_en' => 'Glamorous gown with rhinestones',
                'name_az' => 'Glamorous gown with rhinestones',
                'description_en' => $this->generateDescription('Glamorous gown with rhinestones'),
                'description_az' => $this->generateDescription('Glamorous gown with rhinestones'),
                'price' => 1180,
                'images' => [
                    'https://static.tildacdn.one/tild3631-6131-4530-b861-333465663638/IMG_7928.JPG',
                    'https://static.tildacdn.one/tild3361-6463-4165-a337-373131306532/IMG_7927.JPG',
                ]
            ],
            [
                'name_en' => 'Gown with upper arm crystal sleeves',
                'name_az' => 'Gown with upper arm crystal sleeves',
                'description_en' => $this->generateDescription('Gown with upper arm crystal sleeves'),
                'description_az' => $this->generateDescription('Gown with upper arm crystal sleeves'),
                'price' => 1060,
                'images' => [
                    'https://static.tildacdn.one/tild6136-3037-4661-b832-313630363530/IMG_7934.JPG',
                    'https://static.tildacdn.one/tild3537-3639-4035-b965-366230663366/IMG_7933.JPG',
                ]
            ],
        ];
        $fw23Category = Category::where('name_en', 'FW23')->first();
        if ($fw23Category) {
            foreach ($fw23Products as $prod) {
                $gallery = [];
                foreach ($prod['images'] as $imgIndex => $imgUrl) {
                    $ext = pathinfo(parse_url($imgUrl, PHP_URL_PATH), PATHINFO_EXTENSION);
                    $fileName = 'products/fw23_' . Str::slug($prod['name_en']) . '_' . $imgIndex . '.' . $ext;
                    if (!Storage::disk('public')->exists($fileName)) {
                        $imgData = @file_get_contents($imgUrl);
                        if ($imgData) {
                            Storage::disk('public')->put($fileName, $imgData);
                        }
                    }
                    $gallery[] = $fileName;
                }
                $cover = $gallery[0] ?? null;
                $product = Product::create([
                    'name_en' => $prod['name_en'],
                    'name_az' => $prod['name_az'],
                    'description_en' => $prod['description_en'],
                    'description_az' => $prod['description_az'],
                    'cover' => $cover,
                    'gallery' => $gallery,
                    'price' => $prod['price'],
                    'slug' => Str::slug($prod['name_en']),
                    'is_active' => true
                ]);
                $product->categories()->attach($fw23Category->id);
            }
        }
        // Cruise23 kategorisi ürünleri (HTML'den ayıklananlar)
        $cruise23Products = [
            [
                'name_en' => 'Mint gown embellished with stones',
                'name_az' => 'Mint gown embellished with stones',
                'description_en' => $this->generateDescription('Mint gown embellished with stones'),
                'description_az' => $this->generateDescription('Mint gown embellished with stones'),
                'price' => 880,
                'images' => [
                    'https://static.tildacdn.one/tild3532-3436-4630-a165-396662626339/photo_52627773770528.jpg',
                ]
            ],
            [
                'name_en' => 'Mint hand-beaded gown with feathers',
                'name_az' => 'Mint hand-beaded gown with feathers',
                'description_en' => $this->generateDescription('Mint hand-beaded gown with feathers'),
                'description_az' => $this->generateDescription('Mint hand-beaded gown with feathers'),
                'price' => 1470,
                'images' => [
                    'https://static.tildacdn.one/tild3164-6135-4439-a263-623637333861/photo_52627773770528.jpg',
                    'https://static.tildacdn.one/tild6136-3233-4538-b332-653934316462/photo_52627773770528.jpg',
                ]
            ],
            [
                'name_en' => 'Blue hand-beaded maxi gown with beaded leaves',
                'name_az' => 'Blue hand-beaded maxi gown with beaded leaves',
                'description_en' => $this->generateDescription('Blue hand-beaded maxi gown with beaded leaves'),
                'description_az' => $this->generateDescription('Blue hand-beaded maxi gown with beaded leaves'),
                'price' => 880,
                'images' => [
                    'https://static.tildacdn.one/tild3032-6239-4833-b135-343336646364/photo_52627773770528.jpg',
                    'https://static.tildacdn.one/tild3837-6266-4666-a431-383764626131/photo_52627773770528.jpg',
                ]
            ],
            [
                'name_en' => 'Hand-beaded crystal maxi gown',
                'name_az' => 'Hand-beaded crystal maxi gown',
                'description_en' => $this->generateDescription('Hand-beaded crystal maxi gown'),
                'description_az' => $this->generateDescription('Hand-beaded crystal maxi gown'),
                'price' => 520,
                'images' => [
                    'https://static.tildacdn.one/tild3965-3636-4366-b962-643338356630/photo_52627773770528.jpg',
                    'https://static.tildacdn.one/tild3933-3839-4266-b534-346332663664/photo_52627773770528.jpg',
                ]
            ],
            [
                'name_en' => 'Beige mini corset gown with crystals',
                'name_az' => 'Beige mini corset gown with crystals',
                'description_en' => $this->generateDescription('Beige mini corset gown with crystals'),
                'description_az' => $this->generateDescription('Beige mini corset gown with crystals'),
                'price' => 705,
                'images' => [
                    'https://static.tildacdn.one/tild3231-3231-4366-b038-333330313564/photo_52627773770528.jpg',
                ]
            ],
            [
                'name_en' => 'Gold organza maxi gown',
                'name_az' => 'Gold organza maxi gown',
                'description_en' => $this->generateDescription('Gold organza maxi gown'),
                'description_az' => $this->generateDescription('Gold organza maxi gown'),
                'price' => 530,
                'images' => [
                    'https://static.tildacdn.one/tild3463-3462-4236-b830-636434393937/photo_52627773770528.jpg',
                    'https://static.tildacdn.one/tild6438-3134-4663-b232-326632376331/photo_52627773770528.jpg',
                ]
            ],
            [
                'name_en' => 'Rose gold crystal gown with feathers',
                'name_az' => 'Rose gold crystal gown with feathers',
                'description_en' => $this->generateDescription('Rose gold crystal gown with feathers'),
                'description_az' => $this->generateDescription('Rose gold crystal gown with feathers'),
                'price' => 765,
                'images' => [
                    'https://static.tildacdn.one/tild3065-6665-4135-a235-373535383332/photo_52627773770528.jpg',
                ]
            ],
            [
                'name_en' => 'Powder pink beaded gown',
                'name_az' => 'Powder pink beaded gown',
                'description_en' => $this->generateDescription('Powder pink beaded gown'),
                'description_az' => $this->generateDescription('Powder pink beaded gown'),
                'price' => 705,
                'images' => [
                    'https://static.tildacdn.one/tild6562-3865-4961-b731-323562336236/photo_52627773770528.jpg',
                ]
            ],
            [
                'name_en' => 'Powder pink beaded corset gown',
                'name_az' => 'Powder pink beaded corset gown',
                'description_en' => $this->generateDescription('Powder pink beaded corset gown'),
                'description_az' => $this->generateDescription('Powder pink beaded corset gown'),
                'price' => 1150,
                'images' => [
                    'https://static.tildacdn.one/tild6466-3635-4432-a263-653364323039/photo_52627773770528.jpg',
                    'https://static.tildacdn.one/tild6138-3333-4432-b663-393934353862/photo_52627773770528.jpg',
                ]
            ],
            [
                'name_en' => 'Mini corset gown with crystals',
                'name_az' => 'Mini corset gown with crystals',
                'description_en' => $this->generateDescription('Mini corset gown with crystals'),
                'description_az' => $this->generateDescription('Mini corset gown with crystals'),
                'price' => 440,
                'images' => [
                    'https://static.tildacdn.one/tild3237-6661-4530-b964-343862353535/photo_52627773770528.jpg',
                    'https://static.tildacdn.one/tild6161-3934-4834-a335-656433303033/photo_52627773770528.jpg',
                ]
            ],
            [
                'name_en' => 'Mint mini  gown',
                'name_az' => 'Mint mini  gown',
                'description_en' => $this->generateDescription('Mint mini  gown'),
                'description_az' => $this->generateDescription('Mint mini  gown'),
                'price' => 520,
                'images' => [
                    'https://static.tildacdn.one/tild6230-6236-4338-a431-363661323030/photo_52627773770528.jpg',
                ]
            ],
            [
                'name_en' => 'Mini corset gown',
                'name_az' => 'Mini corset gown',
                'description_en' => $this->generateDescription('Mini corset gown'),
                'description_az' => $this->generateDescription('Mini corset gown'),
                'price' => 500,
                'images' => [
                    'https://static.tildacdn.one/tild3164-3162-4664-a536-323433333466/photo_52627773770528.jpg',
                    'https://static.tildacdn.one/tild3231-3361-4235-b535-376461333438/photo_52627773770528.jpg',
                ]
            ],
        ];
        $cruise23Category = Category::where('name_en', 'CRUISE23')->first();
        if ($cruise23Category) {
            foreach ($cruise23Products as $prod) {
                $gallery = [];
                foreach ($prod['images'] as $imgIndex => $imgUrl) {
                    $ext = pathinfo(parse_url($imgUrl, PHP_URL_PATH), PATHINFO_EXTENSION);
                    $fileName = 'products/cruise23_' . Str::slug($prod['name_en']) . '_' . $imgIndex . '.' . $ext;
                    if (!Storage::disk('public')->exists($fileName)) {
                        $imgData = @file_get_contents($imgUrl);
                        if ($imgData) {
                            Storage::disk('public')->put($fileName, $imgData);
                        }
                    }
                    $gallery[] = $fileName;
                }
                $cover = $gallery[0] ?? null;
                $product = Product::create([
                    'name_en' => $prod['name_en'],
                    'name_az' => $prod['name_az'],
                    'description_en' => $prod['description_en'],
                    'description_az' => $prod['description_az'],
                    'cover' => $cover,
                    'gallery' => $gallery,
                    'price' => $prod['price'],
                    'slug' => Str::slug($prod['name_en']),
                    'is_active' => true
                ]);
                $product->categories()->attach($cruise23Category->id);
            }
        }
        // Prefall22 kategorisi ürünleri (HTML'den ayıklananlar)
        $prefall22Products = [
            [
                'name_en' => 'Beige top and pants',
                'name_az' => 'Beige top and pants',
                'description_en' => $this->generateDescription('Beige top and pants'),
                'description_az' => $this->generateDescription('Beige top and pants'),
                'price' => 410,
                'images' => [
                    'https://static.tildacdn.one/tild6434-3637-4265-a663-336461363564/am301262.JPG',
                    'https://static.tildacdn.one/tild3135-3339-4533-b466-383762393761/am301277.JPG',
                ]
            ],
            [
                'name_en' => 'Chiffon dress with high slits',
                'name_az' => 'Chiffon dress with high slits',
                'description_en' => $this->generateDescription('Chiffon dress with high slits'),
                'description_az' => $this->generateDescription('Chiffon dress with high slits'),
                'price' => 400,
                'images' => [
                    'https://static.tildacdn.one/tild6664-3566-4961-b561-363263626366/am301134.JPG',
                    'https://static.tildacdn.one/tild3436-3066-4930-b837-643562343465/am301143.JPG',
                ]
            ],
            [
                'name_en' => 'Gold dress with chains',
                'name_az' => 'Gold dress with chains',
                'description_en' => $this->generateDescription('Gold dress with chains'),
                'description_az' => $this->generateDescription('Gold dress with chains'),
                'price' => 1800,
                'images' => [
                    'https://static.tildacdn.one/tild3435-3331-4361-b538-366231326333/am301286.jpg',
                    'https://static.tildacdn.one/tild3032-3665-4735-b562-363933396463/am301318.JPG',
                ]
            ],
            [
                'name_en' => 'N logo black tulle dress',
                'name_az' => 'N logo black tulle dress',
                'description_en' => $this->generateDescription('N logo black tulle dress'),
                'description_az' => $this->generateDescription('N logo black tulle dress'),
                'price' => 1100,
                'images' => [
                    'https://static.tildacdn.one/tild3763-3564-4166-b333-313831336363/am301312.JPG',
                ]
            ],
            [
                'name_en' => 'Mint chiffon mini corset dress',
                'name_az' => 'Mint chiffon mini corset dress',
                'description_en' => $this->generateDescription('Mint chiffon mini corset dress'),
                'description_az' => $this->generateDescription('Mint chiffon mini corset dress'),
                'price' => 400,
                'images' => [
                    'https://static.tildacdn.one/tild6230-3362-4035-a166-366466653362/am301309.JPG',
                    'https://static.tildacdn.one/tild6633-6564-4236-b434-393765343935/am301204.JPG',
                ]
            ],
            [
                'name_en' => 'Lace corset dress',
                'name_az' => 'Lace corset dress',
                'description_en' => $this->generateDescription('Lace corset dress'),
                'description_az' => $this->generateDescription('Lace corset dress'),
                'price' => 480,
                'images' => [
                    'https://static.tildacdn.one/tild3362-3637-4331-b739-303435313030/am301316.JPG',
                ]
            ],
            [
                'name_en' => 'Corset and Pants',
                'name_az' => 'Corset and Pants',
                'description_en' => $this->generateDescription('Corset and Pants'),
                'description_az' => $this->generateDescription('Corset and Pants'),
                'price' => 550,
                'images' => [
                    'https://static.tildacdn.one/tild6136-3365-4461-b962-636233653532/IMG_0736.JPG',
                ]
            ],
        ];
        $prefall22Category = Category::where('name_en', 'PRE-FALL22')->first();
        if ($prefall22Category) {
            foreach ($prefall22Products as $prod) {
                $gallery = [];
                foreach ($prod['images'] as $imgIndex => $imgUrl) {
                    $ext = pathinfo(parse_url($imgUrl, PHP_URL_PATH), PATHINFO_EXTENSION);
                    $fileName = 'products/prefall22_' . Str::slug($prod['name_en']) . '_' . $imgIndex . '.' . $ext;
                    if (!Storage::disk('public')->exists($fileName)) {
                        $imgData = @file_get_contents($imgUrl);
                        if ($imgData) {
                            Storage::disk('public')->put($fileName, $imgData);
                        }
                    }
                    $gallery[] = $fileName;
                }
                $cover = $gallery[0] ?? null;
                $product = Product::create([
                    'name_en' => $prod['name_en'],
                    'name_az' => $prod['name_az'],
                    'description_en' => $prod['description_en'],
                    'description_az' => $prod['description_az'],
                    'cover' => $cover,
                    'gallery' => $gallery,
                    'price' => $prod['price'],
                    'slug' => Str::slug($prod['name_en']),
                    'is_active' => true
                ]);
                $product->categories()->attach($prefall22Category->id);
            }
        }
        // Prefall23 kategorisi ürünleri (HTML'den ayıklananlar)
        $prefall23Products = [
            [
                'name_en' => 'Lace black mini corset gown',
                'name_az' => 'Lace black mini corset gown',
                'description_en' => $this->generateDescription('Lace black mini corset gown'),
                'description_az' => $this->generateDescription('Lace black mini corset gown'),
                'price' => 410,
                'images' => [
                    'https://static.tildacdn.one/tild3035-6430-4162-b931-313337383734/photo_52627773770528.jpg',
                    'https://static.tildacdn.one/tild6633-3833-4237-b032-343363373038/photo_52627773770528.jpg',
                ]
            ],
            [
                'name_en' => 'Latex & lace dress with high split',
                'name_az' => 'Latex & lace dress with high split',
                'description_en' => $this->generateDescription('Latex & lace dress with high split'),
                'description_az' => $this->generateDescription('Latex & lace dress with high split'),
                'price' => 440,
                'images' => [
                    'https://static.tildacdn.one/tild6135-6666-4430-b430-343236646466/photo_52627773770528.jpg',
                    'https://static.tildacdn.one/tild3231-6136-4663-a239-326239383336/photo_52627773770528.jpg',
                ]
            ],
            [
                'name_en' => 'Latex corset dress',
                'name_az' => 'Latex corset dress',
                'description_en' => $this->generateDescription('Latex corset dress'),
                'description_az' => $this->generateDescription('Latex corset dress'),
                'price' => 440,
                'images' => [
                    'https://static.tildacdn.one/tild6437-3938-4436-b563-623063346261/photo_52627773770528.jpg',
                ]
            ],
            [
                'name_en' => 'Gold maxi dress with head scarf',
                'name_az' => 'Gold maxi dress with head scarf',
                'description_en' => $this->generateDescription('Gold maxi dress with head scarf'),
                'description_az' => $this->generateDescription('Gold maxi dress with head scarf'),
                'price' => 350,
                'images' => [
                    'https://static.tildacdn.one/tild3865-3832-4138-b761-353364393738/photo_52627773770528.jpg',
                    'https://static.tildacdn.one/tild3962-3136-4838-b637-336632346662/photo_52627773770528.jpg',
                ]
            ],
            [
                'name_en' => 'Gold leather dress',
                'name_az' => 'Gold leather dress',
                'description_en' => $this->generateDescription('Gold leather dress'),
                'description_az' => $this->generateDescription('Gold leather dress'),
                'price' => 588,
                'images' => [
                    'https://static.tildacdn.one/tild3833-6233-4532-b565-383933373062/photo_52627773770528.jpg',
                    'https://static.tildacdn.one/tild3736-3231-4362-a264-626531633636/photo_52627773770528.jpg',
                ]
            ],
            [
                'name_en' => 'White high split dress',
                'name_az' => 'White high split dress',
                'description_en' => $this->generateDescription('White high split dress'),
                'description_az' => $this->generateDescription('White high split dress'),
                'price' => 470,
                'images' => [
                    'https://static.tildacdn.one/tild3531-3431-4536-a439-323532303935/photo_52627773770528.jpg',
                    'https://static.tildacdn.one/tild6431-3962-4665-b432-333032656664/photo_52627773770528.jpg',
                ]
            ],
        ];
        $prefall23Category = Category::where('name_en', 'PRE-FALL23')->first();
        if ($prefall23Category) {
            foreach ($prefall23Products as $prod) {
                $gallery = [];
                foreach ($prod['images'] as $imgIndex => $imgUrl) {
                    $ext = pathinfo(parse_url($imgUrl, PHP_URL_PATH), PATHINFO_EXTENSION);
                    $fileName = 'products/prefall23_' . Str::slug($prod['name_en']) . '_' . $imgIndex . '.' . $ext;
                    if (!Storage::disk('public')->exists($fileName)) {
                        $imgData = @file_get_contents($imgUrl);
                        if ($imgData) {
                            Storage::disk('public')->put($fileName, $imgData);
                        }
                    }
                    $gallery[] = $fileName;
                }
                $cover = $gallery[0] ?? null;
                $product = Product::create([
                    'name_en' => $prod['name_en'],
                    'name_az' => $prod['name_az'],
                    'description_en' => $prod['description_en'],
                    'description_az' => $prod['description_az'],
                    'cover' => $cover,
                    'gallery' => $gallery,
                    'price' => $prod['price'],
                    'slug' => Str::slug($prod['name_en']),
                    'is_active' => true
                ]);
                $product->categories()->attach($prefall23Category->id);
            }
        }
        // FW22 kategorisi ürünleri (HTML'den ayıklananlar)
        $fw22Products = [
            [
                'name_en' => 'Latex corset and pants',
                'name_az' => 'Latex corset and pants',
                'description_en' => $this->generateDescription('Latex corset and pants'),
                'description_az' => $this->generateDescription('Latex corset and pants'),
                'price' => 440,
                'images' => [
                    'https://static.tildacdn.one/tild6139-3738-4665-a330-373638643331/IMG_3500.JPG',
                    'https://static.tildacdn.one/tild3632-3233-4730-a363-376665386464/IMG_0190.JPG',
                ]
            ],
            [
                'name_en' => 'Latex coat',
                'name_az' => 'Latex coat',
                'description_en' => $this->generateDescription('Latex coat'),
                'description_az' => $this->generateDescription('Latex coat'),
                'price' => 400,
                'images' => [
                    'https://static.tildacdn.one/tild6230-6562-4231-a238-326163653630/IMG_3501.JPG',
                    'https://static.tildacdn.one/tild3264-6233-4163-b337-323036363031/IMG_3498.JPG',
                ]
            ],
            [
                'name_en' => 'Latex top and skirt',
                'name_az' => 'Latex top and skirt',
                'description_en' => $this->generateDescription('Latex top and skirt'),
                'description_az' => $this->generateDescription('Latex top and skirt'),
                'price' => 450,
                'images' => [
                    'https://static.tildacdn.one/tild3732-6261-4634-b162-653962626665/IMG_0217.jpg',
                    'https://static.tildacdn.one/tild3861-3431-4030-a361-666332663863/IMG_0195.jpg',
                ]
            ],
            [
                'name_en' => 'White beaded gown',
                'name_az' => 'White beaded gown',
                'description_en' => $this->generateDescription('White beaded gown'),
                'description_az' => $this->generateDescription('White beaded gown'),
                'price' => 880,
                'images' => [
                    'https://static.tildacdn.one/tild6564-3738-4665-b330-653963353262/IMG_3512.JPG',
                    'https://static.tildacdn.one/tild3436-3436-4636-a537-623439323131/IMG_0181.JPG',
                ]
            ],
            [
                'name_en' => 'Maxi dress with cutouts',
                'name_az' => 'Maxi dress with cutouts',
                'description_en' => $this->generateDescription('Maxi dress with cutouts'),
                'description_az' => $this->generateDescription('Maxi dress with cutouts'),
                'price' => 590,
                'images' => [
                    'https://static.tildacdn.one/tild3239-6633-4831-a339-363861393433/IMG_0258.jpg',
                    'https://static.tildacdn.one/tild3662-3739-4637-a261-386430633964/IMG_0182.jpg',
                ]
            ],
            [
                'name_en' => 'White corset body and shorts',
                'name_az' => 'White corset body and shorts',
                'description_en' => $this->generateDescription('White corset body and shorts'),
                'description_az' => $this->generateDescription('White corset body and shorts'),
                'price' => 480,
                'images' => [
                    'https://static.tildacdn.one/tild6565-6237-4137-a464-633336303937/IMG_0259.JPG',
                    'https://static.tildacdn.one/tild3332-3238-4366-a639-303634656530/IMG_0183.JPG',
                ]
            ],
            [
                'name_en' => 'Mini pink dress',
                'name_az' => 'Mini pink dress',
                'description_en' => $this->generateDescription('Mini pink dress'),
                'description_az' => $this->generateDescription('Mini pink dress'),
                'price' => 380,
                'images' => [
                    'https://static.tildacdn.one/tild3863-6366-4364-a362-323033336230/IMG_0194.jpg',
                    'https://static.tildacdn.one/tild3030-3164-4536-b065-376633396162/IMG_0192.JPG',
                ]
            ],
        ];
        $fw22Category = Category::where('name_en', 'FW22')->first();
        if ($fw22Category) {
            foreach ($fw22Products as $prod) {
                $gallery = [];
                foreach ($prod['images'] as $imgIndex => $imgUrl) {
                    $ext = pathinfo(parse_url($imgUrl, PHP_URL_PATH), PATHINFO_EXTENSION);
                    $fileName = 'products/fw22_' . Str::slug($prod['name_en']) . '_' . $imgIndex . '.' . $ext;
                    if (!Storage::disk('public')->exists($fileName)) {
                        $imgData = @file_get_contents($imgUrl);
                        if ($imgData) {
                            Storage::disk('public')->put($fileName, $imgData);
                        }
                    }
                    $gallery[] = $fileName;
                }
                $cover = $gallery[0] ?? null;
                $product = Product::create([
                    'name_en' => $prod['name_en'],
                    'name_az' => $prod['name_az'],
                    'description_en' => $prod['description_en'],
                    'description_az' => $prod['description_az'],
                    'cover' => $cover,
                    'gallery' => $gallery,
                    'price' => $prod['price'],
                    'slug' => Str::slug($prod['name_en']),
                    'is_active' => true
                ]);
                $product->categories()->attach($fw22Category->id);
            }
        }
        // Shop22 kategorisi ürünleri (HTML'den ayıklananlar)
        $shop22Products = [
            [
                'name_en' => 'GOLD SPARKLY CORSET & SKIRT',
                'name_az' => 'GOLD SPARKLY CORSET & SKIRT',
                'description_en' => $this->generateDescription('GOLD SPARKLY CORSET & SKIRT'),
                'description_az' => $this->generateDescription('GOLD SPARKLY CORSET & SKIRT'),
                'price' => 450,
                'images' => [
                    'https://static.tildacdn.one/tild6635-3335-4463-b263-383835656235/IMG_4086.JPG',
                    'https://static.tildacdn.one/tild6233-3761-4733-b038-613766306561/IMG_4087_2.JPG',
                ]
            ],
        ];
        $shop22Category = Category::where('name_en', 'SHOP22')->first();
        if ($shop22Category) {
            foreach ($shop22Products as $prod) {
                $gallery = [];
                foreach ($prod['images'] as $imgIndex => $imgUrl) {
                    $ext = pathinfo(parse_url($imgUrl, PHP_URL_PATH), PATHINFO_EXTENSION);
                    $fileName = 'products/shop22_' . Str::slug($prod['name_en']) . '_' . $imgIndex . '.' . $ext;
                    if (!Storage::disk('public')->exists($fileName)) {
                        $imgData = @file_get_contents($imgUrl);
                        if ($imgData) {
                            Storage::disk('public')->put($fileName, $imgData);
                        }
                    }
                    $gallery[] = $fileName;
                }
                $cover = $gallery[0] ?? null;
                $product = Product::create([
                    'name_en' => $prod['name_en'],
                    'name_az' => $prod['name_az'],
                    'description_en' => $prod['description_en'],
                    'description_az' => $prod['description_az'],
                    'cover' => $cover,
                    'gallery' => $gallery,
                    'price' => $prod['price'],
                    'slug' => Str::slug($prod['name_en']),
                    'is_active' => true
                ]);
                $product->categories()->attach($shop22Category->id);
            }
        }
        // Hijab kategorisi ürünleri (HTML'den ayıklananlar)
        $hijabProducts = [
            [
                'name_en' => 'GOWN "ARABIAN DAYS"',
                'name_az' => 'GOWN "ARABIAN DAYS"',
                'description_en' => $this->generateDescription('GOWN "ARABIAN DAYS"'),
                'description_az' => $this->generateDescription('GOWN "ARABIAN DAYS"'),
                'price' => 2200,
                'images' => [
                    'https://static.tildacdn.one/tild6165-6636-4939-b037-353239303338/IMG_3124_2.jpg',
                ]
            ],
            [
                'name_en' => 'DAZZLING GOWNS',
                'name_az' => 'DAZZLING GOWNS',
                'description_en' => $this->generateDescription('DAZZLING GOWNS'),
                'description_az' => $this->generateDescription('DAZZLING GOWNS'),
                'price' => 1200,
                'images' => [
                    'https://static.tildacdn.one/tild3535-6466-4763-a630-356539333338/IMG_3236.jpg',
                    'https://static.tildacdn.one/tild3730-3934-4930-a462-343734396561/IMG_3235_2.JPG',
                ]
            ],
            [
                'name_en' => 'HAND-BEADED ABAYAS',
                'name_az' => 'HAND-BEADED ABAYAS',
                'description_en' => $this->generateDescription('HAND-BEADED ABAYAS'),
                'description_az' => $this->generateDescription('HAND-BEADED ABAYAS'),
                'price' => 435,
                'images' => [
                    'https://static.tildacdn.one/tild3338-6364-4664-b665-326339316636/IMG_3239.jpg',
                    'https://static.tildacdn.one/tild6137-3438-4835-b532-653535663637/IMG_3238.jpg',
                ]
            ],
        ];
        $hijabCategory = Category::where('name_en', 'HIJAB')->first();
        if ($hijabCategory) {
            foreach ($hijabProducts as $prod) {
                $gallery = [];
                foreach ($prod['images'] as $imgIndex => $imgUrl) {
                    $ext = pathinfo(parse_url($imgUrl, PHP_URL_PATH), PATHINFO_EXTENSION);
                    $fileName = 'products/hijab_' . Str::slug($prod['name_en']) . '_' . $imgIndex . '.' . $ext;
                    if (!Storage::disk('public')->exists($fileName)) {
                        $imgData = @file_get_contents($imgUrl);
                        if ($imgData) {
                            Storage::disk('public')->put($fileName, $imgData);
                        }
                    }
                    $gallery[] = $fileName;
                }
                $cover = $gallery[0] ?? null;
                $product = Product::create([
                    'name_en' => $prod['name_en'],
                    'name_az' => $prod['name_az'],
                    'description_en' => $prod['description_en'],
                    'description_az' => $prod['description_az'],
                    'cover' => $cover,
                    'gallery' => $gallery,
                    'price' => $prod['price'],
                    'slug' => Str::slug($prod['name_en']),
                    'is_active' => true
                ]);
                $product->categories()->attach($hijabCategory->id);
            }
        }
    }

    private function generateDescription($name)
    {
        $descriptions = [
            "High-quality {$name} made from premium materials. Perfect for everyday wear and special occasions.",
            "Stylish and comfortable {$name} designed for modern fashion enthusiasts. Features excellent craftsmanship.",
            "Elegant {$name} that combines style and functionality. Suitable for various occasions and settings.",
            "Premium {$name} crafted with attention to detail. Offers both comfort and sophisticated design.",
            "Contemporary {$name} that reflects current fashion trends. Made with durable and breathable materials.",
            "Versatile {$name} that can be dressed up or down. Perfect addition to any wardrobe.",
            "Classic {$name} with a modern twist. Timeless design that never goes out of style.",
            "Fashion-forward {$name} that makes a statement. Designed for those who appreciate unique style.",
            "Comfortable and stylish {$name} for everyday use. Features ergonomic design and quality materials.",
            "Sophisticated {$name} that exudes elegance. Perfect for professional and casual settings alike."
        ];

        return $descriptions[array_rand($descriptions)];
    }
}