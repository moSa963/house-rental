<?php

namespace Database\Factories;

use App\Models\House;
use App\Models\HouseFeature;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HouseFeature>
 */
class HouseFeatureFactory extends Factory
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
            'feature' => $this->faker->sentence(),
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (HouseFeature $house_feature) {
            if ($house_feature->house_id == 0)
            {
                $house_feature->house_id = House::factory()->create()->id;
            }
        });
    }
}
