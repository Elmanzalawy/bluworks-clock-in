<?php

namespace Database\Factories;

use App\Models\Worker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClockIn>
 */
class ClockInFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'worker_id' => Worker::exists() ? Worker::inRandomOrder()->first()->id : Worker::factory()->create(),
            'latitude' => fake()->latitude(),
            'longitude' => fake()->longitude(),
            'timestamp' => fake()->unixTime()
        ];
    }
}
