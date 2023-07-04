<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository
{
    public function createOrder($orderData)
    {
        // Create a new order in the database
        $order = Order::create($orderData);

        if (!$order) {
            throw new \Exception('Failed to create order');

        return $order;
    }

    public function updateOrder($orderId, $orderData)
    {
        // Find the order by ID
        $order = Order::find($orderId);

        if (!$order) {
            throw new \Exception('Order not found');
            
        }

        // Update the order attributes
        $order->fill($orderData);
        $order->save();

        return $order;
    }

    public function getOrderById($orderId)
    {
        // Find the order by ID
        $order = Order::find($orderId);

        if (!$order) {
            throw new \Exception('Order not found');
           
        }

        return $order;
    }

    public function cancelOrder($orderId)
    {
        // Find the order by ID
        $order = Order::find($orderId);

        if (!$order) {
            throw new \Exception('Order not found');
           
        }

        // Set the order status to cancelled
        $order->status = 'cancelled';
        $order->save();

        return $order;
    }

    public function markOrderAsShipped($orderId, $trackingNumber)
    {
        // Find the order by ID
        $order = Order::find($orderId);

        if (!$order) {
            throw new \Exception('Order not found');
        }

        // Set the order status to shipped and update the tracking number
        $order->status = 'shipped';
        $order->tracking_number = $trackingNumber;
        $order->save();

        return $order;
    }
}
