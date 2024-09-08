<?php

namespace App\Services\Payments;

use App\Interfaces\PaymentGatewayInterface;

class PayPalPayment implements PaymentGatewayInterface
{
    public function processPayment(float $amount): bool
    {
        // PayPal支払い処理のロジック
        return true;
    }

    public function refund(float $amount): bool
    {
        // PayPal返金処理のロジック
        return true;
    }
}
