<?php

namespace OrderManagement\Controllers;
use App\Http\Controllers\Controller;
use App\OrderManagement\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function placeOrder(Request $request)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'customer_id' => 'required',
                'product_id' => 'required',
                'quantity' => 'required|integer|min:1',
            ]);

            // Place the order
            $order = $this->orderService->placeOrder($validatedData);

            // Return success response with the created order
            return response()->json([
                'success' => true,
                'message' => 'Order placed successfully',
                'order' => $order
            ], 200);
        } catch (ValidationException $e) {
            // Return the validation error response
            return response()->json([
                'success' => false,
                'message' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            // Handle the exception and return an error response
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function updateOrder(Request $request, $orderId)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'quantity' => 'required|integer|min:1',
            ]);

            // Update the order
            $order = $this->orderService->updateOrder($orderId, $validatedData);

            // Return success response with the updated order
            return response()->json([
                'success' => true,
                'message' => 'Order updated successfully',
                'order' => $order
            ], 200);
        } catch (ValidationException $e) {
            // Return the validation error response
            return response()->json([
                'success' => false,
                'message' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            // Handle the exception and return an error response
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getOrderDetails($orderId)
    {
        try {
            // Get the order details
            $order = $this->orderService->getOrderDetails($orderId);

            // Return success response with the order details
            return response()->json([
                'success' => true,
                'order' => $order
            ], 200);
        } catch (\Exception $e) {
            // Handle the exception and return an error response
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
