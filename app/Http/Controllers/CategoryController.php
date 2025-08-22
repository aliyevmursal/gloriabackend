<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function all()
    {
        $categories = Category::query()->active()->orderByPosition()->get();

        return $categories;
    }
}