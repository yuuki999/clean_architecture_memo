<?php

namespace App\Services\Payments;

use App\Interfaces\PaymentGatewayInterface;

class CreditCardPayment implements PaymentGatewayInterface
{
    public function processPayment(float $amount): bool
    {
        // クレジットカード支払い処理のロジック
        return true;
    }

    public function refund(float $amount): bool
    {
        // クレジットカード返金処理のロジック
        return true;
    }
}
