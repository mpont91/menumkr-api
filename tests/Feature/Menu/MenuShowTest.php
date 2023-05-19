<?php

namespace Tests\Feature\Menu;

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
        $user = User::factory()->has(Menu::factory()->count(5))->create();
        Sanctum::actingAs($user);

        $menuShowSlug = $user->menus->first()->slug;

        $response = $this->get('/api/menus/' . $menuShowSlug);

        $response->assertOk();
    }

    public function test_menu_show_nonexistent(): void
    {
        $user = User::factory()->has(Menu::factory()->count(5))->create();
        Sanctum::actingAs($user);

        $response = $this->get('/api/menus/nonexistent');

        $response->assertNotFound();
    }
}
