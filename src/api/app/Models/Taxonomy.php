<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taxonomy extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'parent_id',
        'term_id',
    ];

    public function parent()
    {
        return $this->belongsTo(Term::class);
    }

    public function term()
    {
        return $this->belongsTo(Term::class);
    }

    public function relationships()
    {
        return $this->hasMany(TermRelationship::class);
    }

    public function scopeIsTerms($query, Term $term)
    {
        return $query
            ->whereIn(
                'term_id',
                Term::query()
                    ->select('id')
                    ->where('slug', $term->slug)
            );
    }

    public static function getIsTermsSameTaxonomy(string $taxonomyName, Term $term)
    {
        return self::isTerms($term)
            ->where('name', $taxonomyName)
            ->get();
    }
}
