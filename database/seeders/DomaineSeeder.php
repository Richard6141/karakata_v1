<?php

namespace Database\Seeders;

use App\Models\Domaine;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DomaineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $domaines = array(
            array('id' => Str::uuid(), 'label' => 'Cuisine'),
            array('id' => Str::uuid(), 'label' => 'Empaquetage'),
        );
        foreach ($domaines as $key => $value) {
            $domaines =  Domaine::create(['id' => Str::uuid(),'label' => $value['label']]);
        }
    }
}
