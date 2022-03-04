<?php

namespace Tests\Feature;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use DatabaseMigrations;

    public function testCreateRouteStoresUser()
    {
        $user = User::factory()->make()->toArray();
        $response = $this->postJson('api/user/create', $user);

        $response->assertStatus(201);
        $response->assertJson(['message' => "User created: " . $user['email']]);
        $this->assertDatabaseHas('users', ['email' => $user['email']]);
    }

    public function testMissingEmailFails()
    {
        $user = User::factory()->make()->toArray();
        unset($user['email']);
        $response = $this->postJson('api/user/create', $user);

        $response->assertStatus(422);
        $response->assertJson(['message' => "The email field is required."]);
    }

    public function testMissingPasswordFails()
    {
        $user = User::factory()->make()->toArray();
        unset($user['password']);
        $response = $this->postJson('api/user/create', $user);

        $response->assertStatus(422);
        $response->assertJson(['message' => "The password field is required."]);
    }

    public function testShortPasswordFails()
    {
        $user = User::factory()->make()->toArray();
        $user['password'] = '123aA';
        $response = $this->postJson('api/user/create', $user);

        $response->assertStatus(422);
        $response->assertJson(['message' => "The password must be at least 8 characters."]);
    }

    public function testInvalidPasswordFails()
    {
        $user = User::factory()->make()->toArray();
        $user['password'] = '12345678';
        $response = $this->postJson('api/user/create', $user);

        $response->assertStatus(422);
        $response->assertJson(['message' => "The password must contain at least one uppercase letter, one lowercase letter and one number."]);

        $user['password'] = '1234aaaa';
        $response = $this->postJson('api/user/create', $user);

        $response->assertStatus(422);
        $response->assertJson(['message' => "The password must contain at least one uppercase letter, one lowercase letter and one number."]);

        $user['password'] = '1234AAAA';
        $response = $this->postJson('api/user/create', $user);

        $response->assertStatus(422);
        $response->assertJson(['message' => "The password must contain at least one uppercase letter, one lowercase letter and one number."]);

        $user['password'] = 'aaaaAAAA';
        $response = $this->postJson('api/user/create', $user);

        $response->assertStatus(422);
        $response->assertJson(['message' => "The password must contain at least one uppercase letter, one lowercase letter and one number."]);
    }

    public function testItRetrievesUserData()
    {
        $userData = User::factory()->create();
        $result = $this->getJson('api/user/' . $userData->email);

        $result->assertStatus(200);
        $result->assertJson(['name' => $userData->name]);
    }

    public function testItFailsForNonExistentUser()
    {
        $result = $this->getJson('api/user/test@example.com');

        $result->assertStatus(404);
        $result->assertJson(['message' => 'User with email address test@example.com could not be found']);
    }

    public function testItRetrievesAllUserData()
    {
        User::factory(3)->create();
        $result = $this->getJson('api/users/all');

        $result->assertStatus(200);
        $result->assertJsonCount(3);
    }

    public function testItFailssAllUserDataWhenNoUserExist()
    {
        $result = $this->getJson('api/users/all');

        $result->assertStatus(404);
        $result->assertJson(['message' => 'No users were found']);
    }
}
