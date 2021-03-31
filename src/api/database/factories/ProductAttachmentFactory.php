<?php

namespace Database\Factories;

use App\Models\ProductAttachment;
use App\Models\File;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductAttachmentFactory extends Factory
{
    protected $model = ProductAttachment::class;

    public function definition(): array
    {
        return [
            'product_id' => Product::factory()->create(),
            'file_id'    => File::factory()->create(),
        ];
    }
}
