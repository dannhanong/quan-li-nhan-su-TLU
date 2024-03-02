<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 20) as $index) {
            $pass = $faker->password();
            DB::table('users')->insert([
                'name' => $faker->name(),
                'email' => $faker->email(),
                'account' => $faker->word(),
                'password' => password_hash($pass, PASSWORD_DEFAULT),
            ]);
        }
    }
}
