<?php

namespace App\PaymentManagement\Services;

use App\Repositories\PaymentRepository;

class PaymentService
{
    protected $paymentRepository;

    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function processPayment($paymentData)
    {
        // Process the payment and retrieve payment details
        $paymentMethod = $paymentData['payment_method'];

        if ($paymentMethod === 'credit_card') {
            // Credit card payment logic
            $payment = $this->processCreditCardPayment($paymentData);
        } elseif ($paymentMethod === 'paypal') {
            // PayPal payment logic
            $payment = $this->processPayPalPayment($paymentData);
        } elseif ($paymentMethod === 'lipa_na_mpesa') {
            // Lipa na M-Pesa payment logic
            $payment = $this->processLipaNaMpesaPayment($paymentData);
        } else {
            throw new \Exception('Invalid payment method');
        }

        // Save the payment details to the database
        $this->paymentRepository->createPayment($payment);

        return $payment;
    }

    protected function processCreditCardPayment($paymentData)
    {
        // Credit card payment processing logic
        // Example: Charge the credit card using a payment gateway API

        $amount = $paymentData['amount'];
        $cardNumber = $paymentData['card_number'];
        $cardExpiry = $paymentData['card_expiry'];
        $cardCvv = $paymentData['card_cvv'];

        //  credit card payment processing logic here

        // Return payment details
        return [
            'payment_method' => 'credit_card',
            'amount' => $amount,
            'card_last_four_digits' => substr($cardNumber, -4),
            // Include other relevant payment details
        ];
    }

    protected function processPayPalPayment($paymentData)
    {
        // PayPal payment processing logic
        // Example: Use PayPal API to process the payment

        $amount = $paymentData['amount'];
        $paypalEmail = $paymentData['paypal_email'];

        //PayPal payment processing logic here

        // Return payment details
        return [
            'payment_method' => 'paypal',
            'amount' => $amount,
            'paypal_email' => $paypalEmail,
            // Include other relevant payment details
        ];
    }

    protected function processLipaNaMpesaPayment($paymentData)
    {
        // Lipa na M-Pesa payment processing logic
        // Example: Use M-Pesa API to process the payment

        $amount = $paymentData['amount'];
        $phoneNumber = $paymentData['phone_number'];

        //  Lipa na M-Pesa payment processing logic here

        // Return payment details
        return [
            'payment_method' => 'lipa_na_mpesa',
            'amount' => $amount,
            'phone_number' => $phoneNumber,
            // Include other relevant payment details
        ];
    }

    public function getPaymentDetails($paymentId)
    {
        // Retrieve payment details from the database
        $payment = $this->paymentRepository->getPaymentById($paymentId);

        return $payment;
    }
}
