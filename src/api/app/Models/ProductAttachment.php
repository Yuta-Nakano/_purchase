<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttachment extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'file_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function file()
    {
        return $this->belongsTo(File::class);
    }
}
