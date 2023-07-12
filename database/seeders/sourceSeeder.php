<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Source;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class sourceSeeder extends Seeder
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
        $sources = [
            'Appel',
            'WhatsApp',
            'Application eFOOD',
        ];
        foreach ($sources as $source) {
            Source::create([
                'id' => Str::uuid(),
                'label' => $source,
                'created_by' => $faker->randomElement($users)
            ]);
        }
    }
}
