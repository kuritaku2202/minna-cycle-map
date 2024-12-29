<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use DateTime;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'テストユーザー',
                'email' => 'example@example.com',
                'password' => Hash::make('password'),
                'introduction'=>'テストユーザー(一般利用者)です。',
                'icon_url'=>'',
                'administrator'=>1,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'deleted_at'=>null
            ]
        ]);
    }
}
