<?php

namespace Tests\Feature\Api;

use App\Models\Contract;
use App\Models\House;
use App\Models\HouseReview;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class HouseReviewTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_user_can_get_list_of_a_house_reviews()
    {
        $user = User::factory()->create();

        $house = House::factory()->create([ "user_id" => $user->id ]);
        
        HouseReview::factory()->times(5)->create([
            'house_id' => $house->id,
        ]);

        $response = $this->get('/api/house/'.$house->id.'/review/list');

        $response->assertSuccessful();
    }

    
    public function test_user_can_get_his_own_review_of_a_house()
    {
        $owner = User::factory()->create();
        $user = User::factory()->create();

        $house = House::factory()->create([ "user_id" => $owner->id ]);
        
        $review = HouseReview::factory()->create([
            'house_id' => $house->id,
            'user_id' => $user->id,
        ]);

        Sanctum::actingAs($user);

        $response = $this->get('/api/house/'.$house->id.'/review');

        $response->assertSuccessful();
        $response->assertJsonPath("data.house_id", $review->house_id);
        $response->assertJsonPath("data.user.id", $review->user_id);
        $response->assertJsonPath("data.comment", $review->comment);
    }

    public function test_user_can_review_a_house()
    {
        $owner = User::factory()->create();
        $user = User::factory()->create();

        $house = House::factory()->create([ "user_id" => $owner->id ]);

        $contract = Contract::factory()->create([
            'user_id' => $user->id,
            'house_id' => $house->id,
            "confirmed" => true,
        ]);

        $data = [
            'comment' => $this->faker->sentence(1),
            'rating' => 3,
        ];

        Sanctum::actingAs($user);

        $response = $this->post('/api/house/'.$house->id.'/review', $data);

        $response->assertSuccessful();
    }

    public function test_user_can_not_review_a_house_if_he_did_not_rent_it_before()
    {
        $owner = User::factory()->create();
        $user = User::factory()->create();

        $house = House::factory()->create([ "user_id" => $owner->id ]);

        $data = [
            'comment' => $this->faker->sentence(),
            'rating' => 3,
        ];

        Sanctum::actingAs($user);

        $response = $this->post('/api/house/'.$house->id.'/review', $data);

        $response->assertForbidden();
    }
}
