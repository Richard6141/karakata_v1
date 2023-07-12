<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use NumberFormatter;
use App\Models\Order;
use App\Models\Paquet;
use App\Models\Source;
use App\Models\Contain;
use App\Models\Deliver;
use App\Models\Customer;
use App\Models\Receiver;
use App\Models\Component;
use App\Models\PaquetType;
use App\Models\Particular;
use App\Models\AddressBook;
use App\Models\PayementMode;
use Illuminate\Http\Request;
use App\Models\ComponentType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ImportController extends Controller
{
    public function index()
    {
        return view('import.index');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required',
        ]);

        $nbrow = 0;
        try {
            set_time_limit(0);
            $time_start = microtime(true);

            $f = new NumberFormatter("fr", NumberFormatter::SPELLOUT);
            $records = import_CSV($request->file);


            DB::beginTransaction();

            foreach ($records as $key => $row) {
                $nbrow++;

                Source::create([
                    'ancient_id'     => $row['id'],
                    'label'     => $row['libelle'],
                ]);
            }

            DB::commit();
            $time_end = microtime(true);
            $execution_time = round(($time_end - $time_start));

            return back()->with('successMessage', "Succès de l'import. <br>" . $nbrow . " lignes importées. Durée (sec): " . $execution_time);
        } catch (\Throwable $ex) {
            DB::rollBack();
            $time_end = microtime(true);
            $execution_time = round(($time_end - $time_start));
            return back()->with('errorMessage', "Échec, ligne " . $nbrow . ". Durée (sec): " . $execution_time . "<br>" . $ex->getMessage());
        }
    }

    public function importParticular(Request $request)
    {
        $request->validate([
            'file' => 'required',
        ]);

        $nbrow = 0;
        try {
            set_time_limit(0);
            $time_start = microtime(true);

            $f = new NumberFormatter("fr", NumberFormatter::SPELLOUT);
            $records = import_CSV($request->file);


            DB::beginTransaction();

            foreach ($records as $key => $row) {
                $nbrow++;
                if ($row['usertable_type'] == "App\Client") {

                    $particular11 = Particular::create([
                        'ancient_id' => $row['id'],
                        'name' => $row['name'],
                        'firstname' => ' ',
                    ]);

                    Customer::create([
                        'ancient_id'     => $row['usertable_id'],
                        'phone'     => $row['phone'],
                        'particulars_id'     => $particular11->id,
                    ]);

                } else {

                    if ($row['usertable_type'] == "App\Gestionnair") {

                        User::create([
                            'ancient_id' => $row['id'],
                            'name' => $row['name'],
                            'firstname' => ' ',
                            'phone' => $row['phone'],
                            'email' => $row['email'],
                            'password' => $row['password'],
                        ]);
                    }
                }
            }

            DB::commit();
            $time_end = microtime(true);
            $execution_time = round(($time_end - $time_start));

            return back()->with('successMessage', "Succès de l'import. <br>" . $nbrow . " lignes importées. Durée (sec): " . $execution_time);
        } catch (\Throwable $ex) {
            DB::rollBack();
            $time_end = microtime(true);
            $execution_time = round(($time_end - $time_start));
            return back()->with('errorMessage', "Échec, ligne " . $nbrow . ". Durée (sec): " . $execution_time . "<br>" . $ex->getMessage());
        }
    }

    public function importReceptionnaire(Request $request)
    {
        $request->validate([
            'file' => 'required',
        ]);

        $nbrow = 0;
        try {
            set_time_limit(0);
            $time_start = microtime(true);

            $f = new NumberFormatter("fr", NumberFormatter::SPELLOUT);
            $records = import_CSV($request->file);


            DB::beginTransaction();

            foreach ($records as $key => $row) {
                $nbrow++;

                Receiver::create([
                    'ancient_id' => $row['id'],
                    'firstname' => $row['name'],
                    'lastname' => ' ',
                    'phone' => $row['phone'],
                ]);
            }

            DB::commit();
            $time_end = microtime(true);
            $execution_time = round(($time_end - $time_start));

            return back()->with('successMessage', "Succès de l'import. <br>" . $nbrow . " lignes importées. Durée (sec): " . $execution_time);
        } catch (\Throwable $ex) {
            DB::rollBack();
            $time_end = microtime(true);
            $execution_time = round(($time_end - $time_start));
            return back()->with('errorMessage', "Échec, ligne " . $nbrow . ". Durée (sec): " . $execution_time . "<br>" . $ex->getMessage());
        }
    }

    public function importAddressBook(Request $request)
    {
        $request->validate([
            'file' => 'required',
        ]);

        $nbrow = 0;
        try {
            set_time_limit(0);
            $time_start = microtime(true);

            $f = new NumberFormatter("fr", NumberFormatter::SPELLOUT);
            $records = import_CSV($request->file);


            DB::beginTransaction();

            foreach ($records as $key => $row) {
                $nbrow++;

                $customer = Customer::where('ancient_id', $row['client_id'])->first();
                if ($customer instanceof Customer) {

                    AddressBook::create([
                        'ancient_id' => $row['id'],
                        'address' => $row['adresse'],
                        'customer_id' => $customer->id,
                    ]);
                }
            }

            DB::commit();
            $time_end = microtime(true);
            $execution_time = round(($time_end - $time_start));

            return back()->with('successMessage', "Succès de l'import. <br>" . $nbrow . " lignes importées. Durée (sec): " . $execution_time);
        } catch (\Throwable $ex) {
            DB::rollBack();
            $time_end = microtime(true);
            $execution_time = round(($time_end - $time_start));
            return back()->with('errorMessage', "Échec, ligne " . $nbrow . ". Durée (sec): " . $execution_time . "<br>" . $ex->getMessage());
        }
    }

    public function importLivreur(Request $request)
    {
        $request->validate([
            'file' => 'required',
        ]);

        $nbrow = 0;
        try {
            set_time_limit(0);
            $time_start = microtime(true);

            $f = new NumberFormatter("fr", NumberFormatter::SPELLOUT);
            $records = import_CSV($request->file);


            DB::beginTransaction();

            foreach ($records as $key => $row) {
                $nbrow++;

                Deliver::create([
                    'ancient_id' => $row['id'],
                    'lastname' => $row['name_prenom'],
                    'firstname' => ' ',
                    'phone' => $row['corporate'],
                ]);
            }

            DB::commit();
            $time_end = microtime(true);
            $execution_time = round(($time_end - $time_start));

            return back()->with('successMessage', "Succès de l'import. <br>" . $nbrow . " lignes importées. Durée (sec): " . $execution_time);
        } catch (\Throwable $ex) {
            DB::rollBack();
            $time_end = microtime(true);
            $execution_time = round(($time_end - $time_start));
            return back()->with('errorMessage', "Échec, ligne " . $nbrow . ". Durée (sec): " . $execution_time . "<br>" . $ex->getMessage());
        }
    }

    public function menu(Request $request)
    {
        $request->validate([
            'file' => 'required',
        ]);

        $nbrow = 0;
        try {
            set_time_limit(0);
            $time_start = microtime(true);

            $f = new NumberFormatter("fr", NumberFormatter::SPELLOUT);
            $records = import_CSV($request->file);


            DB::beginTransaction();

            // Entree
            $typecomposantentree = ComponentType::where('label', 'Entrée')->first();
            // Desert
            $typecomposantDessert = ComponentType::where('label', 'Dessert')->first();
            // Boisson
            $typecomposantBoisson = ComponentType::where('label', 'Boisson')->first();
            // Accompagnement
            $typecomposantAccompagnement = ComponentType::where('label', 'Accompagnement')->first();
            // Resistance
            $typecomposantresistance = ComponentType::where('label', 'Résistance')->first();

            foreach ($records as $key => $row) {
                $nbrow++;

                // Entree
                Component::create([
                    'ancient_id' => $row['id'],
                    'label' => $row['entrer'],
                    // 'image' => $row['image'],
                    'component_type_id' => $typecomposantentree->id,
                ]);

                // Desert
                Component::create([
                    'ancient_id' => $row['id'],
                    'label' => $row['dessert'],
                    // 'image' => $row['image'],
                    'component_type_id' => $typecomposantDessert->id,
                ]);

                // Boisson
                Component::create([
                    'ancient_id' => $row['id'],
                    'label' => $row['boisson'],
                    // 'image' => $row['image'],
                    'component_type_id' => $typecomposantBoisson->id,
                ]);

                // Accompagnement
                Component::create([
                    'ancient_id' => $row['id'],
                    'label' => $row['accompagnement'],
                    // 'image' => $row['image'],
                    'component_type_id' => $typecomposantAccompagnement->id,
                ]);

                // Resistance
                Component::create([
                    'ancient_id' => $row['id'],
                    'label' => $row['resistance'],
                    // 'image' => $row['image'],
                    'component_type_id' => $typecomposantresistance->id,
                ]);
            }

            DB::commit();
            $time_end = microtime(true);
            $execution_time = round(($time_end - $time_start));

            return back()->with('successMessage', "Succès de l'import. <br>" . $nbrow . " lignes importées. Durée (sec): " . $execution_time);
        } catch (\Throwable $ex) {
            DB::rollBack();
            $time_end = microtime(true);
            $execution_time = round(($time_end - $time_start));
            return back()->with('errorMessage', "Échec, ligne " . $nbrow . ". Durée (sec): " . $execution_time . "<br>" . $ex->getMessage());
        }
    }

    public function order(Request $request)
    {
        $request->validate([
            'file'=>'required|max:50000'
        ]);


        // Excel::import(new OrderImport, $request->file);
        // return back()->with('successMessage', "Succès de l'import. <br>" . $nbrow . " lignes importées. Durée (sec): " . $execution_time);


        $nbrow = 0;
        try {
            set_time_limit(0);
            $time_start = microtime(true);

            $f = new NumberFormatter("fr", NumberFormatter::SPELLOUT);
            $records = import_CSV($request->file);

            DB::beginTransaction();

            // Resistance
            $typecomposantresistance = ComponentType::where('label', 'Résistance')->first();


            if (is_array($records) || is_object($records)) {

                foreach ($records as $key => $row) {
                    $nbrow++;
                    // dd($row);

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
                        'date' => Carbon::parse((int)$row['created_at'])->format('Y-m-d'),
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
            DB::commit();
            $time_end = microtime(true);
            $execution_time = round(($time_end - $time_start));

            return back()->with('successMessage', "Succès de l'import. <br>" . $nbrow . " lignes importées. Durée (sec): " . $execution_time);
        } catch (\Throwable $ex) {
            DB::rollBack();
            $time_end = microtime(true);
            $execution_time = round(($time_end - $time_start));
            return back()->with('errorMessage', "Échec, ligne " . $nbrow . ". Durée (sec): " . $execution_time . "<br>" . $ex->getMessage());
        }


    }

    public function typePack(Request $request)
    {
        $request->validate([
            'file' => 'required',
        ]);

        $nbrow = 0;
        try {
            set_time_limit(0);
            $time_start = microtime(true);

            $f = new NumberFormatter("fr", NumberFormatter::SPELLOUT);
            $records = import_CSV($request->file);


            DB::beginTransaction();

            foreach ($records as $key => $row) {
                $nbrow++;

                PaquetType::create([
                    'ancient_id' => $row['id'],
                    'label' => $row['libelle'],
                ]);
            }

            DB::commit();
            $time_end = microtime(true);
            $execution_time = round(($time_end - $time_start));

            return back()->with('successMessage', "Succès de l'import. <br>" . $nbrow . " lignes importées. Durée (sec): " . $execution_time);
        } catch (\Throwable $ex) {
            DB::rollBack();
            $time_end = microtime(true);
            $execution_time = round(($time_end - $time_start));
            return back()->with('errorMessage', "Échec, ligne " . $nbrow . ". Durée (sec): " . $execution_time . "<br>" . $ex->getMessage());
        }
    }


    public function index1()
    {
        return view('import.index1');
    }

    public function importModePaiement(Request $request)
    {
        $request->validate([
            'file' => 'required',
        ]);

        $nbrow = 0;
        try {
            set_time_limit(0);
            $time_start = microtime(true);

            $f = new NumberFormatter("fr", NumberFormatter::SPELLOUT);
            $records = import_CSV($request->file);


            DB::beginTransaction();

            foreach ($records as $key => $row) {
                $nbrow++;

                PayementMode::create([
                    'ancient_id'     => $row['id'],
                    'label'     => $row['libelle'],
                ]);
            }

            DB::commit();
            $time_end = microtime(true);
            $execution_time = round(($time_end - $time_start));

            return back()->with('successMessage', "Succès de l'import. <br>" . $nbrow . " lignes importées. Durée (sec): " . $execution_time);
        } catch (\Throwable $ex) {
            DB::rollBack();
            $time_end = microtime(true);
            $execution_time = round(($time_end - $time_start));
            return back()->with('errorMessage', "Échec, ligne " . $nbrow . ". Durée (sec): " . $execution_time . "<br>" . $ex->getMessage());
        }
    }

    public function importclient(Request $request)
    {
        $request->validate([
            'file' => 'required',
        ]);

        $nbrow = 0;
        try {
            set_time_limit(0);
            $time_start = microtime(true);

            $f = new NumberFormatter("fr", NumberFormatter::SPELLOUT);
            $records = import_CSV($request->file);


            DB::beginTransaction();

            foreach ($records as $key => $row) {
                $nbrow++;
                // $customer = Customer::where('ancient_id', $row['id'])->first();
                // $customer->
                // Customer::create([
                //     'ancient_id'     => $row['id'],
                //     'phone'     => $row['phone'],
                // ]);
            }

            DB::commit();
            $time_end = microtime(true);
            $execution_time = round(($time_end - $time_start));

            return back()->with('successMessage', "Succès de l'import. <br>" . $nbrow . " lignes importées. Durée (sec): " . $execution_time);
        } catch (\Throwable $ex) {
            DB::rollBack();
            $time_end = microtime(true);
            $execution_time = round(($time_end - $time_start));
            return back()->with('errorMessage', "Échec, ligne " . $nbrow . ". Durée (sec): " . $execution_time . "<br>" . $ex->getMessage());
        }
    }
}
