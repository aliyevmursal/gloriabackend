<?php

namespace App\Http\Controllers;

use App\Models\DeliveryType;

class DeliveryTypeController extends Controller
{
    public function all()
    {
        $deliveryTypes = DeliveryType::query()->where("is_active", true)->get();

        return $deliveryTypes;
    }
}
