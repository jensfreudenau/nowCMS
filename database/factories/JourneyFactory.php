<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Journey>
 */
class JourneyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name_of_route' => fake()->sentence(),
            'start_date' => fake()->date(),
            'description' => fake()->sentence(),
            'slug' => fake()->unique()->slug(),
            'user_id' => 1,
        ];
    }
}
