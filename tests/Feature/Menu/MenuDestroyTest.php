<?php

namespace Tests\Feature\Menu;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class MenuDestroyTest extends TestCase
{
    use RefreshDatabase;

    public function test_menu_destroy(): void
    {
        $user = User::factory()->has(Menu::factory()->count(5))->create();
        Sanctum::actingAs($user);

        $menuDestroyId = $user->menus->first()->id;

        $response = $this->deleteJson('/api/menus/' . $menuDestroyId);

        $response->assertNoContent();
    }

    public function test_menu_destroy_nonexistent(): void
    {
        $user = User::factory()->has(Menu::factory()->count(5))->create();
        Sanctum::actingAs($user);

        $response = $this->deleteJson('/api/menus/999999');

        $response->assertNotFound();
    }
}
