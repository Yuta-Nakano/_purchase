<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserAddressSeeder::class,
            ProductStandardSeeder::class,
            TermRelationshipSeeder::class,
            OrderDetailSeeder::class,
        ]);
    }
}
