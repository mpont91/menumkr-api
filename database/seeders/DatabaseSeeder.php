<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\Dish;
use App\Models\Heading;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    private const DEFAULT_USER = [
        'name' => 'Marc Pont',
        'email' => 'mpont91@gmail.com',
    ];

    private User $user;

    private Menu $menu;

    private Heading $starters;

    private Heading $main;

    private Heading $desserts;

    public function run(): void
    {
        $this->createFakeData();

        $this->createDefaultUser();

        $this->createDefaultMenu();

        $this->createDefaultHeadings();

        $this->createDefaultDishes();
    }

    private function createFakeData(): void
    {
        $this->call([UserSeeder::class, CurrencySeeder::class]);

        foreach (User::all() as $user) {
            $this->callWith(MenuSeeder::class, [
                                                 'user_id' => $user->id,
                                                 'currency_id' => $this->getRandomCurrency()->id
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

    private function createDefaultUser(): void
    {
        $this->user = User::factory()->create(self::DEFAULT_USER);
    }

    private function createDefaultMenu(): void
    {
        $this->menu = Menu::factory()->create([
                                                  'name' => 'Menu MKR',
                                                  'slug' => 'menu-mkr',
                                                  'user_id' => $this->user->id,
                                                  'currency_id' => $this->getRandomCurrency()->id,
                                              ]);
    }

    private function createDefaultHeadings(): void
    {
        $this->starters = Heading::factory()->create(['name' => 'Starters', 'menu_id' => $this->menu->id]);
        $this->main = Heading::factory()->create(['name' => 'Main courses', 'menu_id' => $this->menu->id]);
        $this->desserts = Heading::factory()->create(['name' => 'Desserts', 'menu_id' => $this->menu->id]);
    }

    private function createDefaultDishes(): void
    {
        Dish::factory()->create(['name' => 'Sausage rolls', 'heading_id' => $this->starters->id]);
        Dish::factory()->create(['name' => 'Chicken fingers', 'heading_id' => $this->starters->id]);
        Dish::factory()->create(['name' => 'Nachos', 'heading_id' => $this->starters->id]);

        Dish::factory()->create(['name' => 'Grilled chicken', 'heading_id' => $this->main->id]);
        Dish::factory()->create(['name' => 'Steak', 'heading_id' => $this->main->id]);
        Dish::factory()->create(['name' => 'Spaghetti carbonara', 'heading_id' => $this->main->id]);

        Dish::factory()->create(['name' => 'Chocolate ice cream', 'heading_id' => $this->desserts->id]);
        Dish::factory()->create(['name' => 'Orange juice', 'heading_id' => $this->desserts->id]);
        Dish::factory()->create(['name' => 'Carrot cake', 'heading_id' => $this->desserts->id]);
    }

    private function getRandomCurrency(): Model
    {
        return Currency::query()->firstOrFail();
    }
}
