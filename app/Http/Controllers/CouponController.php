<?php

namespace App\Http\Controllers;

use Mail;
use Dompdf\Dompdf;
use App\Models\Pack;
use App\Models\User;
use App\Models\Client;
use App\Models\Coupon;
use App\Models\Paquet;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Categorie;
use App\Models\Particular;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{

    public function index(): View
    {
        $pack = Paquet::all();

        $coupons = Coupon::orderBy('created_at', 'DESC')->get();;
        $users = User::all();
        $clients = Customer::all();

        return view('Coupons.list', [
            'users' => $users,
            'coupons' => $coupons,
            'client' => $clients,
            'pack' => $pack,
            'date' => date('Y-m-d'),

        ]);
    }

    public function add(): View
    {
        $pack = Paquet::all();
        $pack = $pack->groupBy('price');
        $prices = [];
        foreach ($pack as $price => $paquets) {
            array_push($prices, $price);
        }

        $coupons = Coupon::orderBy('created_at', 'DESC')->get();
        $users = User::all();

        return view('Coupons.add', [
            'users' => $users,
            'coupons' => $coupons,
            'prices' => $prices,
            'date' => date('Y-m-d'),
        ]);
    }

    public function clientsWithCoupons(): View
    {

        $coupons = Coupon::all();
        $particularsCoupons = DB::table('customers')
            ->join('coupons', 'customers.id', '=', 'coupons.customer_id')
            ->where('coupons.coupon_status', 0)
            ->join('particulars', 'particulars.id', '=', 'customers.particulars_id')
            ->select('customers.*', 'coupons.*', 'particulars.*', 'coupons.id As coupon_id')
            ->get();

        $CompaniesCoupons = DB::table('customers')
            ->join('coupons', 'customers.id', '=', 'coupons.customer_id')
            ->where('coupons.coupon_status', 0)
            ->join('companies', 'companies.id', '=', 'customers.companies_id')
            ->select('customers.*', 'coupons.*', 'companies.*')
            ->get();
        $allCoupons = [];
        foreach ($particularsCoupons as $item) {
            array_push($allCoupons, $item);
        }
        foreach ($CompaniesCoupons as $item) {
            array_push($allCoupons, $item);
        }
        $grouped_array = array();
        if (is_array($allCoupons)) {
            foreach ($allCoupons as $element) {
                $grouped_array[$element->username][] = $element;
            }
        }
        return view('Coupons.list', [
            'particularsCoupons' => $grouped_array
        ]);
    }

    public function couponsValid(): View
    {
        $coupons = Coupon::all();
        $couponsvalid = [];
        foreach ($coupons as $coupon) {
            if ($coupon->coupon_status == 0) {
                array_push($couponsvalid, $coupon);
            }
        }
        return view('Coupons.validCoupons', [
            'couponsvalid' => $couponsvalid
        ]);
    }

    public function couponsNoValid(): View
    {
        $coupons = Coupon::all();
        updatecouponstatus($coupons);
        $couponsNovalid = [];
        foreach ($coupons as $coupon) {
            if ($coupon->coupon_status == 1) {
                array_push($couponsNovalid, $coupon);
            }
        }
        return view('Coupons.invalidCoupons', [
            'couponsNovalid' => $couponsNovalid
        ]);
    }

    public function coupons_client(string $id): View
    {
        $customer = Customer::where('username', $id)->first();

        if ($customer instanceof Customer) {
            if ($customer->particulars_id !== null && is_null($customer->companies_id)) {
                $couponsnotused = DB::table('customers')
                    ->where('customers.username', $id)
                    ->join('coupons', 'customers.id', '=', 'coupons.customer_id')
                    ->where('coupons.coupon_status', 0)
                    ->where('coupons.date_of_use', null)
                    ->join('particulars', 'particulars.id', '=', 'customers.particulars_id')
                    ->select('customers.*', 'coupons.*', 'particulars.*', 'coupons.id AS coupon_id')
                    ->get();

                $couponsused = DB::table('customers')
                    ->where('customers.username', $id)
                    ->join('coupons', 'customers.id', '=', 'coupons.customer_id')
                    ->where('coupons.coupon_status', 1)
                    ->where('coupons.date_of_use', '!=', null)
                    ->join('particulars', 'particulars.id', '=', 'customers.particulars_id')
                    ->select('customers.*', 'coupons.*', 'particulars.*', 'coupons.id AS coupon_id')
                    ->get();

                $couponbydate = $couponsnotused->groupBy('issue_date');
                $customer_infos = Particular::where('id', $customer->particulars_id)->first();
            }
            if ($customer->particulars_id == null && $customer->companies_id != null) {
                $couponsnotused = DB::table('customers')
                    ->where('customers.username', $id)
                    ->join('coupons', 'customers.id', '=', 'coupons.customer_id')
                    ->where('coupons.coupon_status', 0)
                    ->where('coupons.date_of_use', null)
                    ->join('companies', 'companies.id', '=', 'customers.companies_id')
                    ->select('customers.*', 'coupons.*', 'companies.*', 'coupons.id AS coupon_id')
                    ->get();

                $couponsused = DB::table('customers')
                    ->where('customers.username', $id)
                    ->join('coupons', 'customers.id', '=', 'coupons.customer_id')
                    ->where('coupons.coupon_status', 1)
                    ->join('companies', 'companies.id', '=', 'customers.companies_id')
                    ->select('customers.*', 'coupons.*', 'companies.*', 'coupons.id AS coupon_id')
                    ->get();

                $couponbydate = $couponsnotused->groupBy('issue_date');
                $customer_infos = Company::where('id', $customer->companies_id)->first();
            }
            return view('Coupons.list_coupons', [
                'couponbydate' => $couponbydate ?? [],
                'couponsused' => $couponsused ?? [],
                'customer_infos' => $customer_infos ?? null,
                'customer' => $customer
            ]);
        } else {
            abort(404);
        }
    }
    public function search(Request $request): RedirectResponse
    {
        $client = Customer::Where('phone', 'like',  "%" . $request->phone . "%")->first();
        $pack = Paquet::all();
        $pack = $pack->groupBy('price');
        $prices = [];
        foreach ($pack as $price => $paquets) {
            array_push($prices, $price);
        }
        $coupons = Coupon::orderBy('created_at', 'DESC')->get();
        $clients = Customer::all();
        $users = User::all();
        if (is_null($client)) {
            $message = "Aucun client !";
            return back()->with('error', "$message");
        } else {
            return redirect()->route('coupon.add', $client->id);
        }
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nombre' => 'required|integer|min:1|not_in:0',
            'phone' => 'required|integer',
            'customer_id' => 'required',
            'email' => 'required',
            'date_expiration' => 'required',
            'coupon_value' => 'required|integer',
        ]);
        $customer_email = Customer::where('email', $request->email)->exists();
        $customer_phone = Customer::where('phone', $request->phone)->exists();
        if ($customer_email && $customer_phone) {
            $nombre =  $request->nombre;
            if ($nombre <= 0) {
                return back()->with("error", "vérifiez le nombre");
            } else {
                for ($i = 0; $i < $nombre; $i++) {
                    $date = str_replace('-', '', date('y-m-d'));
                    $coupon = Coupon::create([
                        'id' => Str::uuid(),
                        'coupon_unique_code' => 'TF' . uniqid() . $date,
                        'coupon_value' => $request->coupon_value,
                        'issue_date' => date('Y-m-d '),
                        'expiry_date' => $request->date_expiration,
                        'created_by' => Auth::user()->id ?? null,
                        'customer_id' => $request->customer_id,
                    ]);
                }
                if ($nombre == 1) {
                    return redirect()->route('coupon.clients')->with('success', "Coupon créé !");
                }
                if ($nombre > 1) {
                    return redirect()->route('coupon.clients')->with('success', "Coupons créés !");
                }
            }
        } else {
            return back()->with("error", "Impossible de trouver le client");
        }
    }

    /**
     * @param string $id
     * @param string $customer_id
     *
     */
    public function editCoupon($id, $customer_id): View
    {
        $coupon = Coupon::find($id);
        $customer = Customer::where('id', $customer_id)->first();

        if ($customer instanceof Customer) {
            if ($customer->particulars_id != null && $customer->companies_id == null) {
                $client_info = Particular::where('id', $customer->particulars_id)->first();
            }

            if ($customer->particulars_id == null && $customer->companies_id != null) {
                $client_info = Company::where('id', $customer->companies_id)->first();
            }
        }

        $pack = Paquet::all();
        $pack = $pack->groupBy('price');
        $prices = [];

        foreach ($pack as $price => $paquets) {
            array_push($prices, $price);
        }

        return view('Coupons.edit', [
            'customer' => $customer,
            'client_info' => $client_info ?? null,
            'coupon' => $coupon ?? null,
            'prices' => $prices,
            'date' => date('Y-m-d')
        ]);
    }

    public function editsubmission(Request $request): RedirectResponse
    {
        // dd($request->customer_id);
        $coupon = Coupon::find($request->coupon_id);
        if ($coupon instanceof Coupon) {
            $coupon->coupon_value = $request->coupon_value;
            $coupon->expiry_date = $request->date_expiration;
            $coupon->save();
            return redirect()->route('coupon.customers', ['id' => $request->customer_id])->with('success', 'Modification réussie');
        } else {
            return redirect()->route('coupon.customers', ['id' => $request->customer_id])->with('error', 'Une erreur est intervenue !');
        }
    }

    public function destroy($id)
    {
        $coupon = Coupon::find($id);
        if ($coupon != null) {
            $coupon->delete();
            $message = 'Coupon supprimé !';
            return redirect()
                ->back()
                ->with('success', "$message");
        }
        return back()->with('error', 'Coupon non trouvé');
    }

    public function generatePDF($id)
    {

        $coupon = Coupon::find($id);

        $customer = Customer::where('id', $coupon->customer_id)->first();
        if ($customer instanceof Customer) {
            if ($customer->particulars_id != null && $customer->companies_id == null) {
                $client = Particular::where('id', $customer->particulars_id)->first();
            }
            if ($customer->particulars_id == null && $customer->companies_id != null) {
                $client = Company::where('id', $customer->companies_id)->first();
            }
            $data = [
                'coupon' => $coupon,
                'client' => $client,
                'date' => date('Y-m-d'),
                'customer' => $customer
            ];

            $pdf = PDF::loadView('Coupons.pdf_unique', $data);

            return $pdf->stream('coupons.pdf');
        }
    }

    function GenerateMultipleCoupon($id)
    {
        $customer = Customer::where('username', $id)->first();
        if ($customer instanceof Customer) {
            if ($customer->particulars_id != null && $customer->companies_id == null) {
                $coupons = DB::table('customers')
                    ->where('customers.username', $id)
                    ->join('coupons', 'customers.id', '=', 'coupons.customer_id')
                    ->where('coupons.coupon_status', 0)
                    ->join('particulars', 'particulars.id', '=', 'customers.particulars_id')
                    ->select('customers.*', 'coupons.*', 'particulars.*')
                    ->get();

                $client = Particular::where('id', $customer->particulars_id)->first();
            }
            if ($customer->particulars_id == null && $customer->companies_id != null) {
                $coupons = DB::table('customers')
                    ->where('customers.username', $id)
                    ->join('coupons', 'customers.id', '=', 'coupons.customer_id')
                    ->where('coupons.coupon_status', 0)
                    ->join('companies', 'companies.id', '=', 'customers.companies_id')
                    ->select('customers.*', 'coupons.*', 'companies.*')
                    ->get();

                $client = Company::where('id', $customer->companies_id)->first();
            }
            if (count($coupons) != 0) {
                $data = [
                    'coupons' => $coupons,
                    'customer' => $customer,
                    'client' => $client
                ];
                $pdf = PDF::loadView('Coupons.myPDF', $data);
                return $pdf->stream('coupons.pdf');
            } else {
                return back()->with('error', "Pas de coupons valides à imprimer");
            }
        }
    }

    public function SendCoupon($id)
    {
        $customer = Customer::where('username', $id)->first();
        if ($customer instanceof Customer) {
            # code...
            if ($customer->particulars_id != null && $customer->companies_id == null) {
                $coupons = DB::table('customers')
                    ->where('customers.username', $id)
                    ->join('coupons', 'customers.id', '=', 'coupons.customer_id')
                    ->where('coupons.coupon_status', 0)
                    ->join('particulars', 'particulars.id', '=', 'customers.particulars_id')
                    ->select('customers.*', 'coupons.*', 'particulars.*')
                    ->get();

                $client = Particular::where('id', $customer->particulars_id)->first();
            }

            if ($customer->particulars_id == null && $customer->companies_id != null) {
                $coupons = DB::table('customers')
                    ->where('customers.username', $id)
                    ->join('coupons', 'customers.id', '=', 'coupons.customer_id')
                    ->where('coupons.coupon_status', 0)
                    ->join('companies', 'companies.id', '=', 'customers.companies_id')
                    ->select('customers.*', 'coupons.*', 'companies.*')
                    ->get();

                $client = Company::where('id', $customer->companies_id)->first();
            }
            $email = $customer->email;
            $data = [
                'coupons' => $coupons,
                'customer' => $customer,
                'client' => $client
            ];
        }

        if (count($coupons) != 0) {
            $pdf = PDF::loadView('Coupons.myPDF', $data);

            Mail::send('Coupons.myPDF', $data, function ($message) use ($pdf, $email) {
                $message->to($email);
                $message->subject('Coupons');
                $message->attachData($pdf->output(), 'coupons.pdf');
            });

            return redirect()
                ->back()
                ->with('success', "Coupons envoyés avec succes");
        } else {
            return redirect()
                ->back()
                ->with('success', "Pas de coupons valides à envoyer");
        }
    }

    public function RetrieveClient(Request $request): JsonResponse
    {
        $customer = Customer::where('phone', $request->numero)->first();
        if ($customer != null) {
            if ($customer->particulars_id != null && $customer->companies_id == null) {
                $client_info = Particular::where('id', $customer->particulars_id)->first();
            }
            if ($customer->particulars_id == null && $customer->companies_id != null) {
                $client_info = Company::where('id', $customer->companies_id)->first();
            }
            $data = [
                'success' => 1,
                'client_info' => $client_info,
                'customer' => $customer
            ];
            return response()->json($data);
        } else {
            $data = [
                'success' => 0,
            ];
            return response()->json($data);
        }
    }

    public function printbydate($id, $date)
    {
        $customer = Customer::where('username', $id)->first();
        if ($customer instanceof Customer) {
            if ($customer->particulars_id != null && $customer->companies_id == null) {
                $client = Particular::where('id', $customer->particulars_id)->first();
            }
            if ($customer->particulars_id == null && $customer->companies_id != null) {
                $client = Company::where('id', $customer->companies_id)->first();
            }
            // dd($client->name);
            $coupons = Coupon::where([['customer_id', $customer->id], ['issue_date', $date]])->get();
            $data = [
                'coupons' => $coupons,
                'client' => $client,
                'customer' => $customer,
            ];
            $pdf = PDF::loadView('Coupons.myPDF', $data);
            return $pdf->stream('coupons.pdf');
        }
    }

    public function deletebydate($id, $date)
    {
        $customer = Customer::where('username', $id)->first();
        $coupons = Coupon::where([['customer_id', $customer->id], ['issue_date', $date], ['coupon_status', 0]])->get();
        if ($customer != null && $coupons != null) {
            try {
                foreach ($coupons as $coupon) {
                    $coupon->delete();
                }
                return redirect()->route('coupon.clients')->with('success', 'Coupons supprimés avec succès');
            } catch (\Throwable $th) {
                return back()->with('Erreur', $th->getMessage());
            }
        }
        return back()->with('error', "Impossible d'effectuer cette action");
    }
}
