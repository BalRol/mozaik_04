<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Event;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;
    public function testShowUser()
    {
        $user = User::factory()->create();
        $this->withCookie('user', $user->id);

        $response = $this->get('/user');
        $response->assertStatus(200);
        $response->assertJson([
             'user' => [
                 'id' => $user->id,
                 'username' => $user->username,
                 'email' => $user->email,
                 'image' => $user->image,
             ],
         ]);

    }

    public function testUpdateUser()
    {
        $user = User::factory()->create();
        $this->withCookie('user', $user->id);
        $response = $this->post('/_user', [
                 'name' => $user->username,
                 'email' => $user->email,
                 'oldPassword' => $user->password,
                 'newPassword' => 'Jelszo',
        ]);

        $response->assertStatus(200);

        $response->assertJson(['message' => 10]);
        $this->assertDatabaseHas('user', [
            'username' => $user->username,
            'email' => $user->email,
        ]);
    }

    public function testCreateUser()
    {
        $response = $this->post('/user', [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'pwd' => 'password',
        ]);

        $response->assertStatus(200)
            ->assertJson(['message' => 0]);

        $this->assertDatabaseHas('user', [
            'username' => 'Test User',
            'email' => 'testuser@example.com',
        ]);
    }
}
