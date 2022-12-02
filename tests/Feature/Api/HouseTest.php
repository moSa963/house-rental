<?php

namespace Tests\Feature\Api;

use App\Models\House;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class HouseTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_get_list_of_houses()
    {
        $response = $this->get('/api/house');

        $response->assertStatus(200);
    }

    public function test_user_can_get_a_house_informations()
    {
        $user = User::factory()->create();

        $house = House::factory()->create([
            "user_id" => $user->id,
        ]);

        $response = $this->get('/api/house/'.$house->id);

        $response->assertStatus(200);
    }

    public function test_user_can_store_a_new_house()
    {
        $user = User::factory()->create();

        $house = House::factory()->make([
            "user_id" => $user->id,
        ]);

        $user = Sanctum::actingAs($user);

        $response = $this->post('/api/house', $house->toArray());

        $response->assertStatus(201);
    }

    public function test_user_can_update_a_house_data()
    {
        $user = User::factory()->create();

        $house = House::factory()->create([ "user_id" => $user->id ]);

        $new_house_data = House::factory()->create([ "user_id" => $user->id ]);

        $user = Sanctum::actingAs($user);

        $response = $this->post('/api/house/'.$house->id, $new_house_data->toArray());

        $response->assertStatus(200);
        $response->assertJsonPath("data.name", $new_house_data->name);
    }

    public function test_user_can_check_if_a_house_available_between_two_dates()
    {
        $user = User::factory()->create();

        $house = House::factory()->create([ "user_id" => $user->id ]);

        $start_date = Carbon::tomorrow();
        $end_date = Carbon::tomorrow()->addDays(15);

        $response = $this->get('/api/house/'.$house->id."/check/".$start_date->format("Y-m-d")."/".$end_date->format("Y-m-d"));

        $response->assertStatus(200);
        $response->assertJsonPath("available", true);
    }
}
