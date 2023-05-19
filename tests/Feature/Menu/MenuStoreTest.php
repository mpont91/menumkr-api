<?php

namespace Tests\Feature\Menu;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class MenuStoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_menu_store(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $request = ['name' => 'Menu MKR'];
        $response = $this->postJson('/api/menus', $request);

        $response->assertCreated();
    }

    public function test_menu_store_invalid_request(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $request = ['invalid' => 'Menu MKR'];
        $response = $this->postJson('/api/menus', $request);

        $response->assertStatus(422);
    }
}
