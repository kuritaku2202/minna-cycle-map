<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SuspiciousReportComment>
 */
class SuspiciousReportCommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 10), // Userに紐付け
            'suspicious_report_id' => $this->faker->numberBetween(1, 10), // Spotに紐付け
            'body' => $this->faker->text(200), // 200文字以内の内容
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'), // 過去1年以内
            'updated_at' => $this->faker->dateTimeBetween('-1 month', 'now'), // 過去1ヶ月以内
        ];
    }
}
