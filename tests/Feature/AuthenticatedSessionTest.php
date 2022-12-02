<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticatedSessionTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register_session()
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

        $response = $this->post('/register', $data);

        $response->assertStatus(200);
    }

    public function test_user_can_logout_session()
    {
        $u = User::factory()->create();

        $user = User::findOrFail($u->id);

        $response = $this->actingAs($user)->post('/logout');

        $response->assertRedirect("/");
    }
}
