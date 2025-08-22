<?php

namespace App\Http\Controllers;

use App\Models\Banner;

class BannerController extends Controller
{
    public function all()
    {
        $banners = Banner::query()->orderBy("position", "asc")->where("is_active", true)->get();

        return $banners;
    }
}
