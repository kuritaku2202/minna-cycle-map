<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SafetyReportImage>
 */
class SafetyReportImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'safety_report_id' => $this->faker->numberBetween(1, 10), // Spotに紐付け
            'image_url' => $this->faker->url(),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'), // 過去1年以内
            'updated_at' => $this->faker->dateTimeBetween('-1 month', 'now'), // 過去1ヶ月以内
        ];
    }
}
