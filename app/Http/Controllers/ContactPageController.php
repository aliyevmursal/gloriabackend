<?php

namespace App\Http\Controllers;

use App\Models\ContactPage;

class ContactPageController extends Controller
{
    public function show()
    {
        $page = ContactPage::where('is_active', true)->first();

        if (!$page) {
            return response()->json([
                'message' => 'Contact page not found'
            ], 404);
        }

        return response()->json($page);
    }
}
