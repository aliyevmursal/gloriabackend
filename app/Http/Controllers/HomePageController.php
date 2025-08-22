<?php

namespace App\Http\Controllers;

use App\Models\HomePage;

class HomePageController extends Controller
{
    public function show()
    {
        $page = HomePage::where('is_active', true)->first();

        if (!$page) {
            return response()->json([
                'message' => 'Home page not found'
            ], 404);
        }

        return response()->json($page);
    }
}