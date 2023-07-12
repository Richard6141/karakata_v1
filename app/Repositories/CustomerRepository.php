<?php

namespace App\Repositories;

use App\Interfaces\CustomerRepositoryInterface;
use App\Models\Customer;
use App\Models\Order;


class CustomerRepository implements CustomerRepositoryInterface
{
    public function getAllCustomers(): object
    {
        return Customer::all();
    }

    public function getCustomersByDate(string $date): object
    {
        return Customer::where(Customer::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"), $date)->get();
    }

    public function CustomerPerDate(): object
    {
        $customers = Customer::all();
        $customers = $customers->groupBy(function ($item) {
            return $item->created_at->format('Y-m-d');
        });
        return $customers;
    }

    public function getCustomerByPeriod(object $data): object
    {
        $orders = Customer::whereBetween('created_at', [$data->startDate, $data->endDate])->get();
        return $orders->groupBy('customer_id');
    }

    public function CustomerOfMonth(array $data): array
    {
        $orders = Order::where([['status_delivery', true], [Customer::raw("(DATE_FORMAT(created_at,'%Y-%m'))"), $data['month']]])->get();
        $orders = $orders->groupBy('customer_id');
        $newarray = array();
        foreach ($orders as $key => $value) {
            $newarray += [$key => count($value)];
        };
        arsort($newarray);
        if (!is_null($newarray)) {
            return $data = array_slice($newarray, 0, $data['limit'], true);
        } else {
            abort(404);
        }
    }

    public function CustomerOfPeriod(object $data): object
    {
        $orders = Order::whereBetween('created_at', [$data->startDate, $data->endDate])->where('status_delivery', true)->get();
        return $orders->groupBy('customer_id');
    }

    public function CreateCustomer(array $customerDetails)
    {
        return Customer::create($customerDetails);
    }
}
