<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Log;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Content>
 */
class ContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::all()->random()->id,
            'date' => fake()->date(),
            'header' => fake()->sentence(),
            'metadescription' => fake()->sentence(),
            'slug' => fake()->unique()->slug(),
            'website' => fake()->randomElements(['freudefoto.de', 'berlinerphotoblog.de', 'streetphotoberlin.com'])[0],
            'text' => fake()->text(),
            'active' => 1,
        ];
    }
}
