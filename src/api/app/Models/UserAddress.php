<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'dist_name',
        'last_name',
        'fast_name',
        'post_code',
        'prefecture',
        'municipality',
        'address',
        'building',
        'phone_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
