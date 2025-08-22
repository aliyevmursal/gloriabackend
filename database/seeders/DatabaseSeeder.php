<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'first_name' => 'Test',
        //     'last_name' => 'User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            HomePageSeeder::class,
            BlogPageSeeder::class,
            ContactPageSeeder::class,
            AboutPageSeeder::class,
            CategorySeeder::class,
            DiscountSeeder::class,
            ProductSeeder::class,
            BlogCategorySeeder::class,
            BlogSeeder::class,
            ProductPageSeeder::class,
            BannerSeeder::class,
            FaqSeeder::class,
            ProductSizeSeeder::class,
        ]);
    }
}
