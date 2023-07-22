<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Link>
 */
class LinkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'link' => $this->faker->url,
            'short_link' => $this->faker->unique()->word, // Assuming short_link needs to be unique
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'description' => $this->faker->paragraph,
            'expire_date' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d H:i:s'),
            'user_id' => 1
        ];
    }
}
