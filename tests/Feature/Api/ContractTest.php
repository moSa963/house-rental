<?php

namespace Tests\Feature\Api;

use App\Models\Contract;
use App\Models\House;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ContractTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_get_contracts_list()
    {
        $owner = User::factory()->create();

        $house = House::factory()->create([ "user_id" => $owner->id ]);

        $user = User::factory()->create();

        $user = Sanctum::actingAs($user);

        Contract::factory()->create([
            'user_id' => $user->id,
            'house_id' => $house->id,
        ]);

        $response = $this->get('/api/contract');

        $response->assertSuccessful();
    }

    public function test_user_can_get_contract_informations()
    {        
        $owner = User::factory()->create();

        $house = House::factory()->create([ "user_id" => $owner->id ]);

        $user = User::factory()->create();

        $user = Sanctum::actingAs($user);

        $contract = Contract::factory()->create([
            'user_id' => $user->id,
            'house_id' => $house->id,
        ]);

        $response = $this->get('/api/contract/'.$contract->id);

        $response->assertSuccessful();
    }

    public function test_user_can_create_a_new_contract()
    {
        $house_owner = User::factory()->create();

        $house = House::factory()->create([ "user_id" => $house_owner->id ]);

        $user = User::factory()->create();

        $user = Sanctum::actingAs($user);

        $data = [
            'guests' => 3,
            'start_date' => Carbon::tomorrow()->format("Y-m-d"),
            'end_date' => Carbon::tomorrow()->addDays(15)->format("Y-m-d")
        ];

        $response = $this->post('/api/house/'.$house->id."/contract", $data);

        $response->assertSuccessful();
    }

    public function test_user_can_delete_a_contract()
    {
        $owner = User::factory()->create();

        $house = House::factory()->create([ "user_id" => $owner->id ]);

        $user = User::factory()->create();

        $user = Sanctum::actingAs($user);

        $contract = Contract::factory()->create([
            'user_id' => $user->id,
            'house_id' => $house->id,
        ]);

        $response = $this->delete('/api/contract/'.$contract->id);

        $response->assertSuccessful();
    }
}
