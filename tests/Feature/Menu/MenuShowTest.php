<?php

namespace Tests\Feature\Menu;

use App\Models\Currency;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class MenuShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_menu_show(): void
    {
        $currency = Currency::factory()->create();

        $user = User::factory()->has(Menu::factory(['currency_id' => $currency->id])->count(5))->create();
        Sanctum::actingAs($user);

        $menuShowSlug = $user->menus->first()->slug;

        $response = $this->getJson('/api/menus/' . $menuShowSlug);

        $response->assertOk();
    }

    public function test_menu_show_nonexistent(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $response = $this->getJson('/api/menus/nonexistent');

        $response->assertNotFound();
    }
}
