<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Client;
use App\Models\Customer;
use App\Models\Particular;
use Illuminate\Http\Request;
use App\Models\CustomerDepot;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use App\Interfaces\OrderRepositoryInterface;
use App\Models\Company;
use DateTime;
use DateInterval;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\CustomerRepositoryInterface;
use Illuminate\Http\JsonResponse;

class HomeController extends Controller
{

    private OrderRepositoryInterface $orderRepository;
    // private UserRepositoryInterface $userRepository;
    // private CustomerRepositoryInterface $customerRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->middleware('auth');
        $this->orderRepository = $orderRepository;
        // $this->userRepository = $userRepository;
        // $this->customerRepository = $customerRepository;
    }

    public function sumordercustomer($id)
    {
        $sum= DB::table('orders')
        ->where('customer_id', $id)
        ->where('date', date('Y-m-d'))
        ->sum('total');
    }
    public function index(): View
    {
        $date = date('Y-m-d');
        $orders1 = Order::orderBy('created_at', 'DESC')->where('is_delete', false)->where('date', $date)->LIMIT(5)->get();
        $orders = $this->orderRepository->orderFinished(date('Y-m'));
        $orders = $orders->groupBy('customer_id');
        // dd($orders);
        $array = [];
        foreach ($orders as $key => $value) {
            $array += [$key => $value->sum('total')];
        }
        arsort($array);

        $array2 = [];
        foreach ($array as $key => $value) {
            $customer = Customer::where('id', $key)->first();
            if ($customer->particulars_id != null && $customer->companies_id == null) {
                $particular = Particular::where('id', $customer->particulars_id)->first();
                $array2 += [$particular->name => $value];
            }

            if ($customer->particulars_id == null && $customer->companies_id != null) {
                $particular = Company::where('id', $customer->companies_id)->first();
                $array2 += [$particular->name . ' ' . $particular->firstname => $value];
            }

        }

        $top5 = array_slice($array2, 0, 3);

        // dd($top5);

    //
        $newCostumers = Customer::whereDay('created_at', strval(Carbon::now()->day))->count();
        return view('home', [
            'chiffreaffairebymonthcurrent' => chiffreaffairebymonthcurrent(),
            'topthreecostumer' => topthreecostumer(),
            'topclient' => $top5,
            'orders' => $orders1,
            'numbernewcostumers' => Customer::whereDay('created_at', strval(Carbon::now()->day))->count(),
            'numberallcostumers' => Customer::orderBy('id', 'DESC')->count(),
        ]);
    }


    public function turnOverPerMonth(): JsonResponse
    {
        $orders = Order::where('finished', true)->get();
        $orders = $orders->groupBy(function ($item) {
            return $item->created_at->format('Y-m');
        });

        $array = [];

        foreach ($orders as $month => $order) {
            $array += [$month => $order->sum('total')];
        }
        ksort($array);

        $thisMonTurnOver = end($array);
        $data = [
            'success' => true,
            'orders' => $array,
            'thisMonTurnOver' => $thisMonTurnOver
        ];

        return response()->json($data);
    }

    public function pack(): Jsonresponse
    {
        $orderThisMonth = $this->orderRepository->orderFinishedPerMonth(date('Y-m'));
        $ordersPreviousMonth = $this->orderRepository->orderFinishedPerMonth(date("Y-m", strtotime("first day of previous month")));

        // $orders = $orders->groupBy('paquet_id');

        $array1 = [];


        $data = [
            'success' => true,
            'orderThisMonth' => $orderThisMonth,
            'ordersPreviousMonth' => $ordersPreviousMonth,
            //     'dateYesterday' => $dateYesterday,
            //     'dateTommorow' => $dateTommorow
        ];

        return response()->json($data);
    }

    public function orderPerdateCanva(): JsonResponse
    {
        $orders = Order::where('finished', true)->get();
        $orders = $orders->groupBy(function ($item) {
            return $item->created_at->format('Y-m');
        });

        $array = [];

        foreach ($orders as $month => $order) {
            $array += [$month =>count($order)];
        }
        ksort($array);

        $thisMonthOrders = end($array);
        $data = [
            'success' => true,
            'orders' => $array,
            'thisMonthOrders' => $thisMonthOrders
        ];

    return response()->json($data);
    }
}
