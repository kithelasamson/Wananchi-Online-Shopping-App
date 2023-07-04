<?php

namespace App\inventory_management\Repositories;

use App\Models\Inventory;

class InventoryRepository
{
    public function createItem($itemData)
    {
        // Create a new inventory item
        $inventory = Inventory::create($itemData);

        if (!$inventory) {
            throw new \Exception('Failed to create inventory item');
        }

        return $inventory;
    }

    public function updateItem($itemId, $itemData)
    {
        // Find the inventory item by ID
        $inventory = Inventory::find($itemId);

        if (!$inventory) {
            throw new \Exception('Inventory item not found');
        }

        // Update the inventory item attributes
        $inventory->fill($itemData);
        $inventory->save();

        return $inventory;
    }

    public function getItemById($itemId)
    {
        // Find the inventory item by ID
        $inventory = Inventory::find($itemId);

        if (!$inventory) {
            throw new \Exception('Inventory item not found');
        }

        return $inventory;
    }

    public function deleteItem($itemId)
    {
        // Find the inventory item by ID
        $inventory = Inventory::find($itemId);

        if (!$inventory) {
            throw new \Exception('Inventory item not found');
        }

        // Delete the inventory item
        $inventory->delete();
    }

    public function getInventoryDetails($inventoryId)
    {
        // Retrieve the inventory details
        $inventory = Inventory::with('product', 'order', 'payment', 'shipping', 'customer')->find($inventoryId);

        if (!$inventory) {
            throw new \Exception('Inventory item not found');
        }

        return $inventory;
    }

    public function updateInventoryQuantity($productId, $quantity)
    {
        // Find the inventory item by product ID
        $inventory = Inventory::where('product_id', $productId)->first();

        if (!$inventory) {
            throw new \Exception('Inventory item not found');
        }

        // Update the inventory item quantity
        $inventory->quantity = $quantity;
        $inventory->save();

        return $inventory;
    }
}
