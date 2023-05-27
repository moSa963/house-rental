<?php

namespace Database\Factories;

use App\Models\House;
use App\Models\HouseReview;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HouseReview>
 */
class HouseReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 0,
            'house_id' => 0,
            'comment' => $this->faker->sentence(),
            'rating' => $this->faker->numberBetween(1, 5),
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (HouseReview $review) {
            if ($review->house_id == 0)
            {
                $review->house_id = House::factory()->create()->id;
            }

            if ($review->user_id == 0)
            {
                $review->user_id = User::factory()->create()->id;
            }
        });
    }
}
