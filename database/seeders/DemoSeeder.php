<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\Dish;
use App\Models\Heading;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
    private User $user;

    private Currency $currency;

    private Menu $menu;

    private Heading $starters;

    private Heading $main;

    private Heading $desserts;

    public function run(): void
    {
        $this->createUser();

        $this->createCurrency();

        $this->createMenu();

        $this->createHeadings();

        $this->createDishes();
    }

    private function createUser(): void
    {
        $this->user = User::factory()->create([
            'name' => 'Marc Pont',
            'email' => 'mpont91@gmail.com',
        ]);
    }

    private function createCurrency()
    {
        $this->currency = Currency::query()->firstOrCreate([
            'name' => 'EUR',
            'symbol' => '€',
        ])->first();
    }

    private function createMenu(): void
    {
        $this->menu = Menu::factory()->create([
            'name' => 'Menu MKR',
            'slug' => 'menu-mkr',
            'user_id' => $this->user->id,
            'currency_id' => $this->currency->id,
        ]);
    }

    private function createHeadings(): void
    {
        $this->starters = Heading::factory()->create(['name' => 'Starters', 'menu_id' => $this->menu->id]);
        $this->main = Heading::factory()->create(['name' => 'Main courses', 'menu_id' => $this->menu->id]);
        $this->desserts = Heading::factory()->create(['name' => 'Desserts', 'menu_id' => $this->menu->id]);
    }

    private function createDishes(): void
    {
        Dish::factory()->create(['name' => 'Sausage rolls', 'price' => 4.25, 'heading_id' => $this->starters->id]);
        Dish::factory()->create(['name' => 'Chicken fingers', 'price' => 7.15, 'heading_id' => $this->starters->id]);
        Dish::factory()->create(['name' => 'Nachos', 'price' => 10.00, 'heading_id' => $this->starters->id]);

        Dish::factory()->create(['name' => 'Grilled chicken', 'price' => 8.50, 'heading_id' => $this->main->id]);
        Dish::factory()->create(['name' => 'Steak', 'price' => 17.99, 'heading_id' => $this->main->id]);
        Dish::factory()->create(['name' => 'Spaghetti carbonara', 'price' => 11.11, 'heading_id' => $this->main->id]);

        Dish::factory()->create(['name' => 'Chocolate ice cream', 'price' => 3.80, 'heading_id' => $this->desserts->id]
        );
        Dish::factory()->create(['name' => 'Orange juice', 'price' => 2.10, 'heading_id' => $this->desserts->id]);
        Dish::factory()->create(['name' => 'Carrot cake', 'price' => 4.85, 'heading_id' => $this->desserts->id]);
    }
}
