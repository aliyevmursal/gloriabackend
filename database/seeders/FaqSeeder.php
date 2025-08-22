<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'question_en' => 'How can I track my order?',
                'question_az' => 'Sifarişimi necə izləyə bilərəm?',
                'answer_en' => 'You can track your order using the tracking link sent to your email after shipping.',
                'answer_az' => 'Sifariş göndərildikdən sonra e-poçtunuza göndərilən izləmə linki ilə sifarişinizi izləyə bilərsiniz.',
                'is_active' => true,
            ],
            [
                'question_en' => 'Do you offer international shipping?',
                'question_az' => 'Beynəlxalq çatdırılma təklif edirsiniz?',
                'answer_en' => 'Yes, we ship worldwide. Shipping costs and delivery times vary by destination.',
                'answer_az' => 'Bəli, biz dünya üzrə çatdırılma edirik. Çatdırılma xərcləri və müddəti ölkəyə görə dəyişir.',
                'is_active' => true,
            ],
            [
                'question_en' => 'Can I return or exchange an item?',
                'question_az' => 'Məhsulu qaytara və ya dəyişə bilərəm?',
                'answer_en' => 'Yes, you can return or exchange items within 14 days of delivery if they are unused and in original condition.',
                'answer_az' => 'Bəli, istifadə olunmamış və orijinal vəziyyətdə olan məhsulları 14 gün ərzində qaytara və ya dəyişə bilərsiniz.',
                'is_active' => true,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}