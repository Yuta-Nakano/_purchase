<?php

namespace App\Models;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    protected $appends = [
        'url',
    ];

    const SLUG_LENGTH = 12;
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        if (! \Illuminate\Support\Arr::get($this->attributes, 'slug')) {
            $this->setSlug();
        }
    }

    public function setSlug(): void
    {
        $this->attributes['slug'] = $this->getRandumSlug();
    }

    public function getRandumSlug(): string
    {
        $char = array_merge(
            range(0, 9), range('a', 'z'),
            range('A', 'Z'), ['-', '_'],
        );

        $length = count($char);
        $slug = '';

        for ($i=0; $i < self::SLUG_LENGTH; $i++) {
            $slug .= $char[random_int(0, $length -1)];
        }

        return $slug;
    }

    public function getUrlAttribute(): string
    {
        try {
            $file = Storage::disk('s3')
                ->exists($this->attributes['filename']);
        } catch (FileNotFoundException $e) {
            return null;
        }

        return Storage::disk('s3')
            ->url($this->attributes['filename']);
    }
}
