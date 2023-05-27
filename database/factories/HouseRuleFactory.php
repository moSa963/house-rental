<?php

namespace Database\Factories;

use App\Models\House;
use App\Models\HouseRule;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HouseRule>
 */
class HouseRuleFactory extends Factory
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
            'rule' => $this->faker->sentence(),
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (HouseRule $house_rule) {
            if ($house_rule->house_id == 0)
            {
                $house_rule->house_id = House::factory()->create()->id;
            }
        });
    }
}
