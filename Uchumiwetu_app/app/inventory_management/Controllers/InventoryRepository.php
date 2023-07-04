<?php

namespace App\inventory_management\Repositories;

use App\Models\Product;

class InventoryRepository
{
    public function createItem($itemData)
    {
        // Create a new product
        $product = Product::create($itemData);

        if (!$product) {
            throw new \Exception('Failed to create product');
        }

        return $product;
    }

    public function updateItem($itemId, $itemData)
    {
        // Find the product by ID
        $product = Product::find($itemId);

        if (!$product) {
            throw new \Exception('Product not found');
        }

        // Update the product attributes
        $product->fill($itemData);
        $product->save();

        return $product;
    }

    public function getItemById($itemId)
    {
        // Find the product by ID
        $product = Product::find($itemId);

        if (!$product) {
            throw new \Exception('Product not found');
        }

        return $product;
    }

    public function deleteItem($itemId)
    {
        // Find the product by ID
        $product = Product::find($itemId);

        if (!$product) {
            throw new \Exception('Product not found');
        }

        // Delete the product
        $product->delete();
    }
}
