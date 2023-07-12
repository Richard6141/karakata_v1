<?php

namespace App\Http\Controllers;

use Iterator;
use Traversable;
use App\Models\Order;
use App\Models\Source;
use IteratorAggregate;
use App\Models\District;
use App\Models\PayementMode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\OrderRepositoryInterface;
use App\Interfaces\CustomerRepositoryInterface;

class RequestController extends Controller
{

    private OrderRepositoryInterface $orderRepository;
    private UserRepositoryInterface $userRepository;
    private CustomerRepositoryInterface $customerRepository;

    public function __construct(OrderRepositoryInterface $orderRepository, UserRepositoryInterface $userRepository, CustomerRepositoryInterface $customerRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->userRepository = $userRepository;
        $this->customerRepository = $customerRepository;
    }



    // Query all users registered on the date today
    public function getUserByDate(Request $request): View
    {

        $date = $request->date;
        /** @var string $date  */
        return $this->userRepository->getUserByDate($date);
    }
    // Query all customers registered on the date today  
    public function getCustomerByDate(Request $request): object
    {
        $date = $request->date;
        /** @var string $date  */
        return $this->customerRepository->getCustomersByDate($date);
    }

    //  Query for all date the total number of new users
    public function getUserPerDate(): array
    {
        $users = $this->userRepository->userPerDate();
        $countUsersByDate = [];
        foreach ($users as $key => $value) {
            $countUsersByDate += [$key => $value->count()];
        }
        $newArray = array_slice($countUsersByDate, 0, 3, true);
        return $newArray;
    }

    //  Query for all date the total number of new users
    public function getCustomersPerDate(): array
    {
        $customers = $this->customerRepository->CustomerPerDate();
        $countcustomersByDate = [];
        if (is_iterable($customers)) {
            foreach ($customers as $key => $value) {
                $countcustomersByDate += [$key => $value->count()];
            }
            return $newArray = array_slice($countcustomersByDate, 0, 3, true);
        } else {
            abort(404);
        }
    }

    // Query total number of new customers for a given period
    public function getCustomerByPeriod(Request $request): object
    {
        $data = (object) array(
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
        );
        return ($this->customerRepository->getCustomerByPeriod($data));
    }

    // Query total number of new users for a given period
    public function getUsersByPeriod(Request $request): View
    {
        $data = (object) array(
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
        );
        return view('welcome');
    }

    // Query the top 3 of best delivers of the month
    public function topDeliverOfMonth(Request $request): array
    {
        $month = $request->month;
        /** @var string $month  */
        $orders = $this->orderRepository->deliverOfMonth($month);
        $newarray = array();
        foreach ($orders as $key => $value) {
            $newarray += [$key => $value->count()];
        }
        arsort($newarray);
        return $data = array_slice($newarray, 0, 3, true);
    }

    // Query the top 3 of best delivers for a given period
    public function topDeliverOfPeriod(Request $request): array
    {
        $data = (object) array(
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
        );
        $orders = $this->orderRepository->deliverOfPeriod($data);
        $newarray = array();
        foreach ($orders as $key => $value) {
            $newarray += [$key => count($value)];
        }
        arsort($newarray);
        return $data = array_slice($newarray, 0, 3, true);
    }

