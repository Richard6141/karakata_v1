<?php

namespace App\Repositories;

use App\Interfaces\OrderRepositoryInterface;
use App\Models\Order;

class OrderRepository implements OrderRepositoryInterface
{
    public function getAllOrders(): object
    {
        return Order::orderBy('created_at', 'DESC')->where('is_delete', false)->where('date', date('Y-m-d'))->get();
    }

    public function getOrderById($orderId): object
    {
        return Order::findOrFail($orderId);
    }

    public function deleteOrder($orderId): Void
    {
        Order::destroy($orderId);
    }

    public function createOrder(array $orderDetails): object
    {
        return Order::create($orderDetails);
    }

    public function updateOrder(string $orderId, array $newDetails): object
    {
        Order::whereId($orderId)->update($newDetails);
        return Order::whereId($orderId);
    }

    public function getFinishedOrders(): object
    {
        return Order::where('finished', true)->get();
    }

    public function getDeliveredOrder(): object
    {
        return Order::where('status_delivery', true)->get();
    }

    public function getOrdersByDate($date): object
    {
        return Order::where(Order::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"), $date)->get();
    }

    public function deliverOfMonth(string $month): object
    {
        $orders = Order::where([['status_delivery', true], [Order::raw("(DATE_FORMAT(created_at,'%Y-%m'))"), $month]])->get();
        return $orders = $orders->groupBy('deliver_id');
    }
    public function deliverOnce($deliverId)
    {
        return Order::where('deliver_id', $deliverId)->get();
    }

    public function deliverOfPeriod(object $data): object
    {
        $orders = Order::whereBetween('created_at', [$data->startDate, $data->endDate])->where('status_delivery', true)->get();
        return $orders->groupBy('deliver_id');
    }

    public function orderOfToday(string $date): object
    {
        return $orders = Order::where([[Order::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"), $date], ['status_order', true]])->get();
    }

    public function orderOfPeriod(object $data): object
    {
        return $orders = Order::whereBetween('created_at', [$data->startDate, $data->endDate])->where('status_order', true)->get();
    }

    public function orderPerDate(): object
    {
        $orders = Order::where('status_order', true)->get();
        return $orders = $orders->groupBy(function ($item) {
            return $item->created_at->format('Y-m');
        });
    }

    public function orderFinished(string $date): object
    {
        return $orders = Order::where([['finished', true], [Order::raw("(DATE_FORMAT(created_at,'%Y-%m'))"), $date]])->get();
    }

    public function orderFinishedPerMonth(string $month): object
    {
        return $orders = Order::where([['finished', true], [Order::raw("(DATE_FORMAT(created_at,'%Y-%m'))"), $month]])->get();
    }

    public function orderFinishedForPeriod(object $data): object
    {
        return $orders = Order::where('finished', true)->whereBetween('created_at', [$data->startDate, $data->endDate])->get();
    }

    public function outOfTimeDelivery(): object {
        return $orders = Order::where('status_order', true)->whereColumn('customer_delivery_time', '<', 'delivery_time')->get();
    }
}
