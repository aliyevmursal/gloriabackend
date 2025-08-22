<?php

namespace App\Http\Controllers;

use App\Models\Faq;

class FaqController extends Controller
{
    public function all()
    {
        $faqs = Faq::query()->active()->orderByPosition()->get();

        return $faqs;
    }
}