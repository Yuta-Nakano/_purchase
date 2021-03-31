<?php

namespace Database\Factories;

use App\Models\File;
use Illuminate\Database\Eloquent\Factories\Factory;

class FileFactory extends Factory
{
    protected $model = File::class;

    public function definition(): array
    {
        $slug = $this->faker->regexify('[A-Za-z0-9]{12}');
        return [
            'slug'     => $slug,
            'name'     => $this->faker->unique()->bothify('???###'),
            'filename' => $slug . $this->faker->randomElement(['.png', '.jpg']),
        ];
    }
}
