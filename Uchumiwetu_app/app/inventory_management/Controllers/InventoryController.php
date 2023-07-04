<?php
namespace App\inventory_management\Controllers;

use App\Http\Controllers\Controller;
use App\inventory_management\Services\InventoryService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class InventoryController extends Controller
{
    protected $inventoryService;

    public function __construct(InventoryService $inventoryService)
    {
        $this->inventoryService = $inventoryService;
    }

    public function createInventory(Request $request)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'product_id' => 'required',
                'quantity' => 'required|integer|min:0',
            ]);

            // Create the inventory
            $inventory = $this->inventoryService->createInventory($validatedData);

            // Return success response with the created inventory
            return response()->json([
                'success' => true,
                'message' => 'Inventory created successfully',
                'inventory' => $inventory
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

    public function updateInventory(Request $request, $inventoryId)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'quantity' => 'required|integer|min:0',
            ]);

            // Update the inventory
            $inventory = $this->inventoryService->updateInventory($inventoryId, $validatedData);

            // Return success response with the updated inventory
            return response()->json([
                'success' => true,
                'message' => 'Inventory updated successfully',
                'inventory' => $inventory
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

    public function getInventoryDetails($inventoryId)
    {
        try {
            // Get the inventory details
            $inventory = $this->inventoryService->getInventoryDetails($inventoryId);

            // Return success response with the inventory details
            return response()->json([
                'success' => true,
                'inventory' => $inventory
            ], 200);
        } catch (\Exception $e) {
            // Handle the exception and return an error response
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function reduceInventoryQuantity(Request $request, $inventoryId)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'quantity' => 'required|integer|min:0',
            ]);

            // Reduce the inventory quantity
            $inventory = $this->inventoryService->reduceInventoryQuantity($inventoryId, $validatedData);

            // Return success response with the updated inventory
            return response()->json([
                'success' => true,
                'message' => 'Inventory quantity reduced successfully',
                'inventory' => $inventory
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
}
