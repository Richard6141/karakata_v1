<?php
namespace App\Interfaces;

interface CustomerRepositoryInterface
{
    public function CreateCustomer(array $customerDetails);

    public function getAllCustomers(): object;
    public function getCustomersByDate(string $date): object;
    public function CustomerPerDate(): object;
    public function CustomerOfMonth(array $month): array;
    public function CustomerOfPeriod(object $data): object;
    public function getCustomerByPeriod(object $data): object;
}
