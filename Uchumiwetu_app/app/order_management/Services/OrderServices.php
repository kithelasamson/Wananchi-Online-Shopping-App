<?php

namespace App\Services;

use App\Repositories\OrderRepository;
use App\Services\InventoryService;
use App\Services\PaymentService;

class OrderService
{
    protected $orderRepository;
    protected $inventoryService;
    protected $paymentService;

    public function __construct(OrderRepository $orderRepository, InventoryService $inventoryService, PaymentService $paymentService)
    {
        $this->orderRepository = $orderRepository;
        $this->inventoryService = $inventoryService;
        $this->paymentService = $paymentService;
    }

    public function placeOrder($orderData)
    {
        // Check product availability
        $productId = $orderData['product_id'];
        $quantity = $orderData['quantity'];
        $isAvailable = $this->inventoryService->checkProductAvailability($productId, $quantity);

        if (!$isAvailable) {
            throw new \Exception('Product is out of stock');
            // You can return an appropriate response or handle the scenario as needed
        }

        // Process payment
        $totalAmount = $this->calculateTotalAmount($productId, $quantity);
        $paymentData = [
            'customer_id' => $orderData['customer_id'],
            'amount' => $totalAmount,
        ];
        $paymentStatus = $this->paymentService->processPayment($paymentData);

        if ($paymentStatus !== 'success') {
            throw new \Exception('Payment failed');
            // You can return an appropriate response or handle the scenario as needed
        }

        // Save the order in the database
        $order = $this->orderRepository->createOrder($orderData);

        return $order;
    }

    public function updateOrder($orderId, $orderData)
    {
        // Check if the order exists and belongs to the customer
        $order = $this->orderRepository->getOrderById($orderId);

        if (!$order) {
            throw new \Exception('Order not found');
            // You can return an appropriate response or handle the scenario as needed
        }

        // Update the order
        $updatedOrder = $this->orderRepository->updateOrder($orderId, $orderData);

        return $updatedOrder;
    }

    public function getOrderDetails($orderId)
    {
        // Retrieve order details
        $order = $this->orderRepository->getOrderById($orderId);

        if (!$order) {
            throw new \Exception('Order not found');
            // You can return an appropriate response or handle the scenario as needed
        }

        return $order;
    }

    public function cancelOrder($orderId)
    {
        // Check if the order exists and belongs to the customer
        $order = $this->orderRepository->getOrderById($orderId);

        if (!$order) {
            throw new \Exception('Order not found');
            // You can return an appropriate response or handle the scenario as needed
        }

        // Cancel the order
        $canceledOrder = $this->orderRepository->cancelOrder($orderId);

        return $canceledOrder;
    }

    public function markOrderAsShipped($orderId, $trackingNumber)
    {
        // Check if the order exists and belongs to the customer
        $order = $this->orderRepository->getOrderById($orderId);

        if (!$order) {
            throw new \Exception('Order not found');
            // You can return an appropriate response or handle the scenario as needed
        }

        // Mark the order as shipped
        $updatedOrder = $this->orderRepository->markOrderAsShipped($orderId, $trackingNumber);

        return $updatedOrder;
    }

    

    protected function calculateTotalAmount($productId, $quantity)
    {
        // Calculate the total amount based on the product price and quantity
        
        $product = Product::find($productId);
        $price = $product->price;
        $totalAmount = $price * $quantity;

        return $totalAmount;
    }
}
