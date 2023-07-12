<?php

namespace Database\Seeders;

use App\Models\Pack;
use App\Models\Source;
use App\Models\Customer;
use App\Models\Suggestion;
use Illuminate\Support\Str;
use App\Models\Type_composants;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SuggestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $suggestion = [
            array('id' => Str::uuid(),'sources_id' => Source::where('label', 'Whatsapp')->first()->id ?? null, 'preference' => 'Ablo', 'date' => '27-09-2022','custumers_id' => Customer::where('id', 'Charles')->first()->id ?? null),
            // array('id' => Str::uuid(),'sources_id' => Source::where('label', 'Appel')->first()->id ?? null,'label' => 'Pack J1', 'price' => '3000' ,'image' => 'image1.jpeg'),
            // array('id' => Str::uuid(),'sources_id' => Source::where('label', 'Appel')->first()->id ?? null,'label' => 'Pack J2', 'price' => '3500' ,'image' => 'image1.jpeg' ),
            // array('id' => Str::uuid(),'sources_id' => Source::where('label', 'Appel')->first()->id ?? null,'label' => 'Pack J3', 'price' => '25000' ,'image' => 'image1.jpeg' ),
            // array('id' => Str::uuid(),'sources_id' => Source::where('label', 'Appel')->first()->id ?? null,'label' => 'Pack J1', 'price' => '2500' ,'image' => 'image1.jpeg' ),
            // array('id' => Str::uuid(),'sources_id' => Source::where('label', 'Appel')->first()->id ?? null,'label' => 'Pack J2', 'price' => '2500' ,'image' => 'image1.jpeg'),
            // array('id' => Str::uuid(),'sources_id' => Source::where('label', 'Appel')->first()->id ?? null,'label' => "Pack J3", 'price' => '2500' ,'image' => 'image1.jpeg'),
            // array('id' => Str::uuid(),'sources_id' => Source::where('label', 'Message')->first()->id ?? null,'label' => 'Pack J4', 'price' => '2500' ,'image' => 'image1.jpeg'),
            // array('id' => Str::uuid(),'sources_id' => Source::where('label', 'Message')->first()->id ?? null,'label' => 'Pack J2', 'price' => '2500' ,'image' => 'image1.jpeg'),
            // array('id' => Str::uuid(),'sources_id' => Source::where('label', 'Whatsapp')->first()->id ?? null,'label' => 'Pack J4', 'price' => '2500'  ,'image' => 'image1.jpeg'),
            // array('id' => Str::uuid(),'sources_id' => Source::where('label', 'Message')->first()->id ?? null,'label' => 'Pack J5', 'price' => '2500'  ,'image' => 'image1.jpeg'),
            // array('id' => Str::uuid(),'sources_id' => Source::where('label', 'Whatsapp')->first()->id ?? null,'label' => 'Pack J5', 'price' => '2500' ,'image' => 'image1.jpeg'),
            // array('id' => Str::uuid(),'sources_id' => Source::where('label', 'Message')->first()->id ?? null,'label' => 'Pack J2', 'price' => '2500' ,'image' => 'image1.jpeg'),
            // array('id' => Str::uuid(),'sources_id' => Source::where('label', 'Whatsapp')->first()->id ?? null,'label' => 'Pack J3', 'price' => '3500' ,'image' => 'image1.jpeg'),
            // array('id' => Str::uuid(),'sources_id' => Source::where('label', 'Whatsapp')->first()->id ?? null,'label' => 'Pack J4', 'price' => '3500' ,'image' => 'image1.jpeg'),
            // array('id' => Str::uuid(),'sources_id' => Source::where('label', 'Whatsapp')->first()->id ?? null,'label' => 'Pack J2', 'price' => '3500' ,'image' => 'image1.jpeg'),
            // array('id' => Str::uuid(),'sources_id' => Source::where('label', 'Message')->first()->id ?? null,'label' => 'Pack J2', 'price' => '3500' ,'image' => 'image1.jpeg'),
            // array('id' => Str::uuid(),'sources_id' => Source::where('label', 'Message')->first()->id ?? null,'label' => 'Pack J3', 'price' => '3500' ,'image' => 'image1.jpeg'),
            // array('id' => Str::uuid(),'sources_id' => Source::where('label', 'Whatsapp')->first()->id ?? null,'label' => 'Pack J4', 'price' => '3500' ,'image' => 'image1.jpeg'),
        ];

        foreach ($suggestion as $key => $value) {
            $packs =  Suggestion::create(['id' => Str::uuid(),'sources_id' => $value['sources_id'], 'date' => $value['date'], 'preference' => $value['preference'], 'custumers_id' => $value['id']]);
        }

    }
}
