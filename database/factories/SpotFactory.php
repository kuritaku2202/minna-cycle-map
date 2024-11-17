<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Spot>
 */
class SpotFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(), // 場所の名前
            'latitude' => $this->faker->latitude(), // 緯度
            'longitude' => $this->faker->longitude(), // 経度
            'address' => $this->faker->address(),
        ];
    }
}
