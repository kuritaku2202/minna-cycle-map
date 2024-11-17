<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class TimePeriod extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('time_periods')->insert([
            'time_slot' => '朝',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('time_periods')->insert([
            'time_slot' => '昼',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('time_periods')->insert([
            'time_slot' => '夕',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('time_periods')->insert([
            'time_slot' => '夜',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
