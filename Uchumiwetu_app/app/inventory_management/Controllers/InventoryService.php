<?php
namespace App\inventory_management\Services;

use App\inventory_management\Repositories\InventoryRepository;

class InventoryService
{
    protected $inventoryRepository;

    public function __construct(InventoryRepository $inventoryRepository)
    {
        $this->inventoryRepository = $inventoryRepository;
    }

    public function getInventoryDetails($inventoryId)
{
    // Get the inventory details from the repository
    $inventory = $this->inventoryRepository->getInventoryDetails($inventoryId);

    return $inventory;
}


    public function createInventory($inventoryData)
    {
        // Create a new inventory item
        $inventory = $this->inventoryRepository->createItem($inventoryData);

        return $inventory;
    }

    public function updateInventory($inventoryId, $inventoryData)
    {
        // Update an inventory item
        $inventory = $this->inventoryRepository->updateItem($inventoryId, $inventoryData);

        return $inventory;
    }

    public function deleteInventory($inventoryId)
    {
        // Delete an inventory item
        $this->inventoryRepository->deleteItem($inventoryId);
    }
}
