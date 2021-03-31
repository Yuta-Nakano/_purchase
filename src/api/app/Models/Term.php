<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Term extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    public static function boot()
    {
        parent::boot();
        static::deleting(function($term) {
            DB::beginTransaction();
            try {
                $term->taxonomy->relationships()->delete();
                $term->taxonomy->delete();
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                abort(response(['message' => $e->getMessage()], 500));
            }
        });
    }

    public function taxonomy()
    {
        return $this->hasOne(Taxonomy::class);
    }

    public function children()
    {
        return $this->taxonomy()->parent();
    }
}
