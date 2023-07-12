<?php

namespace App\Repositories;

use App\Interfaces\PaymentRepositoryInterface;
use App\Models\PayementMode;

class PaymentRepository implements PaymentRepositoryInterface
{
    public function getAllPayment()
    {
        return PayementMode::all();
    }

    public function createPayment (array $paymentDetails)
    {
        return PayementMode::create($paymentDetails);
    }
}
