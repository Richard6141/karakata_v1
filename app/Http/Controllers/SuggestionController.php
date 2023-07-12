<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Source;
use App\Models\Customer;
use App\Models\Suggestion;
use Illuminate\Support\Str;
use function Ramsey\Uuid\v1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Svg\Tag\Rect;

class SuggestionController extends Controller
{

    public function index(): View
    {

        $particulars = DB::table('suggestions')
            ->join('customers', 'suggestions.customers_id', 'customers.id')
            ->join('sources', 'suggestions.sources_id', 'sources.id')
            ->join('particulars', 'customers.particulars_id', 'particulars.id')
            ->select('particulars.*', 'suggestions.*', 'sources.label')
            ->get()->toArray();

        $companies = DB::table('suggestions')
            ->join('customers', 'suggestions.customers_id', 'customers.id')
            ->join('sources', 'suggestions.sources_id', 'sources.id')
            ->join('companies', 'customers.companies_id', 'companies.id')
            ->select('companies.*', 'suggestions.*', 'sources.label')
            ->get()->toArray();

        $customers = array_merge($particulars, $companies);



        // $order = DB::table('suggestions')
        // ->join('customers', 'customers.id', '=', 'suggestions.customers_id')
        // ->join('particulars', 'particulars.id', '=', 'customers.particulars_id')
        // ->join('companies', 'companies.id', '=', 'customers.companies_id')
        // ->select('customers.*', 'particulars.*', 'companies.*', 'suggestions.id As customers_id')
        // ->get();

        // dd($orders);

        return view('Suggestion.index', [

            'Suggestion' => $customers,
            // 'customer' => $customer,
            // 'companies' => $companies,
            'sources' => Source::all(),
        ]);
    }


    public function enregistrer_suggestion(string $id): view
    {
        // dd($id);
        if ($id == 0) {
            $customers = null;
        } else {
            $customers = Customer::where('id', $id)->first();
        }

        return view('Suggestion.add', [
            'customer' => $customers,
            'sources' => Source::all(),
            'date' => date('Y-m-d'),
        ]);
    }


    public function store(Request $request): RedirectResponse | View
    {
        // dd($request);

        $request->validate([
            'preference' => 'required|string',
            'type' => 'required',
            'customers_id' => 'required',
            'sources' => 'required',
            'date' => 'required',
            // 'type_composant' => 'required',
        ]);


        $source = Source::where('id', $request->source_commande)->first();
        $customers = Customer::where('phone', $request->phone)->first();
        if (Auth::user() instanceof User) {
            $validator = new Suggestion();
            $validator['id'] = Str::uuid();
            $validator['preference'] = $request->preference;
            $validator['date'] = $request->date;
            $validator['customers_id'] = $request->customers_id;
            $validator['sources_id'] = $request->sources;
            // $validator['type_composant_id'] = $request->typecomposant;
            $validator['created_by'] = Auth::user()->id;
            $validator->save();

            $message = 'Enregistrement effectué !';
            return redirect()
                ->route('suggestion.index')
                ->with('success', "$message");
        }
        abort(401);
    }

    public function store1(Customer $customer, Request $request): RedirectResponse
    {

        // dd($request );

        $request->validate([
            'preference' => 'required|string',
            'type' => 'required|string',
            'customer_id' => 'required',
            'sources' => 'required',
            'date' => 'required',
        ]);


        $source = Source::where('id', $request->source_commande)->first();
        $customers = Customer::where('phone', $request->phone)->first();
        if (Auth::user() instanceof User) {
            $validator = new Suggestion();
            $validator['id'] = Str::uuid();
            $validator['preference'] = $request->preference;
            $validator['type'] = $request->type;
            $validator['date'] = $request->date;
            $validator['customers_id'] = $request->customer_id;
            $validator['sources_id'] = $request->sources;
            $validator['created_by'] = Auth::user()->id;
            $validator->save();

            $message = 'Enregistrement effectué !';
            return redirect()
                ->back()
                ->with('success', "$message");
        }
        abort(401);
    }


    public function search(Request $request): RedirectResponse
    {
        $customer = Customer::orWhere('phone', 'like',  "%" . $request->phone . "%")
            ->orWhere('particulars_id', 'like', "%" . $request->phone . "%")
            ->orWhere('companies_id', 'like',  "%" . $request->phone . "%")
            ->orWhere('username', 'like',  "%" . $request->phone . "%")
            ->orWhere('id', 'like',  "%" . $request->phone . "%")
            ->first();


        // $coupons = Coupon::orderBy('created_at', 'DESC')->get();

        // dd($coupons);

        // $groupe = Coupon::where('pack_id',$pack->$pack);
        $customers = Customer::all();
        if (is_null($customer)) {
            $message = "Client introuvable !";
            return back()->with('error', "$message");
        } else {
            return redirect()->route('suggestion.add', $customer->id);
            // return view('Suggestion.add', [
            //     'customer' => $customer,
            // 'customers'  => $customers,
            // 'date' => date('Y-m-d'),
            // ]);
        }
    }

