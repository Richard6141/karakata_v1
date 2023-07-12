<?php

namespace Database\Seeders;

use App\Models\Unite;
// use App\Models\Unitemesure;
use Illuminate\Support\Str;
use App\Models\UnitOfMeasure;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UniteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $types = [
            'Kilogramme',
            'Gramme',
            'Litre',
            'Mètre',
            'Nombre',
        ];

        foreach ($types as $type) {

            DB::table('unit_of_measures')->insert([
                'id' => Str::uuid(),
                'label' => $type,
            ]);
        // $unites = array(
        //     array('id' => Str::uuid(), 'label' => 'Kilogramme'),
        //     array('id' => Str::uuid(), 'label' => 'Gramme'),
        //     array('id' => Str::uuid(), 'label' => 'Litre'),
        //     array('id' => Str::uuid(), 'label' => 'Mètre'),
        //     array('id' => Str::uuid(), 'label' => 'Nombre'),
        // );
        // foreach ($unites as $key => $value) {
        //     $unites =  UnitOfMeasure::create(['id' => Str::uuid(),'label' => $value['label']]);
        // }
    }
}
}