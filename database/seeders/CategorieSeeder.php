<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = array(
            array('id' => Str::uuid(), 'label' => 'Particulier'),
            array('id' => Str::uuid(), 'label' => 'Entreprise'),
        );
        foreach ($categories as $key => $value) {
            $categories =  Categorie::create(['id' => Str::uuid(),'label' => $value['label']]);
        }
    }
}
