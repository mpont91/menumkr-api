<?php

namespace Tests\Feature\Menu;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class MenuListTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_retrieve_list(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $response = $this->get('/api/menu');

        $response->assertOk();
    }
}
