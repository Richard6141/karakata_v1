<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\View\View;
use App\Models\Particular;
use Illuminate\Http\Request;
use App\Mail\IdentifiantMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class ParticularController extends Controller
{
    public function add(): View
    {
        return view('particular.add');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string',
            'firstname' => 'required|string',
            'phone' => 'unique:customers,phone',
            'email' => 'unique:customers,email',
        ]);

        try {
            if (is_null($request->image)) {
                $img = null;
            } else {
                $img = upload($request);
            }

            if ($request->check == 'on') {
                $check = true;
            } else {
                $check = false;
            }


            if (is_string($request->name) && is_string($request->firstname)) {
                $particular = Particular::create([
                    'name' => $request->name,
                    'firstname' => $request->firstname,
                    'created_by' => Auth::user()->id ?? null,
                ]);

                $customer = Customer::create([
                    'username' => substr($request->name, 0, 1) . substr($request->firstname, 0, 1) . uniqid(),
                    'image' => $img,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'birthdate' => $request->birthdate,
                    'status' => $check,
                    'password' => substr($request->name, 0, 1) . substr($request->firstname, 0, 1) . uniqid(),
                    'particulars_id' => $particular->id,
                    'created_by' => Auth::user()->id ?? null,
                ]);

                if (!blank($request->email)) {

                    $data = [
                        'email' => $customer->email,
                        'username' => $customer->username,
                        'password' => substr($request->name, 0, 1) . substr($request->firstname, 0, 1) . uniqid(),
                        'url' => route('maintenance'),
                    ];

                    Mail::to($data['email'])->send(new IdentifiantMail($data));
                }
                return redirect()->route('customer.index')->with('success', "Client enregistré");
            } else {
                return back()->with('errror', "Une erreur s'est produite");
            }
        } catch (\Throwable $th) {
            $message = "Erreur, veuillez contacter l'administrateur!";
            return redirect()->route('customer.index')->with('error', "$message");
        }
    }

    public function show(Customer $customer): View
    {
        return view('particular.update', [
            'customer' => $customer
        ]);
    }

    public function update(Request $request, Customer $customer): RedirectResponse
    {

        $request->validate([
            'name' => 'required|string',
            'firstname' => 'required|string',
            'phone' => 'required|unique:customers,phone,' . $customer->id,
            'email' => 'unique:customers,email,' . $customer->id
        ]);

        try {
            /** @var Particular */
            $particular = Particular::where('id', $customer->particulars_id)->first();
            if (is_string($request->name) && is_string($request->firstname)) {
                $particular->name = $request->name;
                $particular->firstname = $request->firstname;
                $particular->updated_by = Auth::user()->id ?? null;
                $particular->save();
            }


            // if ($request->check == 'on') {
            //     $check = true;
            // } else {
            //     $check = false;
            // }


            if (is_string($request->phone) && is_string($request->email)) {
                if ($customer instanceof Customer) {
                    $customer->phone = $request->phone;
                    $customer->email = $request->email;
                    $customer->birthdate = $request->birthdate;
                    $customer->updated_by = Auth::user()->id ?? null;
                    $customer->save();
                } else {
                    abort(404);
                }
            }

            return redirect()->route('customer.index')->with('success', "Client modifié");
        } catch (\Throwable $th) {
            $message = "Erreur, veuillez contacter l'administrateur!";
            return redirect()->route('customer.index')->with('error', "$message");
        }
    }
}
