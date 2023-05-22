<?php

namespace Tests\Feature\Customer;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CustomerShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_show(): void
    {
        $user = User::factory()->has(Menu::factory()->count(5))->create();

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
        $user = User::factory()->has(Menu::factory()->count(5))->create();
        Sanctum::actingAs($user);

        $menuShowSlug = $user->menus->first()->slug;

        $response = $this->getJson('/api/customer/' . $menuShowSlug);

        $response->assertOk();
    }
}
