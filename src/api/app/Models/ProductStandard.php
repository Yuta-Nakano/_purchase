<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStandard extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'name',
        'code',
        'thumb_id',
        'thumb_target_id',
        'status',
        'stock',
        'price',
    ];

    protected $hidden = [
        self::CREATED_AT,
        self::UPDATED_AT,
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function thumb()
    {
        return $this->belongsTo(File::class);
    }

    public function thumbTarget()
    {
        return $this->belongsTo(File::class);
    }
}
