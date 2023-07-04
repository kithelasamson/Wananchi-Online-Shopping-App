<?php

namespace App\ShippingManagement\Controllers;
use App\Http\Controllers\Controller;
use App\ShippingManagement\Services\ShippingService;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    protected $shippingService;

    public function __construct(ShippingService $shippingService)
    {
        $this->shippingService = $shippingService;
    }

    public function getShippingDetails(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'order_id' => 'required',
        ]);

        // Retrieve the shipping details
        $shippingDetails = $this->shippingService->getShippingDetails($validatedData['order_id']);

        // Return the shipping details
        return response()->json(['shipping_details' => $shippingDetails]);
    }

    public function updateShippingStatus(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'order_id' => 'required',
            'status' => 'required',
        ]);

        // Update the shipping status
        $updatedShippingStatus = $this->shippingService->updateShippingStatus($validatedData['order_id'], $validatedData['status']);

        // Return the updated shipping status
        return response()->json(['updated_shipping_status' => $updatedShippingStatus]);
    }

   .
}
