<?php

namespace Tests\Unit;

use App\Services\Payments\CreditCardPayment;
use App\Services\Payments\PayPalPayment;
use Tests\TestCase;

class PaymentGatewayTest extends TestCase
{
    public function testCreditCardPaymentProcessPayment()
    {
        $gateway = new CreditCardPayment();
        $this->assertTrue($gateway->processPayment(100.00));
    }

    public function testCreditCardPaymentRefund()
    {
        $gateway = new CreditCardPayment();
        $this->assertTrue($gateway->refund(50.00));
    }

    public function testPayPalPaymentProcessPayment()
    {
        $gateway = new PayPalPayment();
        $this->assertTrue($gateway->processPayment(100.00));
    }

    public function testPayPalPaymentRefund()
    {
        $gateway = new PayPalPayment();
        $this->assertTrue($gateway->refund(50.00));
    }
}
