<?php

namespace Tests\Feature\Api;

use App\Models\House;
use App\Models\HouseImage;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class HouseImageTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_get_house_image()
    {
        $user = User::factory()->create();

        $house = House::factory()->create([ "user_id" => $user->id ]);

        $image = HouseImage::factory()->create([ "house_id" => $house->id ]);

        $response = $this->get('/api/house/'.$house->id."/image/".$image->id);

        $response->assertSuccessful();

        Storage::delete($image->name);
    }

    public function test_user_can_upload_house_images()
    {
        $user = User::factory()->create();

        $house = House::factory()->create([ "user_id" => $user->id ]);

        $data = [
            "image" => [
                UploadedFile::fake()->image("house_image_1.png"),
                UploadedFile::fake()->image("house_image_1.png"),
                UploadedFile::fake()->image("house_image_1.png"),
            ]
        ];

        Sanctum::actingAs($user);

        $response = $this->post('/api/house/'.$house->id."/image", $data);

        $response->assertSuccessful();

        $images = $house->images;

        $images->each(function($image){
            Storage::assertExists($image->name);
            Storage::delete($image->name);
        });
    }

    public function test_user_can_delete_house_image()
    {
        $user = User::factory()->create();

        $house = House::factory()->create([ "user_id" => $user->id ]);

        $image = HouseImage::factory()->create([ "house_id" => $house->id ]);

        Sanctum::actingAs($user);

        $response = $this->delete('/api/house/'.$house->id.'/image/'.$image->id);

        $response->assertSuccessful();

        Storage::delete($image->name);
    }
}
