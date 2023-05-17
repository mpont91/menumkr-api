<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(int $user_id): void
    {
        Menu::factory(10)->create(['user_id' => $user_id]);
    }
}