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
                'email' => 'gianghohiemac@gmail.com',
                'account' => '2151170000',
                'password' => password_hash("12345678", PASSWORD_DEFAULT),
            ],
            [
                'name' => 'Nam Báo',
                'email' => 'gianghohiemdoc@gmail.com',
                'account' => '2151179999',
                'role' => 1,
                'password' => password_hash("12345678", PASSWORD_DEFAULT),
            ]
        ];
        DB::table('users')->insert($users);
    }
}
