<?php

namespace Tests\Feature\Api;

use App\Models\House;
use App\Models\HouseRule;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class HouseRuleTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_user_can_add_house_rules()
    {
        $user = User::factory()->create();

        $house = House::factory()->create([ "user_id" => $user->id ]);

        $data = [
            "rule" => [
                $this->faker()->sentence(),
                $this->faker()->sentence(),
                $this->faker()->sentence(),
                $this->faker()->sentence(),
            ]
        ];

        Sanctum::actingAs($user);
        
        $response = $this->post('/api/house/'.$house->id.'/rule', $data);
        $response->assertSuccessful();
        $response->assertJsonCount(4, "data");
    }

    public function test_user_can_delete_house_rule()
    {
        $user = User::factory()->create();

        $house = House::factory()->create([ "user_id" => $user->id ]);

        $rule = HouseRule::factory()->create([
            "house_id" => $house->id,
        ]);

        Sanctum::actingAs($user);

        $response = $this->delete('/api/house/'.$house->id.'/rule/'.$rule->id);

        $response->assertSuccessful();
    }
}
