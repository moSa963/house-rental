<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\House>
 */
class HouseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id,
            'name' => $this->faker->name(),
            'country' => $this->faker->country(),
            'city' => $this->faker->city(),
            'address' => $this->faker->address(),
            'lat' => $this->faker->numberBetween(0, 1000),
            'lng' => $this->faker->numberBetween(0, 1000),
            'zip' => "11111",
            'night_cost' => $this->faker->numberBetween(100, 10000),
            'active' => true,
            'about' => $this->faker->paragraph(2),
        ];
    }
}
