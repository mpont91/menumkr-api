<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_be_retrieved(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $response = $this->get('/api/user');

        $response->assertOk();

        $response->assertJson($user->toArray());
    }
}
