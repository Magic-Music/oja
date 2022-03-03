<?php

namespace Tests\Feature;

use App\Repositories\UserRepositoryInterface;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Tests\TestCase;
use App\Models\User;

class UserRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    public function testItStoresNewUserData()
    {
        $repository = App::make(UserRepositoryInterface::class);
        $userData = User::factory()->make()->toArray();
        $repository->storeUser($userData);

        $this->assertDatabaseHas('users', $userData);
    }

    public function testItRetrievesUserData()
    {
        $repository = App::make(UserRepositoryInterface::class);
        $userData = User::factory()->create();
        $user = $repository->getUser($userData->email);

        $this->assertEquals($userData->name, $user->name);
    }

    public function testItReturnsNullForNonExistentEmail()
    {
        $repository = App::make(UserRepositoryInterface::class);

        $this->assertNull($repository->getUser('non-existant.user@example.com'));
    }

    public function testItReturnsAllUsers()
    {
        $repository = App::make(UserRepositoryInterface::class);
        User::factory(3)->create();

        $this->assertEquals(3, $repository->getAllUsers()->count());
    }
}
