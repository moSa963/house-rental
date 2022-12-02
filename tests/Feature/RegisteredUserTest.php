<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisteredUserTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_user_can_login_session()
    {
        $user = User::factory()->create();

        $data = [
            "username" => $user->username,
            "password" => "password",
        ];

        $response = $this->post('/login',  $data);

        $response->assertStatus(200);
    }
}
