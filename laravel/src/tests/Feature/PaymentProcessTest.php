<?php

namespace Tests\Feature;

use App\Contracts\PaymentGatewayInterface;
use App\Services\Payments\CreditCardPayment;
use App\Services\Payments\PayPalPayment;
use Tests\TestCase;

class PaymentProcessTest extends TestCase
{
    public function testPaymentProcessWithCreditCard()
    {
        $this->app->bind(PaymentGatewayInterface::class, CreditCardPayment::class);

        $response = $this->post('/api/payment', [
            'amount' => 100.00,
            'method' => 'credit_card'
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
    }

    public function testPaymentProcessWithPayPal()
    {
        $this->app->bind(PaymentGatewayInterface::class, PayPalPayment::class);

        $response = $this->post('/api/payment', [
            'amount' => 100.00,
            'method' => 'paypal'
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
    }
}
