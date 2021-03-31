<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'birthday',
        'sex',
        'billing_address_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'billing_address_id' => 'int',
        'email_verified_at'  => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();
        static::deleting(function($user) {
            DB::beginTransaction();
            try {
                $user->addresses()->delete();
                $user->payments()->delete();
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                abort(response(['message' => $e->getMessage()], 500));
            }
        });
    }

    public function billingAddress()
    {
        return $this->hasOne(UserAddress::class, 'id', 'billing_address_id');
    }

    public function addresses()
    {
        return $this->hasMany(UserAddress::class);
    }

    public function payments()
    {
        return $this->hasMany(UserPayment::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
