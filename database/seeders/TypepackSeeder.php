<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypepackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'Standard Pack',
            'Small Pack',
            'Birthday Pack',
            'Salade diner Pack',
            'Interne Pack',
        ];

        foreach ($types as $type) {

            DB::table('paquet_types')->insert([
                'id' => Str::uuid(),
                'label' => $type,
            ]);
        }


    }
}