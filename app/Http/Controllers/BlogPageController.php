<?php

namespace App\Http\Controllers;

use App\Models\BlogPage;

class BlogPageController extends Controller
{
    public function show()
    {
        $page = BlogPage::where('is_active', true)->first();

        if (!$page) {
            return response()->json([
                'message' => 'Blog page not found'
            ], 404);
        }

        return response()->json($page);
    }
}
