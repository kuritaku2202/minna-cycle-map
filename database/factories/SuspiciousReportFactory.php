<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SuspiciousReport>
 */
class SuspiciousReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 10),
            'spot_id' => $this->faker->numberBetween(1, 10),
            'date' => $this->faker->date(),
            'time_period_id' => $this->faker->numberBetween(1, 4),
            'description' => $this->faker->sentence(),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'), // 過去1年以内
            'updated_at' => $this->faker->dateTimeBetween('-1 month', 'now'), // 過去1ヶ月以内
        ];
    }
}
