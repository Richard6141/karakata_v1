<?php

namespace Database\Seeders;

use App\Models\Pack;
use App\Models\Paquet;
use App\Models\Product;
use App\Models\PaquetType;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

     $pack = [
            array('id' => Str::uuid(),'paquet_type_id' => PaquetType::where('label', 'Standard Pack')->first()->id ?? null,'label' => 'Pack J1', 'component_type_id'=>'["10102730-f1bd-4a42-95db-59d6086b760c","6e2cc020-e8b9-469a-85c7-ee3ac990d4a4","89e80678-870f-405a-8a55-3748bc6fd93b","9e85650d-184f-4fd2-ba67-2b68b137c405","f6b50cf3-4c73-4e31-bdb9-5226ae97441f"]','price' => '3500','image' => '1VVVAy6TO7Q8td0sdBY9sGtc7kx3iVRmDqeyH2iJ.jpg','status' => true),
            array('id' => Str::uuid(),'paquet_type_id' => PaquetType::where('label', 'Interne Pack')->first()->id ?? null,'label' => 'Pack J1', 'component_type_id'=>'["f6b50cf3-4c73-4e31-bdb9-5226ae97441f"]','price' => '2500' ,'image' => '1VVVAy6TO7Q8td0sdBY9sGtc7kx3iVRmDqeyH2iJ.jpg' ,'status' => true),
            array('id' => Str::uuid(),'paquet_type_id' => PaquetType::where('label', 'Small Pack')->first()->id ?? null,'label' => 'Pack J2','component_type_id'=>'["f6b50cf3-4c73-4e31-bdb9-5226ae97441f"]', 'price' => '2500' ,'image' => '1VVVAy6TO7Q8td0sdBY9sGtc7kx3iVRmDqeyH2iJ.jpg','status' => true),
            array('id' => Str::uuid(),'paquet_type_id' => PaquetType::where('label', 'Salade diner Pack')->first()->id ?? null,'label' => 'Pack J4','component_type_id'=>'["f6b50cf3-4c73-4e31-bdb9-5226ae97441f"]', 'price' => '2500' ,'image' => '1VVVAy6TO7Q8td0sdBY9sGtc7kx3iVRmDqeyH2iJ.jpg','status' => true),
            array('id' => Str::uuid(),'paquet_type_id' => PaquetType::where('label', 'Birthday Pack')->first()->id ?? null,'label' => 'Pack J5', 'component_type_id'=>'["10102730-f1bd-4a42-95db-59d6086b760c","6e2cc020-e8b9-469a-85c7-ee3ac990d4a4","89e80678-870f-405a-8a55-3748bc6fd93b","9e85650d-184f-4fd2-ba67-2b68b137c405","f6b50cf3-4c73-4e31-bdb9-5226ae97441f"]','price' => '5500'  ,'image' => '1VVVAy6TO7Q8td0sdBY9sGtc7kx3iVRmDqeyH2iJ.jpg','status' => true),
        ];

        foreach ($pack as $key => $value) {
            $packs = Paquet::create(['id' => Str::uuid(),'paquet_type_id' => $value['paquet_type_id'],'component_type_id' => $value['component_type_id'],  'label' => $value['label'], 'price' => $value['price'], 'image' => $value['image'],'status' => $value['status']]);
        }

      
    }
}
