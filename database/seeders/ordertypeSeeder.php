<?php

namespace Database\Seeders;

use App\Models\OrderType;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ordertypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        OrderType::create([
            'id' => Str::uuid(),
            'label' => 'simple',
            'number' => 5,
        ]);

        OrderType::create([
            'id' => Str::uuid(),
            'label' => 'gros volume',
            'number' => 10,
        ]);
    }
}
