<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Produit;
use App\Models\Operation;
use App\Models\OperationType;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OperationSeeder extends Seeder
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
        $produits = Product::orderBy('id', 'asc')->pluck('id');
        $operations_types = OperationType::orderBy('id', 'asc')->pluck('id');
        if ($operations_types == OperationType::where('label', 'Sortie')->pluck('id')) {
            // $lastOne = DB::table('operation')->latest('id')->first();
            $lastone = Operation::orderBy('created_at', 'desc')->first();
            // $theoricquantity = $lastone->
        }

        for ($i = 0; $i < 100; $i++) {
            $operation[$i] = Operation::create([
                'id' => Str::uuid(),
                'produit_id' => $faker->randomElement($produits),
                'operation_type_id' => $faker->randomElement($operations_types),
                'quantity' => $faker->randomNumber($nbDigits = null),
                'price' => $faker->randomNumber($nbDigits = null),
                'label' => $faker->text(15),
                'observation' => $faker->text(50),
                'date_operation' => $faker->dateTimeBetween('now', '+2 months'), 
                'created_by' => $faker->randomElement($users),
            ]);
        }
    }
}
