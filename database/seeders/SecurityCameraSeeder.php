<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class SecurityCameraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('security_cameras')->insert([
            'status' => '不明',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('security_cameras')->insert([
            'status' => 'あり',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('security_cameras')->insert([
            'status' => 'なし',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

    }
}
