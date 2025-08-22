<?php

namespace App\Http\Controllers;

use App\Models\Color;

class ColorController extends Controller
{
    public function all()
    {
        $colors = Color::query()->where("is_active", true)->get();

        return $colors;
    }
}