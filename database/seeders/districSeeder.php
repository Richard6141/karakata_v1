<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\District;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class districSeeder extends Seeder
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
            $district[$i] = District::create([
                'id' => Str::uuid(),
                'label' => $faker->city(),
                'created_by' => $faker->randomElement($users)
            ]);
        }
    }
}
