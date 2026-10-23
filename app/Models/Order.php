<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'customer_name',
        'phone',
        'dine_option',
        'notes',
        'items',
        'subtotal',
        'tax',
        'total_amount',
        'status',
        'ordered_at',
    ];

    protected $casts = [
        'items'      => 'array',
        'ordered_at' => 'datetime',
    ];
}
