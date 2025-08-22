<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Size;
use Illuminate\Database\Seeder;

class ProductSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all products and sizes
        $products = Product::all();
        $sizes = Size::all();

        if ($products->isEmpty() || $sizes->isEmpty()) {
            $this->command->warn('No products or sizes found. Please run ProductSeeder and SizeSeeder first.');
            return;
        }

        $this->command->info("Connecting {$products->count()} products with {$sizes->count()} sizes...");

        // Connect all sizes to all products
        foreach ($products as $product) {
            $sizeIds = $sizes->pluck('id')->toArray();
            $product->sizes()->sync($sizeIds);
        }

        $this->command->info('Successfully connected all sizes to all products!');
        $this->command->info("Total connections created: " . ($products->count() * $sizes->count()));
    }
}
