<?php

namespace Database\Factories;

use App\Models\File;
use App\Models\Product;
use App\Models\ProductAttachment;
use App\Models\ProductStandard;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductStandardFactory extends Factory
{
    protected $model = ProductStandard::class;

    public function definition(): array
    {
        $attachment = ProductAttachment::factory()->create();
        return [
            'product_id'      => $attachment->product,
            'name'            => $this->faker->lexify('カラー????'),
            'code'            => $this->faker->unique()->bothify('???###'),
            'thumb_id'        => $attachment->file,
            'thumb_target_id' => $attachment->file,
            'status'          => $this->faker->randomElement(['private', 'publish']),
            'stock'           => $this->faker->numberBetween(-1, 100),
            'price'           => $this->faker->numberBetween(0, 10000),
        ];
    }
}
