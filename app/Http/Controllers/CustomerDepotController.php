<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Support\Str;
use App\Models\PayementMode;
use Illuminate\Http\Request;
use App\Models\CustomerDepot;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class CustomerDepotController extends Controller
{

    public function index(): View
    {

        $particulars = DB::table('customer_depots')
            ->join('customers', 'customer_depots.customer_id', 'customers.id')
            ->join('particulars', 'customers.particulars_id', 'particulars.id')
            ->select('particulars.*', 'customer_depots.*')
            ->get()->toArray();

        $companies = DB::table('customer_depots')
            ->join('customers', 'customer_depots.customer_id', 'customers.id')
            ->join('companies', 'customers.companies_id', 'companies.id')
            ->select('companies.*', 'customer_depots.*')
            ->get()->toArray();

        $customers = array_merge($particulars, $companies);


        return view('customerdepot.index', [

            'customer_depots' => $customers,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'amount' => 'required',
            'date' => 'required',
        ]);

        try {
            $customers = Customer::where('phone', $request->phone)->first();
            $customerdepot = CustomerDepot::where('customer_id', htmlspecialchars(trim(strval($request->customer_id))))
                ->orderBy('created_at', 'desc')->first();

            $validator = new CustomerDepot();
            $validator['id'] = Str::uuid();
            $validator['amount'] = $request->amount;
            $validator['date'] = $request->date;
            $validator['customer_id'] = htmlspecialchars(trim(strval($request->customer_id)));
            $validator['created_by'] = Auth::user()->id ?? null;
            $validator->save();

            $message = 'Dépôt enregistré !';
            return redirect()
                ->route('customerdepot.index')
                ->with('success', "$message");
        } catch (\Throwable $th) {
            $message = "Erreur, veuillez contacter l'administrateur!";
            return redirect()->route('customerdepot.index')->with('error', "$message");
        }
    }

    public function store1(Customer $customer, Request $request): RedirectResponse
    {

        $request->validate([
            'amount' => 'required',
            'date' => 'required',
        ]);
        try {
            if (!$customer instanceof Customer) {
                \abort(403);
            }

            $customerdepot = CustomerDepot::where('customer_id', htmlspecialchars(trim(strval($request->customer_id))))
                ->orderBy('created_at', 'desc')->first();
            if (is_null($customerdepot)) {
                $customer->solde = 0;
                $customer->solde = intval($request->amount);
                $customer->save();
                $validator = new CustomerDepot();
                $validator['id'] = Str::uuid();
                $validator['amount'] = $request->amount;
                $validator['date'] = $request->date;
                $validator['customer_id'] = htmlspecialchars(trim(strval($request->customer_id)));
                $validator['created_by'] = Auth::user()->id ?? null;
                $validator->save();


                $message = 'Dépôt enregistré !';
                return redirect()
                    ->back()
                    ->with('success', "$message");
            } else {

                $solde = $customer->solde + $request->amount;



                $customer->solde = $solde;
                $customer->save();
                $validator = new CustomerDepot();
                $validator['id'] = Str::uuid();
                $validator['amount'] = $request->amount;
                $validator['date'] = $request->date;
                $validator['customer_id'] = $request->customer_id;
                $validator['created_by'] = Auth::user()->id ?? null;
                $validator->save();


                $message = 'Dépôt enregistré !';
                return redirect()
                    ->back()
                    ->with('success', "$message");
            }
        } catch (\Throwable $th) {
            $message = 'Erreur, veillez!';
            return redirect()
                ->back()
                ->with('success', "$message");
        }
    }

    public function update(CustomerDepot $customer_depot, Request $request): RedirectResponse
    {

        $request->validate([
            'amount' => 'required',
            'date' => 'required',
        ]);

        try {

            if (!$customer_depot instanceof CustomerDepot) {
                \abort(403);
            }

            $customer = Customer::where('id', $customer_depot->customer_id)->first();
            $customer->solde = $customer->solde - $customer_depot->amount;
            $customer->save();

            $customer = Customer::where('id', $customer_depot->customer_id)->first();
            $customer->solde = $customer->solde - $request->amount;
            $customer->save();

            $customer_depot['id'] = Str::uuid();
            $customer_depot['amount'] = $request->amount;
            $customer_depot['date'] = $request->date;
            $customer_depot['updated_by'] = Auth::user()->id ?? null;
            $customer_depot->save();

            $message = 'Dépôt modifié !';
            return redirect()->route('customerdepot.index')->with('success', "$message");
        } catch (\Throwable $th) {
            $message = 'Erreur';
            return redirect()->back()->with('success', "$th");
        }
    }


    public function search(Request $request): RedirectResponse
    {
        $customer = Customer::orWhere('phone', 'like',  "%" . $request->phone . "%")
            ->orWhere('particulars_id', 'like', "%" . $request->phone . "%")
            ->orWhere('companies_id', 'like',  "%" . $request->phone . "%")
            ->orWhere('username', 'like',  "%" . $request->phone . "%")
            ->orWhere('id', 'like',  "%" . $request->phone . "%")
            ->first();



        $customers = Customer::all();
        if (is_null($customer)) {
            $message = "Client introuvable !";
            return back()->with('error', "$message");
        } else {
            return redirect()->route('customerdepot.add', $customer->id);
        }
    }

    public function edit(string $id): View
    {
        $id = htmlspecialchars(trim(strval($id)));
        $customer_depots = CustomerDepot::where('id', $id)->first();
        if (!$customer_depots instanceof CustomerDepot) {
            abort(404);
        }
        $customer = Customer::where('id', $customer_depots->customer_id)->first();
        if (!$customer instanceof Customer) {
            \abort(404);
        }

        $particulars = DB::table('customer_depots')
            ->join('customers', 'customer_depots.customer_id', 'customers.id')
            ->join('particulars', 'customers.particulars_id', 'particulars.id')
            ->select('particulars.*', 'customer_depots.*', 'customer_id')
            ->get()->toArray();

        $companies = DB::table('customer_depots')
            ->join('customers', 'customer_depots.customer_id', 'customers.id')
            ->join('companies', 'customers.companies_id', 'companies.id')
            ->select('companies.*', 'customer_depots.*', 'customer_id')
            ->get()->toArray();

        if (is_null($customer->particulars_id)) {
            $customers = DB::table('customer_depots')
                ->join('customers', 'customer_depots.customer_id', 'customers.id')
                ->join('companies', 'customers.companies_id', 'companies.id')
                ->select('companies.*', 'customer_depots.*', 'customer_id')
                ->get()->toArray();
            $name = DB::table('companies')
                ->select('companies.*')
                ->where('companies.id', $customer->companies_id)->first();
        } else {
            $customers = DB::table('customer_depots')
                ->join('customers', 'customer_depots.customer_id', 'customers.id')
                ->join('particulars', 'customers.particulars_id', 'particulars.id')
                ->select('particulars.*', 'customer_depots.*', 'customer_id')
                ->get()->toArray();
            $name = DB::table('particulars')
                ->select('particulars.*')
                ->where('particulars.id', $customer->particulars_id)->first();
        }


        if ($customer_depots instanceof CustomerDepot) {

            $this->index();
        }


        return view('customerdepot.edit', [
            'customer_depots' => $customer_depots,
            'payement_modes' => PayementMode::all(),
            'customer' => $customer,
            'name' => $name,
            'customers' => $customers,
        ]);
    }

    public function destroy(string $id): RedirectResponse
    {
        try {
            $id = htmlspecialchars(trim(strval($id)));
            $customer_depots = CustomerDepot::where('id', $id)->first();
            if (!$customer_depots instanceof CustomerDepot) {
                abort(404);
            }
            $customer = Customer::where('id', $customer_depots->customer_id ?? null)->first();
            $newSoldValue = (int) $customer->solde - $customer_depots->amount;
            $customer->solde = $newSoldValue;
            $customer->save();
            $customer_depots->delete();

            $message = 'Dépôt supprimé !';
            return redirect()
                ->back()
                ->with('success', "$message");
        } catch (\Throwable $th) {
            $message = "Erreur, veuillez contacter l'adminitrateur!";
            return redirect()
                ->back()
                ->with('error', "$message");
        }
    }
}
