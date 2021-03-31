<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment_type',
        'credit_card_type',
        'credit_card_numbar',
        'credit_expiration_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function billingAddress()
    {
        return $this->hasOneThrough(
            UserAddress::class, // 対象
            User::class, // 中間
            'id', // 中間モデル.aaa_id - A
            'id', // 対象モデル.id - B
            'user_id', // このモデル.id - A
            'billing_address_id', // 中間モデル.bbb_id - B
        );
    }
}
