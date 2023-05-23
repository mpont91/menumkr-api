<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\Heading;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([UserSeeder::class, CurrencySeeder::class]);

        $this->createFakeMenus();

        $this->call(DemoSeeder::class);
    }

    private function createFakeMenus(): void
    {
        foreach (User::all() as $user) {
            $this->callWith(
                MenuSeeder::class,
                [
                    'user_id' => $user->id,
                    'currency_id' => Currency::query()->firstOrFail()->id,
                ]
            );
        }

        foreach (Menu::all() as $menu) {
            $this->callWith(HeadingSeeder::class, ['menu_id' => $menu->id]);
        }

        foreach (Heading::all() as $heading) {
            $this->callWith(DishSeeder::class, ['heading_id' => $heading->id]);
        }
    }
}
