<?php

namespace Database\Factories;

use App\Models\House;
use App\Models\HouseImage;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HouseImage>
 */
class HouseImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $name = $this->faker->image(Storage::path("house/images"));
        $name = explode("\\", $name);
        $name = array_pop($name);
        
        return [
            'house_id' => 0,
            'name' => "house/images/{$name}",
        ];
    }


    public function configure()
    {
        return $this->afterMaking(function (HouseImage $image) {
            if ($image->house_id == 0)
            {
                $image->house_id = House::factory()->create()->id;
            }
        });
    }
}
