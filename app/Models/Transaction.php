<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'txpg_id',
        'hpp_url',
        'password',
        'status',
        'secret',
        'cvv_2_auth_status'
    ];
}
