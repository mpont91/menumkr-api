<?php

namespace Tests\Feature\Menu;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class MenuUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_menu_update(): void
    {
        $user = User::factory()->has(Menu::factory()->count(5))->create();
        Sanctum::actingAs($user);

        $menu = $user->menus->first();

        $request = ['name' => 'Changing the name!'];

        $response = $this->putJson('/api/menus/' . $menu->id, $request);

        $response->assertNoContent();
    }

    public function test_menu_update_invalid_request(): void
    {
        $user = User::factory()->has(Menu::factory()->count(5))->create();
        Sanctum::actingAs($user);

        $menu = $user->menus->first();

        $request = ['invalid' => 'Changing the name!'];

        $response = $this->putJson('/api/menus/' . $menu->id, $request);

        $response->assertStatus(422);
    }
}
