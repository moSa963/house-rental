<?php

namespace Database\Factories;

use App\Models\House;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contract>
 */
class ContractFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'house_id' => House::factory()->create()->id,
            'user_id' => User::factory()->create()->id,
            'guests' => $this->faker->numberBetween(1, 10),
            'start_date' => Carbon::today()->format("Y-m-d"),
            'end_date' => Carbon::today()->addDays(15)->format("Y-m-d"),
            'total_price' => $this->faker->numberBetween(10, 1000),
            'confirmed' => false,
        ];
    }
}
