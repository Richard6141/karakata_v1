<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\CuisineProvision;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CuisineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $cuisine = [
            [
                'id' => Str::uuid(),
                'purchase_date' => '12/08/2022',
                'label' => 'Tomate',
                'quantity' => '500',
                'amount' => '50000 FCFA',

            ],

            [
                'id' => Str::uuid(),
                'purchase_date' => '12/08/2022',
                'label' => 'Poivre',
                'quantity' => '50',
                'amount' => '1000 FCFA',

            ],

            [
                'id' => Str::uuid(),
                'purchase_date' => '12/08/2022',
                'label' => 'Huile',
                'quantity' => '50',
                'amount' => '75000 FCFA',
            ],

            [
                'id' => Str::uuid(),
                'purchase_date' => '12/08/2022',
                'label' => 'Piment',
                'quantity' => '200',
                'amount' => '20000 FCFA',
            ],

            [
                'id' => Str::uuid(),
                'purchase_date' => '12/08/2022',
                'label' => 'Poisson',
                'quantity' => '70',
                'amount' => '80000 FCFA',

            ],

            [
                'id' => Str::uuid(),
                'purchase_date' => '12/08/2022',
                'label' => 'Viande de poulet',
                'quantity' => '80',
                'amount' => '80000 FCFA',

            ],

            [
                'id' => Str::uuid(),
                'purchase_date' => '12/08/2022',
                'label' => 'Sel',
                'quantity' => '50',
                'amount' => '5000 FCFA',

            ],

            [
                'id' => Str::uuid(),
                'purchase_date' => '12/08/2022',
                'label' => 'Oignon',
                'quantity' => '100',
                'amount' => '35000 FCFA',

            ],

            [
                'id' => Str::uuid(),
                'purchase_date' => '12/08/2022',
                'label' => 'Fromage',
                'quantity' => '150',
                'amount' => '60000 FCFA',

            ],

            [
                'id' => Str::uuid(),
                'purchase_date' => '12/08/2022',
                'label' => 'Banane',
                'quantity' => '150',
                'amount' => '60000 FCFA',

            ],

        ];

        foreach ($cuisine as $key => $value) {
            $cuisine =  CuisineProvision::create(
                [
                    'id' => Str::uuid(),
                    'purchase_date' => $value['purchase_date'],
                    'label' => $value['label'],
                    'quantity' => $value['quantity'],
                    'amount' => $value['amount'],

                ]);
        }

    }
}
