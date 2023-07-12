<?php

namespace App\Interfaces;

interface PaymentRepositoryInterface
{
    public function getAllPayment();
    public function createPayment(array $paymentDetails);
}
