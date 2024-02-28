<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Bắc Báo',
                'email' => 'thannong0512@gmail.com',
                'account' => '2151170000',
                'password' => password_hash("12345678", PASSWORD_DEFAULT),
            ]
        ];
        DB::table('users')->insert($users);
    }
}
