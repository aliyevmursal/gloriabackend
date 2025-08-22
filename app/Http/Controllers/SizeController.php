<?php

namespace App\Http\Controllers;

use App\Models\Size;

class SizeController extends Controller
{
    public function all()
    {
        $sizes = Size::query()->where("is_active", true)->get();

        return $sizes;
    }
}