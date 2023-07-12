<?php

namespace Database\Seeders;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypeComposantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'Résistance',
            'Accompagnement',
            'Dessert',
            'Boisson',
            'Entrée',
        ];

        foreach ($types as $type) {

            DB::table('component_types')->insert([
                'id' => Str::uuid(),
                'label' => $type,
            ]);
        }

    }
}
