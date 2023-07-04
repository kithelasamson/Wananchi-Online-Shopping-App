<?php

namespace App\Repositories;

use App\Models\Payment;

class PaymentRepository
{
    public function createPayment($paymentData)
    {
        // Create a new payment in the database
        $payment = Payment::create($paymentData);

        if (!$payment) {
            throw new \Exception('Failed to create payment');
        }

        return $payment;
    }

    public function getPaymentById($paymentId)
    {
        // Find the payment by ID
        $payment = Payment::find($paymentId);

        if (!$payment) {
            throw new \Exception('Payment not found');
        }

        return $payment;
    }
}
