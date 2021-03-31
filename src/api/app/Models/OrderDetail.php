<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'standard_id',
        'quantity',
        'unit_price',
        'tax',
        'shipping',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function standard()
    {
        return $this->belongsTo(ProductStandard::class);
    }
}