    // public function show(Suggestion $Suggestion)
    // {
    //     //
    // }

    public function edit(string $id): RedirectResponse | View
    {
        /** @var Suggestion */
        $suggestions = Suggestion::where('id', $id)->first();
        $customer = Customer::where('id', $suggestions->customers_id)->first();

        $particulars = DB::table('suggestions')
            ->join('customers', 'suggestions.customers_id', 'customers.id')
            ->join('sources', 'suggestions.sources_id', 'sources.id')
            ->join('particulars', 'customers.particulars_id', 'particulars.id')
            ->select('particulars.*', 'suggestions.*', 'sources.label', 'customers_id')
            ->get()->toArray();

        $companies = DB::table('suggestions')
            ->join('customers', 'suggestions.customers_id', 'customers.id')
            ->join('sources', 'suggestions.sources_id', 'sources.id')
            ->join('companies', 'customers.companies_id', 'companies.id')
            ->select('companies.*', 'suggestions.*', 'sources.label', 'customers_id')
            ->get()->toArray();

        // $customers = array_merge($particulars, $companies);
        if (!$customer instanceof Customer) {
            abort(404);
        }
        if (is_null($customer->particulars_id)) {
            $customers = DB::table('suggestions')
                ->join('customers', 'suggestions.customers_id', 'customers.id')
                ->join('sources', 'suggestions.sources_id', 'sources.id')
                ->join('companies', 'customers.companies_id', 'companies.id')
                ->select('companies.*', 'suggestions.*', 'sources.label', 'customers_id')
                ->get()->toArray();
            $name = DB::table('companies')
                ->select('companies.*')
                ->where('companies.id', $customer->companies_id)->first();
        } else {
            $customers = DB::table('suggestions')
                ->join('customers', 'suggestions.customers_id', 'customers.id')
                ->join('sources', 'suggestions.sources_id', 'sources.id')
                ->join('particulars', 'customers.particulars_id', 'particulars.id')
                ->select('particulars.*', 'suggestions.*', 'sources.label', 'customers_id')
                ->get()->toArray();
            $name = DB::table('particulars')
                ->select('particulars.*')
                ->where('particulars.id', $customer->particulars_id)->first();
        }
        // dd($name->name);


        // dd(Source::all());
        if (!$suggestions instanceof Suggestion) {
            abort(404);
        }

        // if(is_null($suggestions)){
        //     $message = ' Impossible';
        //     return redirect()
        //         ->route('suggestion.index')
        //         ->with('error', "$message");
        // }


        return view('Suggestion.edit', [
            'Suggestion' => $suggestions,
            'sources' => Source::all(),
            'customer' => $customer,
            'name' => $name,
            'customers' => $customers,
        ]);
    }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Models\Suggestion  $Suggestion
    //  * @return \Illuminate\Http\Response
    //  */
    public function update(Request $request, string $id): RedirectResponse
    {

        $Suggestion = Suggestion::where('id', $id)->first();
        $request->validate([
            'preference' => 'required|string',
            // 'type' => 'required|string',
            'customers_id' => 'required',
            'sources' => 'required',
            'date' => 'required',
        ]);

        if (!$Suggestion instanceof Suggestion) {
            abort(404);
        }
        if (Auth::user() instanceof User) {
            $Suggestion->preference = strval($request->preference);
            // $Suggestion->type = strval($request->type);
            $Suggestion->date = strval($request->date);
            $Suggestion->customers_id = strval($request->customers_id);
            $Suggestion->sources_id = strval($request->sources);
            $Suggestion->updated_by = Auth::user()->id;
            $Suggestion->save();

            $message = "Modification effectuée !";
            return redirect()->route('suggestion.index')->with('success', "$message");
        }
        abort(404);
    }


    public function destroy(string $id): RedirectResponse
    {
        $id = htmlspecialchars(trim(strval($id)));
        $Suggestions = Suggestion::where('id', $id)->first();
        if (is_null($Suggestions)) {
            abort(404);
        }
        $Suggestions->delete();

        $message = 'Suggestion supprimée !';
        return redirect()
            ->back()
            ->with('success', "$message");
    }
}
