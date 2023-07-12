<?php

namespace Database\Seeders;

use App\Models\Etat;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EtatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $etats = array(
            array('id' => Str::uuid(), 'label' => 'Bon'),
            array('id' => Str::uuid(), 'label' => 'HS'),
            array('id' => Str::uuid(), 'label' => 'Expiré'),
            array('id' => Str::uuid(), 'label' => 'Moyen'),
        );
        foreach ($etats as $key => $value) {
            $etats =  Etat::create(['id' => Str::uuid(),'label' => $value['label']]);
        }
    }
}
