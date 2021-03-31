<?php

namespace Database\Seeders;

use App\Models\TermRelationship;
use Illuminate\Database\Seeder;

class TermRelationshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TermRelationship::factory(20)
            ->create();
    }
}
