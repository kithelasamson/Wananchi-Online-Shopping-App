<?php
namespace CustomerCareManagement\Controllers;

use Illuminate\Http\Request;
use CustomerCareManagement\Services\CustomerService;

class CustomerController extends Controller
{
    protected $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function submitInquiry(Request $request)
    {
        $validatedData = $request->validate([
            'customer_id' => 'required',
            'message' => 'required',
        ]);

        // Submit the inquiry
        $inquiry = $this->customerService->submitInquiry($validatedData);

        // Return the inquiry details
        return response()->json(['inquiry' => $inquiry]);
    }

    public function submitComplaint(Request $request)
    {
        $validatedData = $request->validate([
            'customer_id' => 'required',
            'message' => 'required',
        ]);

        // Submit the complaint
        $complaint = $this->customerService->submitComplaint($validatedData);

        // Return the complaint details
        return response()->json(['complaint' => $complaint]);
    }

    public function submitReturnRequest(Request $request)
    {
        $validatedData = $request->validate([
            'customer_id' => 'required',
            'order_id' => 'required',
            'reason' => 'required',
        ]);

        // Submit the return request
        $returnRequest = $this->customerService->submitReturnRequest($validatedData);

        // Return the return request details
        return response()->json(['return_request' => $returnRequest]);
    }
}
