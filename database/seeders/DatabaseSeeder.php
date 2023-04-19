<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Briedis',
            'email' => 'briedis@gmail.com',
            'password' => Hash::make('123'),
        ]);
        
        $faker = Faker::create('lt_LT');

        foreach(range(1, 20) as $_) {
            DB::table('clients')->insert([
                'name' => $faker->firstName,
                'surname' => $faker->lastName,
                'personal_code' => rand(10000000000, 99999999999),
                'acc_number' => 'LT' . rand(0, 9) . rand(0, 9) . ' ' . '0014' . ' ' . '7' . rand(0, 9) . rand(0, 9) . rand(0, 9) . ' ' . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9)  . ' ' . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9),
                'acc_balance'=> "0",
            ]);
        }


        $p = ['Batai', 'Pica', 'Drugelis', 'Antis', 'Geltoni šortai', 'Stulpas, medinis, 5m',
        'Guminukai', 'Bananai', 'Laidinė pelė', 'Ausinės', 'Kepurė', 'Padangos'];

        foreach(range(1, 100) as $_) {
            DB::table('orders')->insert([
                'title' => $p[rand(0, count($p) - 1)],
                'price' => rand(10, 1000) / 100,
                'client_id' => rand(1, 20),
            ]);
        }
    }
}