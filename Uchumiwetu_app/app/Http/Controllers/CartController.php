<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Order;
use App\inventory_management\Repositories\InventoryRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class CartController extends Controller
{
    private $inventoryRepository;

    public function __construct(InventoryRepository $inventoryRepository)
    {
        $this->inventoryRepository = $inventoryRepository;
    }

    public function addToCart(Request $request)
    {
        // Retrieve the product by its ID
        $product = Product::find($request->id);

        if (!$product) {
            // Handle the case when the product is not found
            return response()->json(['error' => 'Product not found'], 404);
        }

        // Add the product to the cart
        $cart = $request->session()->get('cart', []);
        $cart[$product->id] = $product;
        $request->session()->put('cart', $cart);

        // Create a response instance
        $response = new Response();

        // Add the CORS headers
        $response->header('Access-Control-Allow-Origin', '*');
        $response->header('Access-Control-Allow-Methods', 'GET');
        $response->header('Access-Control-Allow-Headers', 'Content-Type');

        // Return the response
        return $response->json(['success' => 'Product added to cart'], 200);
    }

    public function submitCart(Request $request)
    {
        // Retrieve the cart from the session
        $cart = $request->session()->get('Cart', []);

        // Get the customer details from the authenticated user
        $user = Auth::user();
        $customerName = $user->name;
        $customerEmail = $user->email;
        $customerPhone = $user->phone_number;

        // Create a new order entry
        $order = new Order();
        $order->save();

        foreach ($cart as $productId => $product) {
            // Create a new customer entry
            $customer = new Customer();
            $customer->name = $customerName;
            $customer->email = $customerEmail;
            $customer->phone_number = $customerPhone;
            $customer->save();

            // Create a new inventory entry
            $inventory = new Inventory();
            $inventory->product_id = $product->id;
            $inventory->order_id = $order->id;
            $inventory->payment_method_id = $request->input('payment_method_id');
            $inventory->shipping_status = $request->input('shipping_status');
            $inventory->customer_id = $customer->id;
            // Populate other inventory attributes as needed
            $inventory->save();

            // Create a new cart entry
            $cartItem = new Cart();
            $cartItem->session_id = $request->session()->getId();
            $cartItem->user_id = $user->id;
            $cartItem->product_id = $product->id;
            $cartItem->size = $product->size;
            $cartItem->quantity = $product->quantity;
            $cartItem->save();

            // Remove the product from the cart
            unset($cart[$productId]);
        }

        // Clear the cart from the session
        $request->session()->forget('cart');

        // Create a response instance
        $response = new Response();

        // Add the CORS headers
        $response->header('Access-Control-Allow-Origin', '*');
        $response->header('Access-Control-Allow-Methods', 'POST');
        $response->header('Access-Control-Allow-Headers', 'Content-Type');

        // Return the response
        return $response->json(['success' => 'Cart submitted successfully'], 200);
    }
}
