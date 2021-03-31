<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermRelationship extends Model
{
    use HasFactory;

    protected $fillable = [
        'relation_type',
        'relation_id',
        'taxonomy_id',
    ];

    public function taxonomy()
    {
        return $this->belongsTo(Taxonomy::class);
    }

    public function relation(string $class, string $type)
    {
        if (!$class || !$type) {
            return $this;
        }

        return $this->belongsTo($class);
    }

    public function various()
    {
        if ($this->relation_type === 'product') {
            return $this->belongsTo(Product::class, 'relation_id');
        }
    }
}
