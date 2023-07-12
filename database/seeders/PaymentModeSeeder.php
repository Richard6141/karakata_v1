<?php

namespace Database\Seeders;

use App\Models\PayementMode;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaymentModeSeeder extends Seeder
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
        $modes = [
            'Espèce',
            'Mobile Monney',
            'Ticket',
            'Compte Top Food',
        ];
        foreach ($modes as $mode) {
            PayementMode::create([
                'id' => Str::uuid(),
                'label' => $mode,
                'created_by' => $faker->randomElement($users)
            ]);
        }
    }
}
