<?php

namespace Tests\Feature\Customer;

use App\Models\Currency;
use App\Models\Menu;
use App\Models\User;
use Database\Seeders\DemoSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CustomerShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_show(): void
    {
        $currency = Currency::factory()->create();

        $user = User::factory()->has(Menu::factory(['currency_id' => $currency->id])->count(5))->create();

        $menuShowSlug = $user->menus->first()->slug;

        $response = $this->getJson('/api/customer/' . $menuShowSlug);

        $response->assertOk();
    }

    public function test_customer_show_nonexistent(): void
    {
        $response = $this->getJson('/api/customer/nonexistent');

        $response->assertNotFound();
    }

    public function test_customer_user_show(): void
    {
        $currency = Currency::factory()->create();

        $user = User::factory()->has(Menu::factory(['currency_id' => $currency->id])->count(5))->create();
        Sanctum::actingAs($user);

        $menuShowSlug = $user->menus->first()->slug;

        $response = $this->getJson('/api/customer/' . $menuShowSlug);

        $response->assertOk();
    }

    public function test_customer_show_attributes(): void
    {
        $this->seed(DemoSeeder::class);

        $response = $this->getJson('/api/customer/menu-mkr');

        $response->assertOk();

        $content = json_decode($response->getContent());

        $this->assertEquals('Menu MKR', $content->data->name);
        $this->assertEquals('menu-mkr', $content->data->slug);
        $this->assertEquals('EUR', $content->data->currency->name);
        $this->assertEquals('€', $content->data->currency->symbol);

        $this->assertEquals('Starters', $content->data->headings[0]->name);

        $this->assertEquals('Sausage rolls', $content->data->headings[0]->dishes[0]->name);
        $this->assertEquals(4.25, $content->data->headings[0]->dishes[0]->price);

        $this->assertEquals('Chicken fingers', $content->data->headings[0]->dishes[1]->name);
        $this->assertEquals(7.15, $content->data->headings[0]->dishes[1]->price);

        $this->assertEquals('Nachos', $content->data->headings[0]->dishes[2]->name);
        $this->assertEquals(10.00, $content->data->headings[0]->dishes[2]->price);

        $this->assertEquals('Main courses', $content->data->headings[1]->name);

        $this->assertEquals('Grilled chicken', $content->data->headings[1]->dishes[0]->name);
        $this->assertEquals(8.50, $content->data->headings[1]->dishes[0]->price);

        $this->assertEquals('Steak', $content->data->headings[1]->dishes[1]->name);
        $this->assertEquals(17.99, $content->data->headings[1]->dishes[1]->price);

        $this->assertEquals('Spaghetti carbonara', $content->data->headings[1]->dishes[2]->name);
        $this->assertEquals(11.11, $content->data->headings[1]->dishes[2]->price);

        $this->assertEquals('Desserts', $content->data->headings[2]->name);

        $this->assertEquals('Chocolate ice cream', $content->data->headings[2]->dishes[0]->name);
        $this->assertEquals(3.80, $content->data->headings[2]->dishes[0]->price);

        $this->assertEquals('Orange juice', $content->data->headings[2]->dishes[1]->name);
        $this->assertEquals(2.10, $content->data->headings[2]->dishes[1]->price);

        $this->assertEquals('Carrot cake', $content->data->headings[2]->dishes[2]->name);
        $this->assertEquals(4.85, $content->data->headings[2]->dishes[2]->price);
    }
}
