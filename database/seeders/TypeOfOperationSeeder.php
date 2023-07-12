<?php

namespace Database\Seeders;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypeOfOperationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $TypeOfOperations = [
            'Entrée',
            'Sortie',
            'Inventaire',
        ];

        foreach ($TypeOfOperations as $TypeOfOperation) {

            DB::table('operation_types')->insert([
                'id' => Str::uuid(),
                'label' => $TypeOfOperation,
            ]);
        }

    }
}