    // Query the top 3 of best customers of the month
    public function topCustomerOfMonth(Request $request): array
    {
        /** @var string $month */
        $month = $request->month;
        $limit = $request->limit;
        if (!blank(htmlspecialchars(trim($month))) && preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])$/", $month) && is_int($limit)) {
            $data = (array) ["month" => $month, 'limit' => $limit];
            /** @var array $data  */
            return $orders = $this->customerRepository->CustomerOfMonth($data);
        } else {
            abort(400, $message = 'Requête invalide');
        }
    }

    // Query the top 3 of best delivers for a given period
    public function topCustomerOfPeriod(Request $request): View
    {
        $data = (object) array(
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
        );

        $orders = $this->customerRepository->CustomerOfPeriod($data);
        $newarray = array();
        if (is_iterable($orders)) {
            foreach ($orders as $key => $value) {
                $newarray += [$key => count($value)];
            }
            arsort($newarray);
            $data = array_slice($newarray, 0, 3, true);
            return view('welcome');
        } else {
            abort(404);
        }
    }


    // Look for the total number of orders for a given date
    public function orderOfDay(Request $request): array
    {
        $date = $request->date;
        /** @var string $date  */
        $orders = $this->orderRepository->orderOfToday($date);
        return $orders->orderBy('created_at', 'DESC');
    }

    // Total number of orders for a given period
    public function orderOfPeriod(Request $request): View
    {
        $data = (object) array(
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
        );
        $orders = $this->orderRepository->orderOfPeriod($data);
        return view('welcome');
    }


    // Get number of orders per date
    public function orderPerDate(): array
    {
        $orders = $this->orderRepository->orderPerDate();
        $countOrdersByDate = [];
        foreach ($orders as $key => $value) {
            $countOrdersByDate += [$key => $value->count()];
        }
        return $newArray = array_slice($countOrdersByDate, 0, 10, true);
    }

    // number of today's delivery
    public function deliveryofday(Request $request): View
    {
        $date = $request->date;
        /** @var string $date  */
        $order =  $this->orderRepository->orderOfToday($date);
        return view('welcome');
    }

    // number of out of time delivery
    public function OutOfTimeDelivery(): View
    {
        $orders = $this->orderRepository->outOfTimeDelivery();
        return view('welcome');
    }

    // public function dayturnover(Request $request): View
    // {
    //     $date = $request->date;
    //     /** @var string $date  */
    //     $orders = $this->orderRepository->orderFinished($date);
    //     $totalSum = $orders->sum('total');
    //     return view('home');
    // }

    public function turnOverForADay(Request $request): View
    {
        $date = $request->date;
        /** @var string $date  */
        $orders = $this->orderRepository->orderFinished($date);
        $totalSum = $orders->sum('total');
        return view('welcome');
    }

    public function turnOverForAPeriod(Request $request): View
    {
        $data = (object) array(
            'startDate' => '2022-10-26',
            'endDate' => '2022-10-28',
        );
        $orders = $this->orderRepository->orderFinishedForPeriod($data);
        $totalSum = $orders->sum('total');
        dd($orders);
        // return view('welcome');
    }

    public function turnOverForAMonth(Request $request): View
    {
        $month = $request->month;
        /** @var string $month  */
        $orders = $this->orderRepository->orderFinishedPerMonth($month);
        $totalSum = $orders->sum('total');
        return view('welcome');
    }

    public function turnOverPerDay(): View
    {
        $orders = $this->orderRepository->getFinishedOrders();
        $orders = $orders->groupBy(function ($item) {
            return $item->created_at->format('Y-m');
        });
        $array = [];
        foreach ($orders as $key => $value) {
            $array += [$key => $value->sum('total')];
        }
        return view('welcome');
    }


    public function PackSoldADay(Request $request): View
    {
        $date = $request->date;
        /** @var string $date  */
        $orders = $this->orderRepository->orderFinished($date);
        $totalSum = $orders->sum('number');
        return view('welcome');
    }

    public function PackSoldInMonth(Request $request): View
    {
        $month = $request->month;
        /** @var string $month  */
        $orders = $this->orderRepository->orderFinishedPerMonth($month);
        $totalSum = $orders->sum('number');
        return view('welcome');
    }

    public function PackSoldInPeriod(Request $request): View
    {
        $data = (object) array(
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
        );
        $orders = $this->orderRepository->orderFinishedForPeriod($data);
        $totalSum = $orders->sum('number');
        return view('welcome');
    }

    public function PackSoldPerDay(): View
    {
        $orders = $this->orderRepository->getFinishedOrders();
        $orders = $orders->groupBy(function ($item) {
            return $item->created_at->format('Y-m-d');
        });
        $array = [];
        foreach ($orders as $key => $value) {
            $array += [$key => $value->sum('number')];
        }
        return view('welcome');
    }

    public function OrderBySource(): View
    {
        $orders = $this->orderRepository->getFinishedOrders();
        $orders = $orders->groupBy('source_id');
        $array = [];
        foreach ($orders as $key => $value) {
            $sourceName = Source::where('id', $key)->first();
            $sourceName = $sourceName->label ?? null;
            $array += [$sourceName => $value];
        }
        return view('welcome');
    }

    public function orderBySourcePerDate(): View
    {
        $orders = $this->orderRepository->getFinishedOrders();
        $orders = $orders->groupBy(function ($item) {
            return $item->created_at->format('Y-m-d');
        });
        $newArray = [];
        foreach ($orders as $key => $value) {
            $value = $value->groupBy('source_id');
            $newArray += [$key => $value];
        }
        return view('welcome');
    }

    public function orderBySourcePerMonth(): View
    {
        $orders = $this->orderRepository->getFinishedOrders();
        $orders = $orders->groupBy(function ($item) {
            return $item->created_at->format('Y-m');
        });
        $newArray = [];
        foreach ($orders as $key => $value) {
            $value = $value->groupBy('source_id');
            $newArray += [$key => $value];
        }
        return view('welcome');
    }

    public function orderByDistrict(): View
    {
        $orders = $this->orderRepository->getFinishedOrders();
        $orders = $orders->groupBy('district_id');
        $array = [];
        foreach ($orders as $key => $value) {
            $sourceName = District::where('id', $key)->first();
            $sourceName = $sourceName->label ?? null;
            $array += [$sourceName => count($value)];
        }
        return view('welcome');
    }

    public function orderBydistrictPerDate(): View
    {
        $orders = $this->orderRepository->getFinishedOrders();
        $orders = $orders->groupBy(function ($item) {
            return $item->created_at->format('Y-m-d');
        });
        $newArray = [];
        foreach ($orders as $key => $value) {
            $value = $value->groupBy('district_id');
            $newArray += [$key => $value];
        }
        return view('welcome');
    }

    public function orderBydistrictPerMonth(): View
    {
        $orders = $this->orderRepository->getFinishedOrders();
        $orders = $orders->groupBy(function ($item) {
            return $item->created_at->format('Y-m');
        });
        $newArray = [];
        foreach ($orders as $key => $value) {
            $value = $value->groupBy('district_id');
            $newArray += [$key => $value];
        }
        return view('welcome');
    }

    public function orderByPaymentMode(): View
    {
        $orders = $this->orderRepository->getFinishedOrders();
        $orders = $orders->groupBy('payement_mode_id');
        $array = [];
        foreach ($orders as $key => $value) {
            $sourceName = PayementMode::where('id', $key)->first();
            $sourceName = $sourceName->label ?? null;
            $array += [$sourceName => count($value)];
        }
        return view('welcome');
    }

    public function orderByPaymentModePerDay(): View
    {
        $orders = $this->orderRepository->getFinishedOrders();
        $orders = $orders->groupBy(function ($item) {
            return $item->created_at->format('Y-m-d');
        });
        $newArray = [];
        foreach ($orders as $key => $value) {
            $value = $value->groupBy('payement_mode_id');
            $newArray += [$key => $value];
        }
        return view('welcome');
    }

    public function orderByPaymentModePerMonth(): View
    {
        $orders = $this->orderRepository->getFinishedOrders();
        $orders = $orders->groupBy(function ($item) {
            return $item->created_at->format('Y-m');
        });
        $newArray = [];
        foreach ($orders as $key => $value) {
            $value = $value->groupBy('payement_mode_id');
            $newArray += [$key => $value];
        }
        return view('welcome');
    }


    public function getOrdersLast(){
        $date = date('Y-m-d');

        $orders = Order::orderBy('created_at', 'DESC')->where('is_delete', false)->where('date', $date)->LIMIT(5)->get();

        return \view('/home', ['orders' => $orders]);
    }
}
