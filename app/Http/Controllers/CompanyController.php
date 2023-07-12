<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Mail\IdentifiantMail;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;

class CompanyController extends Controller
{
    /**
     * Undocumented function
     *
     * @return View
     */
    public function add()
    {
        return view('entreprise.add');
    }

    /**
     * Undocumented function
     *
     * @return RedirectResponse
     */

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'firstname' => 'required|string',
            'socialreason' => 'required|string',
            'phone' => 'required|unique:customers,phone',
            'email' => 'unique:customers,email',
        ]);
        try {
            $password = substr(strval($request->name), 0, 1) . substr(strval($request->firstname), 0, 1) . uniqid();
            $username = substr(strval($request->name), 0, 1) . substr(strval($request->firstname), 0, 1) . uniqid();

            if ($request->check == 'on') {
                $check = true;
            } else {
                $check = false;
            }


            $company = Company::create([
                'name' => strtoupper(htmlspecialchars(trim(strval($request->name)))),
                'firstname' => ucfirst(htmlspecialchars(trim(strval($request->firstname)))),
                'socialreason' => htmlspecialchars(trim(strval($request->socialreason))),
                'created_by' => Auth::user()->id ?? null,
            ]);

            $customer = Customer::create([
                'username' => $username,
                'phone' => $request->phone,
                'email' => $request->email,
                'status' => $check,
                'password' => $password,
                'companies_id' => $company->id,
                'created_by' => Auth::user()->id ?? null,
            ]);

            if (!blank($request->email)) {

                $data = [
                    'email' => $customer->email,
                    'username' => $customer->username,
                    'password' => $password,
                    'url' => route('maintenance'),
                ];

                Mail::to($data['email'])->send(new IdentifiantMail($data));
            }

            return redirect()->route('customer.index')->with('success', "Client enregistré avec succès");
        } catch (\Throwable $th) {
            $message = "Erreur, veuillez contacter l'administrateur!";
            return redirect()->route('customer.index')->with('error', "$message");
        }
    }

    /**
     * Undocumented function
     *
     * @return View
     */

    public function show(Customer $customer)
    {
        try {
            if (!$customer instanceof Customer) {
                \abort(404);
            }
            return view('entreprise.update', [
                'customer' => $customer
            ]);
        } catch (\Throwable $th) {
            $message = "Erreur, veuillez contacter l'administrateur!";
            return redirect()->route('customer.index')->with('error', "$message");
        }
    }

    /**
     * Undocumented function
     *
     * @return RedirectResponse
     */

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required|string',
            'firstname' => 'required|string',
            'socialreason' => 'required|string',
            // 'username' => 'required|string',
            // 'image' => 'required|string',
            'phone' => 'required|unique:customers,phone,' . $customer->id,
            'email' => 'unique:customers,email,' . $customer->id
        ]);
        try {
            if (!$customer instanceof Customer) {
                abort(404);
            }
            if (!auth()->user() instanceof User) {
                \abort(404);
            }
            $company = Company::where('id', $customer->companies_id)->first();
            if (!$company instanceof Company) {
                \abort(404);
            }
            $company->name = strtoupper(htmlspecialchars(trim(strval($request->name))));
            $company->firstname = ucfirst((htmlspecialchars(trim(strval($request->firstname)))));
            $company->socialreason = htmlspecialchars(trim(strval($request->socialreason)));
            $company->updated_by = auth()->user()->id;
            $company->save();

            if ($request->check == 'on') {
                $check = true;
            } else {
                $check = false;
            }

            $customer->phone = strval($request->phone);
            $customer->email = strval($request->email);
            $customer->birthdate = $request->birthdate;
            $customer->updated_by = auth()->user()->id;
            $customer->save();

            return redirect()->route('customer.index')->with('success', "Client modifié");
        } catch (\Throwable $th) {
            $message = "Erreur, veuillez contacter l'administrateur!";
            return redirect()->route('customer.index')->with('error', "$message");
        }
    }
}
