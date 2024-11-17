<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        $this->call(TimePeriod::class);
        \App\Models\Spot::factory(10)->create();

        \App\Models\SuspiciousReport::factory(10)->create();
        \App\Models\SuspiciousReportComment::factory(10)->create();
        \App\Models\SuspiciousReportImage::factory(10)->create();
        \App\Models\IncidentReport::factory(10)->create();
        \App\Models\IncidentReportComment::factory(10)->create();
        \App\Models\IncidentReportImage::factory(10)->create();
        \App\Models\SafetyReport::factory(10)->create();
        \App\Models\SafetyReportComment::factory(10)->create();
        \App\Models\SafetyReportImage::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
