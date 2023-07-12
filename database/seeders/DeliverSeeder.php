<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Deliver;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DeliverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $users = User::orderBy('id', 'asc')->pluck('id');
        for ($i = 0; $i < 100; $i++) {
            $deliver[$i] = Deliver::create([
                'id' => Str::uuid(),
                'lastname' => $faker->lastName,
                'firstname' => $faker->firstName,
                'phone' => $faker->numerify('########'),
                'email' => $faker->email,
                'created_by' => $faker->randomElement($users),
            ]);
        }
    }
}
