<?php

namespace Database\Seeders;

use App\Models\ProductStandard;
use Illuminate\Database\Seeder;

class ProductStandardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductStandard::factory(3)
            ->create();
    }
}
