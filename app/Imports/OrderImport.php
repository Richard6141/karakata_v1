<?php

namespace App\Imports;

use Carbon\Carbon;
use NumberFormatter;
use App\Models\Order;
use App\Models\Paquet;
use App\Models\Source;
use App\Models\Contain;
use App\Models\Customer;
use App\Models\Receiver;
use App\Models\Component;
use App\Models\PaquetType;
use App\Models\PayementMode;
use App\Models\ComponentType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;

class OrderImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $records)
    {
        // $nbrow = 0;
        // set_time_limit(0);
        // $time_start = microtime(true);

        // $f = new NumberFormatter("fr", NumberFormatter::SPELLOUT);
        // $records = import_CSV($request->file);

        // DB::beginTransaction();

        // Resistance
        $typecomposantresistance = ComponentType::where('label', 'Résistance')->first();



            foreach ($records as $key => $row) {
                dd($row);
                $typepack = PaquetType::where('ancient_id', $row['type_id'])->first();
                $component1 = Component::where('ancient_id', $row['menu_id'])->where('component_type_id', $typecomposantresistance->id)->first();
                $customer = Customer::where('ancient_id', $row['client_id'])->first();
                $source = Source::where('ancient_id', $row['source_id'])->first();
                $mode = PayementMode::where('ancient_id', $row['mode_id'])->first();
                $receiver = Receiver::where('ancient_id', $row['receptionnaire_id'])->first();
                // dd($component1->id);

                $pack = new Paquet();
                $pack->date = date('Y-m-d');
                $pack->price = 0;
                $pack->paquet_type_id = $typepack->id;
                $pack->save();

                $contains1 = new Contain();
                $contains1->component_id = $component1->id;
                $contains1->paquet_id = $pack->id;
                $contains1->date = date('Y-m-d');
                $contains1->created_by = Auth::user()->id ?? null;
                $contains1->price = 2500;
                $contains1->status = false;
                $contains1->component_type_id = $typecomposantresistance->id ?? null;
                $contains1->save();


                Order::create([
                    'ancient_id' => $row['id'],
                    'date' => Carbon::parse($row['created_at'])->format('Y-m-d'),
                    'number' => $row['nbr_pack'],
                    'slip_number' => 0,
                    'total' => $row['nbr_pack'] * $contains1->price,
                    'unit_price' => $contains1->price,
                    'status_order' => false,
                    'paquet_id' => $contains1->paquet_id,
                    'address_book_id' => $customer->address->id ?? null,
                    'source_id' => $source->id,
                    'payement_mode_id' => $mode->id,
                    'customer_id' => $customer->id,
                    'receiver_id' => $receiver->id ?? null,
                    'contain_id' => $contains1->id,
                ]);
            }
    }
}
