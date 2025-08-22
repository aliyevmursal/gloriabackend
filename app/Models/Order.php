<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'total_price',
        'phone_number',
        'zip_code',
        'country',
        'address',
        'status',
        'delivery_type_id',
        'is_paid'
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
        'is_paid' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function deliveryType()
    {
        return $this->belongsTo(DeliveryType::class);
    }

    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            'pending' => 'Pending',
            'confirmed' => 'Confirmed',
            'preparing' => 'Preparing',
            'prepared' => 'Prepared',
            'shipped' => 'Shipped',
            'delivered' => 'Delivered',
            'returned' => 'Returned',
            'cancelled' => 'Cancelled',
            default => 'Unknown'
        };
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'delivered');
    }

    public function scopeReturned($query)
    {
        return $query->where('status', 'returned');
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }
}