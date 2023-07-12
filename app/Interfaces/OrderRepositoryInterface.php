<?php

namespace App\Interfaces;

interface OrderRepositoryInterface
{
    public function getAllOrders();
    public function getOrderById($orderId);
    public function deleteOrder($orderId);
    public function createOrder(array $orderDetails);
    public function updateOrder(string $orderId, array $newDetails): object;
    public function getFinishedOrders();
    public function getDeliveredOrder();
    public function getOrdersByDate($date);
    public function deliverOnce($deliverId);
    public function DeliverOfMonth(String $month);
    public function DeliverOfPeriod(Object $data);

    public function orderOfToday(String $date);
    public function orderOfPeriod(Object $data);
    public function orderPerDate();
    public function orderFinished(string $date);
    public function outOfTimeDelivery();
    public function orderFinishedForPeriod(object $data);
    public function orderFinishedPerMonth(string $month);
}
