<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_get_logged_in_user_informations()
    {
        $user = User::factory()->create();

        $user = Sanctum::actingAs($user);

        $response = $this->get('/api/user');

        $response->assertSuccessful();
    }

    public function test_user_can_get_profile_image()
    {
        $user = User::factory()->create();

        $response = $this->get('/api/user/'.$user->username.'/image');

        $response->assertRedirect();
    }

    public function test_user_can_update_profile_image()
    {
        $user = User::factory()->create();

        $user = Sanctum::actingAs($user);

        $data = [
            "image" => UploadedFile::fake()->image("avatar.png")
        ];

        $response = $this->post('/api/user', $data);

        $path = 'users/'.$user->username;

        $response->assertSuccessful();
        $this->assertTrue(Storage::exists($path));
    }
}
