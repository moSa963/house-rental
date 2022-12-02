<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register()
    {
        $user = User::factory()->make();

        $data = [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'username' => $user->username,
            'email' => $user->email,
            'password' => "password",
            'password_confirmation' => "password",
        ];

        $response = $this->post('/api/register', $data);

        $response->assertSuccessful();
        $response->assertJsonPath("data.user.username", $user->username);
    }

    public function test_user_can_login()
    {
        $user = User::factory()->create();

        $data = [
            "username" => $user->username,
            "password" => "password",
        ];

        $response = $this->post('/api/login',  $data);

        $response->assertSuccessful();
        $response->assertJsonPath("data.user.username", $user->username);
    }

    public function test_user_can_logout()
    {
        $user = User::factory()->create();

        $user = Sanctum::actingAs($user);

        $response = $this->post('/api/logout');

        $response->assertSuccessful();
    }
}
