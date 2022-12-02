<?php

namespace Tests\Feature\Api;

use App\Models\Contract;
use App\Models\House;
use App\Models\HouseReview;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ContractPaymentTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_user_can_pay_for_a_contract()
    {
        $owner = User::factory()->create();
        $user = User::factory()->create();

        $house = House::factory()->create([ "user_id" => $owner->id ]);
        
        $contract = Contract::factory()->create([
            'user_id' => $user->id,
            'house_id' => $house->id,
        ]);

        $data = [
            'name' => $user->first_name." ".$user->last_name,
            'card_number' => $this->faker->creditCardNumber(),
            'security_code' => "00000",
            'expiry_month' => Carbon::today()->addDays(30)->month,
            'expiry_year' => Carbon::today()->addYears(10)->month,
            'note' => $this->faker->sentence(),
        ];

        Sanctum::actingAs($user);

        $response = $this->get('/house/'.$house->id.'/contract/'.$contract->id.'/confirm', $data);

        $response->assertStatus(200);
    }
}
