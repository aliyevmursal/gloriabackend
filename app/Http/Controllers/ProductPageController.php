<?php

namespace App\Http\Controllers;

use App\Models\ProductPage;

class ProductPageController extends Controller
{
    public function show()
    {
        $page = ProductPage::where('is_active', true)->first();
        if (!$page) {
            return response()->json(['message' => 'Product page not found'], 404);
        }
        return response()->json($page);
    }
}