<?php

namespace Tests\Unit;

use App\Models\House;
use App\Models\User;
use App\Services\HouseService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HouseServiceTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_check_a_house_is_available_to_rent()
    {
        $start_date = Carbon::today()->addDays(1);
        $end_date = Carbon::today()->addDays(7);

        $user = User::factory()->create();
        $house = House::factory()->create([ "user_id" => $user->id ]);

        $this->assertTrue(HouseService::is_available($house, $start_date, $end_date));
    }
}

