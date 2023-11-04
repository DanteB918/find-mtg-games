<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Games>
 */
class GamesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'power_level' => fake()->randomNumber(1),
            'format' => Str::random(10),
            'description' => fake()->text(),
            'status' => 1,
            'state' => 'DE',
            'country' => fake()->country(),
            'number_players' => fake()->randomNumber(1),
            'date' => now()->addCentury(),
            'time' => fake()->time(),
        ];
    }
}
