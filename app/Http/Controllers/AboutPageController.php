<?php

namespace App\Http\Controllers;

use App\Models\AboutPage;

class AboutPageController extends Controller
{
    public function show()
    {
        $page = AboutPage::where('is_active', true)->first();

        if (!$page) {
            return response()->json([
                'message' => 'About page not found'
            ], 404);
        }

        return response()->json($page);
    }
}