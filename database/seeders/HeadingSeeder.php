<?php

namespace Database\Seeders;

use App\Models\Heading;
use Illuminate\Database\Seeder;

class HeadingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(int $menu_id): void
    {
        Heading::factory(4)->create(['menu_id' => $menu_id]);
    }
}
