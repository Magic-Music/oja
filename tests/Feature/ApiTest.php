<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use DatabaseMigrations;

    public function testCreateRouteStoresUser()
    {
        $user = User::factory()->make()->toArray();
        $response = $this->postJson('api/user/create', $user);

        $response->assertStatus(200);
        $response->assertJson(['message' => "User created: " . $user['email']]);
        $this->assertDatabaseHas('users', ['email' => $user['email']]);
    }
}
