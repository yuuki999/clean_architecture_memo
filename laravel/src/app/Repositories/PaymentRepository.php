<?php

namespace App\Repositories;

use App\Models\Payment;

class PaymentRepository
{
    protected $model;

    public function __construct(Payment $model)
    {
        $this->model = $model;
    }

    public function getAllPayments()
    {
        return $this->model->all();
    }

    public function getPaymentById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function createPayment(array $paymentDetails)
    {
        return $this->model->create($paymentDetails);
    }

    public function updatePayment($id, array $newDetails)
    {
        return $this->model->whereId($id)->update($newDetails);
    }

    public function deletePayment($id)
    {
        return $this->model->destroy($id);
    }
}
