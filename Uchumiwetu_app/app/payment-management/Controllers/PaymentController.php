<?php
namespace App\payment_management\Controllers;
use App\Http\Controllers\Controller;

use App\payment_management\Services\PaymentService;
use App\payment_management\Repositories\PaymentRepository;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $paymentService;
    protected $paymentRepository;

    public function __construct(PaymentService $paymentService, PaymentRepository $paymentRepository)
    {
        $this->paymentService = $paymentService;
        $this->paymentRepository = $paymentRepository;
    }

    public function processPayment(Request $request)
    {
        // Validate the payment request data
        $validatedData = $request->validate([
            'order_id' => 'required',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required',
        ]);

        // Process the payment
        $payment = $this->paymentService->processPayment($validatedData);

        // Save the payment record in the database
        $paymentData = [
            'order_id' => $validatedData['order_id'],
            'amount' => $validatedData['amount'],
            'payment_method' => $validatedData['payment_method'],
        ];
        $this->paymentRepository->createPayment($paymentData);

        // Return the payment details
        return response()->json(['payment' => $payment]);
    }
}
