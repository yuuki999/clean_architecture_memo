<?php

namespace App\Http\Controllers;

use App\Repositories\PaymentRepository;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $paymentRepository;

    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function index()
    {
        $payments = $this->paymentRepository->getAllPayments();
        return view('payments.index', compact('payments'));
    }

    public function store(Request $request)
    {
        $paymentDetails = $request->validated();
        $payment = $this->paymentRepository->createPayment($paymentDetails);
        return redirect()->route('payments.show', $payment->id);
    }

}
