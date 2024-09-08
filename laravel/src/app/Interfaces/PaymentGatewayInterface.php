<?php

namespace App\Interfaces;

interface PaymentGatewayInterface
{
    public function processPayment(float $amount): bool;
    public function refund(float $amount): bool;
}
