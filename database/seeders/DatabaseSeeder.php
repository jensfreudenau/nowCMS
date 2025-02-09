<?php

namespace Database\Seeders;

use App\Models\Journey;
use App\Models\User;
use Exception;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * @throws Exception
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Journey::factory()->create([
            'id' => 11,
            'name_of_route' => 'mit gps',
            'start_date' => fake()->date(),
            'description' => fake()->sentence(),
            'slug' => 'mit-gps',
            'user_id' => 1,
        ]);
        Journey::factory()->create([
            'id' => 10,
            'name_of_route' => 'ohne gps',
            'start_date' => fake()->date(),
            'description' => fake()->sentence(),
            'slug' => 'ohne-gps',
            'user_id' => 1,
        ]);
        $this->call([
            CategorySeeder::class,
            UserSeeder::class,
            ContentSeeder::class,
            JourneySeeder::class,
            MediaSeeder::class,
        ]);
    }
}
