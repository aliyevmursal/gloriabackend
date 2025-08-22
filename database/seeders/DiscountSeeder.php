<?php

namespace Database\Seeders;

use App\Models\Discount;
use Illuminate\Database\Seeder;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $discounts = [
            [
                'name_en' => 'Summer Sale',
                'name_az' => 'Yay Endirimi',
                'type' => 'percentage',
                'value' => 30,
                'start_date' => now(),
                'end_date' => now()->addMonths(3),
                'is_active' => true
            ],
            [
                'name_en' => 'New Customer Discount',
                'name_az' => 'Yeni Müştəri Endirimi',
                'type' => 'percentage',
                'value' => 15,
                'start_date' => now(),
                'end_date' => now()->addYear(),
                'is_active' => true
            ],
            [
                'name_en' => 'Bulk Purchase',
                'name_az' => 'Toplu Alış',
                'type' => 'percentage',
                'value' => 20,
                'start_date' => now(),
                'end_date' => now()->addMonths(6),
                'is_active' => true
            ],
            [
                'name_en' => 'Flash Sale',
                'name_az' => 'Sürətli Endirim',
                'type' => 'percentage',
                'value' => 50,
                'start_date' => now(),
                'end_date' => now()->addDays(7),
                'is_active' => true
            ],
            [
                'name_en' => 'Fixed Discount',
                'name_az' => 'Sabit Endirim',
                'type' => 'fixed',
                'value' => 25,
                'start_date' => now(),
                'end_date' => now()->addMonths(2),
                'is_active' => true
            ],
            [
                'name_en' => 'Weekend Special',
                'name_az' => 'Həftəsonu Xüsusi',
                'type' => 'percentage',
                'value' => 25,
                'start_date' => now(),
                'end_date' => now()->addMonths(4),
                'is_active' => true
            ],
            [
                'name_en' => 'Clearance Sale',
                'name_az' => 'Təmizləmə Satışı',
                'type' => 'percentage',
                'value' => 70,
                'start_date' => now(),
                'end_date' => now()->addMonths(1),
                'is_active' => true
            ],
            [
                'name_en' => 'Student Discount',
                'name_az' => 'Tələbə Endirimi',
                'type' => 'percentage',
                'value' => 10,
                'start_date' => now(),
                'end_date' => now()->addYear(),
                'is_active' => true
            ],
            [
                'name_en' => 'Loyalty Discount',
                'name_az' => 'Sadiqlik Endirimi',
                'type' => 'percentage',
                'value' => 5,
                'start_date' => now(),
                'end_date' => now()->addYear(),
                'is_active' => true
            ],
            [
                'name_en' => 'Holiday Special',
                'name_az' => 'Bayram Xüsusi',
                'type' => 'percentage',
                'value' => 40,
                'start_date' => now(),
                'end_date' => now()->addMonths(2),
                'is_active' => true
            ]
        ];

        foreach ($discounts as $discount) {
            Discount::create($discount);
        }
    }
}