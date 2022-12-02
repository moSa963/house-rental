<?php

namespace Tests\Feature\Api;

use App\Models\House;
use App\Models\HouseFeature;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class HouseFeatureTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_user_can_add_house_features()
    {
        $user = User::factory()->create();

        $house = House::factory()->create([ "user_id" => $user->id ]);

        $data = [
            "feature" => [
                $this->faker()->sentence(),
                $this->faker()->sentence(),
                $this->faker()->sentence(),
                $this->faker()->sentence(),
            ]
        ];

        Sanctum::actingAs($user);

        $response = $this->post('/api/house/'.$house->id.'/feature', $data);

        $response->assertSuccessful();
        $response->assertJsonCount(4, "data");
    }

    public function test_user_can_delete_house_feature()
    {
        $user = User::factory()->create();

        $house = House::factory()->create([ "user_id" => $user->id ]);

        $feature = HouseFeature::factory()->create([
            "house_id" => $house->id,
        ]);

        Sanctum::actingAs($user);

        $response = $this->delete('/api/house/'.$house->id.'/feature/'.$feature->id);

        $response->assertSuccessful();
    }

    public function test_user_can_not_delete_house_feature_if_it_does_not_belong_to_the_house()
    {
        $user = User::factory()->create();

        $house = House::factory()->create([ "user_id" => $user->id ]);
        $house2 = House::factory()->create([ "user_id" => $user->id ]);

        $feature = HouseFeature::factory()->create([
            "house_id" => $house->id,
        ]);

        Sanctum::actingAs($user);

        $response = $this->delete('/api/house/'.$house2->id.'/feature/'.$feature->id);

        $response->assertNotFound();
    }
}
