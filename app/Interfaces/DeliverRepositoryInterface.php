<?php

namespace App\Interfaces;

interface DeliverRepositoryInterface 
{
    public function getAllDelivers(): mixed;
    public function createDeliver(array $deliverDetails ): object;
    public function getOderAssignedUndelivered();
    public function getdeliverById(string $deliverId);
    public function getOrdersByCustomerId(string $deliverId);
    public function getOrdersByCustomerIdNumber(string $deliverId);
    public function deleteDeliver(string $deliverId);
    public function getAvailableDeleverById(string $deliverId);
    public function deliverOrderDeliveredCount(string $deliverId);
    public function updateDeliver(string $orderId, array $informations);
    public function getAllAvailableDeliver();
    public function getTodayUnassignedOrder();
    public function getCompanyOrderUnfinished();
    public function getParticularOrderUnfinished();
    public function getTodayUnfinishedOrder();
    public function getCompanyOrderNotDelivered();
    public function getParticularOrderNotDelivered();
    public function getTodayOrderNotDelivered();
    public function getCompanyOrderAssignedNotDelivered(string $deliverId);
    public function getCompanyOrderAssignedDelivered(string $deliverId);
    public function getParticularOrderAssignedNotDelivered(string $deliverId);
    public function getParticularOrderAssignedDelivered(string $deliverId);
    public function getAllOrderAssignedNotDelivered(string $deliverId);
    public function getAllOrderAssignedDelivered(string $deliverId);
}