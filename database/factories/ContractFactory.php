<?php

namespace Database\Factories;

use App\Models\Contract;
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
            'house_id' => 0,
            'user_id' => 0,
            'guests' => $this->faker->numberBetween(1, 10),
            'start_date' => Carbon::today()->format("Y-m-d"),
            'end_date' => Carbon::today()->addDays(15)->format("Y-m-d"),
            'total_price' => $this->faker->numberBetween(10, 1000),
            'confirmed' => false,
        ];
    }


    public function configure()
    {
        return $this->afterMaking(function (Contract $contract) {
            if ($contract->house_id == 0)
            {
                $contract->house_id = House::factory()->create()->id;
            }

            if ($contract->user_id == 0)
            {
                $contract->user_id = User::factory()->create()->id;
            }
        });
    }
}
