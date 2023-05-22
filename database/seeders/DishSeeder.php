<?php

namespace Database\Seeders;

use App\Models\Dish;
use Illuminate\Database\Seeder;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(int $heading_id): void
    {
        Dish::factory(10)->create(['heading_id' => $heading_id]);
    }
}
