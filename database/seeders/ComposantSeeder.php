<?php

namespace Database\Seeders;

use App\Models\Pack;
use App\Models\Component;
use App\Models\Composants;
use Illuminate\Support\Str;
use App\Models\ComponentType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ComposantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $composant = [
            array('id' => Str::uuid(),'component_type_id' => ComponentType::where('label', 'Résistance')->first()->id ?? null,'label' => trim('Légume + poisson fumé'), 'description' => 'Owatindjan mélanger à oignon','image' => 'image1.jpeg'),
            array('id' => Str::uuid(),'component_type_id' => ComponentType::where('label', 'Dessert')->first()->id ?? null,'label' => trim('Yaout végétal'), 'description' => 'salade russe' ,'image' => 'image1.jpeg'),
            array('id' => Str::uuid(),'component_type_id' => ComponentType::where('label', 'Dessert')->first()->id ?? null,'label' => trim('fétri gboman'), 'description' => 'légume' ,'image' => 'image1.jpeg' ),
            array('id' => Str::uuid(),'component_type_id' => ComponentType::where('label', 'Dessert')->first()->id ?? null,'label' => trim('poulet au four'), 'description' => 'poulet roti' ,'image' => 'image1.jpeg' ),
            array('id' => Str::uuid(),'component_type_id' => ComponentType::where('label', 'Boisson')->first()->id ?? null,'label' => trim('Jus orange'), 'description' => 'Jus naturel' ,'image' => 'image1.jpeg' ),
            array('id' => Str::uuid(),'component_type_id' => ComponentType::where('label', 'Résistance')->first()->id ?? null,'label' => trim('sauce au poisson'), 'description' => 'Poisson de mer' ,'image' => 'image1.jpeg'),
            array('id' => Str::uuid(),'component_type_id' => ComponentType::where('label', 'Boisson')->first()->id ?? null,'label' => trim("Bissape"), 'description' => 'Bissape naturel' ,'image' => 'image1.jpeg'),
            array('id' => Str::uuid(),'component_type_id' => ComponentType::where('label', 'Entrée')->first()->id ?? null,'label' => trim('salade coloré'), 'description' => 'salade coloré' ,'image' => 'image1.jpeg'),
            array('id' => Str::uuid(),'component_type_id' => ComponentType::where('label', 'Entrée')->first()->id ?? null,'label' => trim('Salade composé'), 'description' => 'Yaout naturel ' ,'image' => 'image1.jpeg'),
            array('id' => Str::uuid(),'component_type_id' => ComponentType::where('label', 'Résistance')->first()->id ?? null,'label' => trim('Frites au poulet'), 'description' => 'poulet + frittes'  ,'image' => 'image1.jpeg'),
            array('id' => Str::uuid(),'component_type_id' => ComponentType::where('label', 'Accompagnement')->first()->id ?? null,'label' => trim('Pain'), 'description' => 'haricot'  ,'image' => 'image1.jpeg'),
            array('id' => Str::uuid(),'component_type_id' => ComponentType::where('label', 'Entrée')->first()->id ?? null,'label' => trim('Entrée chaude'), 'description' => 'Moyo' ,'image' => 'image1.jpeg'),
            array('id' => Str::uuid(),'component_type_id' => ComponentType::where('label', 'Résistance')->first()->id ?? null,'label' => trim('Viande de cochon + piron rouge'), 'description' => 'Bien fait' ,'image' => 'image1.jpeg'),
            array('id' => Str::uuid(),'component_type_id' => ComponentType::where('label', 'Résistance')->first()->id ?? null,'label' => trim('Sauce crincrin + telibor'), 'description' => 'sauce' ,'image' => 'image1.jpeg'),
            array('id' => Str::uuid(),'component_type_id' => ComponentType::where('label', 'Résistance')->first()->id ?? null,'label' => trim('Dame de poisson + atékê'), 'description' => 'atiékê' ,'image' => 'image1.jpeg'),
            array('id' => Str::uuid(),'component_type_id' => ComponentType::where('label', 'Accompagnement')->first()->id ?? null,'label' => trim('Jadinière de légume'), 'description' => 'viande et sauce' ,'image' => 'image1.jpeg'),
            array('id' => Str::uuid(),'component_type_id' => ComponentType::where('label', 'Boisson')->first()->id ?? null,'label' => trim('Jus ananas'), 'description' => 'Jus nanas' ,'image' => 'image1.jpeg'),
            array('id' => Str::uuid(),'component_type_id' => ComponentType::where('label', 'Résistance')->first()->id ?? null,'label' => trim('Atékê + Alloco'), 'description' => 'Hricot' ,'image' => 'image1.jpeg'),
        ];

        foreach ($composant as $key => $value) {


            $composants =  Component::create(['id' => Str::uuid(),'component_type_id' => $value['component_type_id'], 'label' => $value['label'], 'description' => $value['description'], 'image' => $value['image']]);
        }

    }
}
