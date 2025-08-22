<?php

namespace Database\Seeders;

use App\Models\AboutPage;
use Illuminate\Database\Seeder;

class AboutPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutPage::create([
            'description_en' => "Welcome to GNL Couture,\nWhere every stitch tells a story of elegance and grace. Established in 2019, our couture is a celebration of classic style and contemporary design. At Timeless Chic, we believe in the transformative power of a well-crafted dress — an embodiment of the wearer's confidence and individuality.\n\n\nImmerse yourself in the artistry of our skilled dressmakers who bring dreams to life with meticulous attention to detail. From handpicked fabrics to personalized fittings, each dress is a testament to our commitment to quality and craftsmanship. Our couture is a sanctuary for those seeking a dress that transcends trends, capturing the essence of timeless chic.\n\n\nAt GNL Couture, sustainability and ethical practices are woven into the fabric of our atelier. We source materials responsibly, prioritize fair labor practices, and embrace a philosophy that values both beauty and conscience. Join us in the pursuit of elegance that leaves a positive mark on the world.\n\n\nStep into the world of GNL Couture, whether you dream of a wedding dress, a red carpet performance or an everyday expression of style, our atelier invites you to immerse yourself in the art of dressing well.",
            'description_az' => "GNL Couture-a xoş gəlmisiniz,\nHər bir tikiş zərifliyin və incəliyin hekayəsini danışır. 2019-cu ildə qurulan atelyemiz klassik üslubun və müasir dizaynın təntənəsidir. Timeless Chic-də biz yaxşı tikilmiş bir libasın insanın özünə inamını və fərdiliyini ortaya çıxaran gücünə inanırıq.\n\n\nBacarıqlı dərzi ustalarımızın sənətkarlığına qərq olun. Onlar hər bir detalı diqqətlə işləyərək arzuları gerçəyə çevirirlər. Seçilmiş parçalardan fərdi ölçüyə qədər hər bir libas keyfiyyət və ustalığa sadiqliyimizin göstəricisidir. Atelyemiz dəbə tabe olmayan, zamansız zərifliyi axtaranlar üçün bir məkandır.\n\n\nGNL Couture-da davamlılıq və etik dəyərlər atelyemizin əsasını təşkil edir. Biz materialları məsuliyyətlə seçir, ədalətli əmək prinsiplərinə üstünlük verir və gözəlliklə yanaşı vicdanı da dəyərləndirən fəlsəfəni qəbul edirik. Dünyada müsbət iz buraxan zərifliyin axtarışında bizə qoşulun.\n\n\nGNL Couture dünyasına addım atın: istər toy libası, istər qırmızı xalça üçün geyim, istərsə də gündəlik tərz axtarırsınızsa, atelyemiz sizi yaxşı geyinmək sənətinə dəvət edir.",
            'video_url' => 'https://vimeo.com/906657783?p=1l&pgroup=plv',
            'quality_title_en' => 'Premium Quality',
            'quality_title_az' => 'Yüksək Keyfiyyət',
            'quality_description_en' => 'Confidence in expertise is the foundation of our team. Each member brings a wealth of legal acumen, with a minimum of 5 years of professional experience.',
            'quality_description_az' => 'Komandamızın təməli peşəkarlığa olan inamdır. Hər bir üzvümüz ən azı 5 illik peşəkar təcrübəyə və dərin biliklərə malikdir.',
            'individual_approach_title_en' => 'Individual Approach',
            'individual_approach_title_az' => 'Fərdi Yanaşma',
            'individual_approach_description_en' => 'Book appointment whether you prefer the convenience of online consultations or the luxury of an in-person session with our Fashion Adviser.\nSchedule your consultation today and step into a world of GNL Couture.',
            'individual_approach_description_az' => 'Onlayn konsultasiyanın rahatlığını və ya Moda Məsləhətçimizlə fərdi görüşün lüksünü seçin, görüşünüzü bu gün təyin edin və GNL Couture dünyasına addım atın.',
            'worldwide_shipping_title_en' => 'Worldwide Shipping',
            'worldwide_shipping_title_az' => 'Dünya Üzrə Çatdırılma',
            'worldwide_shipping_description_en' => 'Experience the convenience of having our meticulously crafted pieces delivered to your doorstep, no matter where you are.',
            'worldwide_shipping_description_az' => 'Harada olmağınızdan asılı olmayaraq, incəliklə hazırlanmış məhsullarımızın birbaşa ünvanınıza çatdırılmasının rahatlığını yaşayın.',
            'meta_title_en' => 'About Us - Premium Fashion Brand',
            'meta_title_az' => 'Haqqımızda - Premium Moda Brendi',
            'meta_description_en' => 'Discover our story, commitment to quality, individual approach, and worldwide shipping services. Learn about our premium fashion brand.',
            'meta_description_az' => 'Hekayəmizi, keyfiyyətə sadiqliyimizi, fərdi yanaşmamızı və dünya üzrə çatdırılma xidmətlərimizi kəşf edin. Premium moda brendimiz haqqında məlumat əldə edin.',
            'meta_keywords_en' => 'about us, fashion brand, quality, individual approach, worldwide shipping, premium clothing',
            'meta_keywords_az' => 'haqqımızda, moda brendi, keyfiyyət, fərdi yanaşma, dünya üzrə çatdırılma, premium geyim',
            'og_title_en' => 'About Us - Premium Fashion Brand',
            'og_title_az' => 'Haqqımızda - Premium Moda Brendi',
            'og_description_en' => 'Discover our story, commitment to quality, individual approach, and worldwide shipping services.',
            'og_description_az' => 'Hekayəmizi, keyfiyyətə sadiqliyimizi, fərdi yanaşmamızı və dünya üzrə çatdırılma xidmətlərimizi kəşf edin.',
            'og_image' => null,
            'is_active' => true,
        ]);
    }
}