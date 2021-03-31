<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'content',
    ];

    public static function boot()
    {
        parent::boot();
        static::deleting(function($product) {
            DB::beginTransaction();
            try {
                $product->standards()->delete();
                $product->attachments()->delete();
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                abort(response(['message' => $e->getMessage()], 500));
            }
        });
    }

    public function standards()
    {
        return $this->hasMany(ProductStandard::class);
    }

    public function attachments()
    {
        return $this->hasMany(ProductAttachment::class);
    }

    public function taxonomy()
    {
        return $this->hasMany(TermRelationship::class, 'relation_id');
            // ->where('relation_type', 'product');
    }
}
