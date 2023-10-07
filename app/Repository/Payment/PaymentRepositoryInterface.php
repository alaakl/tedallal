<?php

namespace App\Repository\Payment;

use App\Models\Billing;
use App\Models\Product;

interface PaymentRepositoryInterface {
    public function buyProducts($request);

    public function deleteBilling(Billing $billing);
    public function getUserBillings($user);
}
