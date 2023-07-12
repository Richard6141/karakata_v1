<?php

namespace Database\Seeders;

use App\Models\Domaine;
use App\Models\Product;
use App\Models\Produit;
use Illuminate\Support\Str;
use App\Models\UnitOfMeasure;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProduitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $produits = [
            array('id' => Str::uuid(),'uniteofmesure_id' => UnitOfMeasure::where('label', 'Nombre')->first()->id,'label' => 'Concombre', 'safety_stock' => '20'  ),
            array('id' => Str::uuid(),'uniteofmesure_id' => UnitOfMeasure::where('label', 'Kilogramme')->first()->id,'label' => 'Riz', 'safety_stock' => '20' ),
            array('id' => Str::uuid(),'uniteofmesure_id' => UnitOfMeasure::where('label', 'Kilogramme')->first()->id,'label' => 'Gari', 'safety_stock' => '20'  ),
            array('id' => Str::uuid(),'uniteofmesure_id' => UnitOfMeasure::where('label', 'Kilogramme')->first()->id,'label' => 'Haricot', 'safety_stock' => '20'  ),
            array('id' => Str::uuid(),'uniteofmesure_id' => UnitOfMeasure::where('label', 'Litre')->first()->id,'label' => 'Huile Rouge', 'safety_stock' => '20' ),
            array('id' => Str::uuid(),'uniteofmesure_id' => UnitOfMeasure::where('label', 'Kilogramme')->first()->id,'label' => 'Vandzou', 'safety_stock' => '20' ),
            array('id' => Str::uuid(),'uniteofmesure_id' => UnitOfMeasure::where('label', 'Litre')->first()->id,'label' => "Huile d'arachide", 'safety_stock' => '20' ),
            array('id' => Str::uuid(),'uniteofmesure_id' => UnitOfMeasure::where('label', 'Kilogramme')->first()->id,'label' => 'Soja', 'safety_stock' => '20' ),
            array('id' => Str::uuid(),'uniteofmesure_id' => UnitOfMeasure::where('label', 'Kilogramme')->first()->id,'label' => 'Sel', 'safety_stock' => '20' ),
            array('id' => Str::uuid(),'uniteofmesure_id' => UnitOfMeasure::where('label', 'Nombre')->first()->id,'label' => 'Tomates en boîte', 'safety_stock' => '20'  ),
            array('id' => Str::uuid(),'uniteofmesure_id' => UnitOfMeasure::where('label', 'Gramme')->first()->id,'label' => 'Feuilles de loriers', 'safety_stock' => '20'  ),
            array('id' => Str::uuid(),'uniteofmesure_id' => UnitOfMeasure::where('label', 'Nombre')->first()->id,'label' => 'Fanta', 'safety_stock' => '20' ),
            array('id' => Str::uuid(),'uniteofmesure_id' => UnitOfMeasure::where('label', 'Kilogramme')->first()->id,'label' => 'Sucre', 'safety_stock' => '20' ),
            array('id' => Str::uuid(),'uniteofmesure_id' => UnitOfMeasure::where('label', 'Nombre')->first()->id,'label' => 'Possotomè', 'safety_stock' => '20' ),
            array('id' => Str::uuid(),'uniteofmesure_id' => UnitOfMeasure::where('label', 'Nombre')->first()->id,'label' => 'Plat', 'safety_stock' => '20' ),
            array('id' => Str::uuid(),'uniteofmesure_id' => UnitOfMeasure::where('label', 'Nombre')->first()->id,'label' => 'Fourchette', 'safety_stock' => '20' ),
            array('id' => Str::uuid(),'uniteofmesure_id' => UnitOfMeasure::where('label', 'Nombre')->first()->id,'label' => 'Cuillère', 'safety_stock' => '20' ),
            array('id' => Str::uuid(),'uniteofmesure_id' => UnitOfMeasure::where('label', 'Nombre')->first()->id,'label' => 'Plat jetable', 'safety_stock' => '20' ),
            array('id' => Str::uuid(),'uniteofmesure_id' => UnitOfMeasure::where('label', 'Nombre')->first()->id,'label' => 'Emballage', 'safety_stock' => '20' ),
        ];

        foreach ($produits as $key => $value) {
            $packs =  Product::create(['id' => Str::uuid(),'uniteofmesure_id' => $value['uniteofmesure_id'], 'label' => $value['label'], 'safety_stock' => $value['safety_stock']]);
        }
    }
}
