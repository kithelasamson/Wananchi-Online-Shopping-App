<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
Use App\Http\Controllers\OrdermanagementController;
use App\CustomerCareManagement\Controllers\CustomerController;
use App\CustomerCareManagement\Repositories\CustomerRepository;
use App\CustomerCareManagement\Services\CustomerService;
use App\inventory_management\Services\InventoryService;
use App\inventory_management\Controllers\InventoryController;
use App\inventory_management\Controllers\InventoryRepository;
use App\order_management\Controllers\OrderController;
use App\order_management\Repositories\OrderRepository;
use App\payment_management\Controllers\PaymentController;
use App\payment_management\Services\PaymentService;
use App\payment_management\Repositories\PaymentRepository;
use App\ReportingManagement\Controllers\ReportingController;
use App\ReportingManagement\Services\ReportingServices;
use App\ReportingManagement\Repositories\ReportingRepository;
use App\Shipping_services\Controllers\ShippingController;
use App\Shipping_services\Services\ShippingService;
use App\Shipping_services\Repositories\ShippingRepository;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register',[UserController::class,'register']);
Route::post('login',[UserController::class,'login']);
Route::post('addProduct',[ProductController::class,'addProduct']);
Route::GET('listProduct',[ProductController::class,'list']);
Route::DELETE('delete/{id}',[ProductController::class,'delete']);
Route::GET('product/{id}',[ProductController::class,'getProduct']);
Route::GET('search/{key}',[ProductController::class,'search']);

 Route::prefix('orders')->group(function () {
    Route::post('/placeholder', [OrderController::class, 'placeOrder']);
    Route::put('/{orderId}', [OrderController::class, 'updateOrder']);
    Route::get('/{orderId}', [OrderController::class, 'getOrderDetails']);
    Route::patch('/{orderId}/cancel', [OrderController::class, 'cancelOrder']);
    Route::patch('/{orderId}/ship', [OrderController::class, 'markOrderAsShipped']);
 });

Route::prefix('inventory')->group(function () {
    Route::post('/createInventory', [InventoryController::class, 'createInventory']);
    Route::put('/{inventoryId}', [InventoryController::class, 'updateInventory']);
    Route::get('/{inventoryId}', [InventoryController::class, 'getInventoryDetails']);
    Route::patch('/{inventoryId}/reduce', [InventoryController::class, 'reduceInventoryQuantity']);
});

Route::prefix('payments')->group(function () {
    Route::post('/processPayment', [PaymentController::class, 'processPayment']);
    Route::get('/{paymentId}', [PaymentController::class, 'getPaymentDetails']);
    Route::patch('/{paymentId}/refund', [PaymentController::class, 'refundPayment']);
});

Route::prefix('shipping')->group(function () {
    Route::get('/{orderId}', [ShippingController::class, 'getShippingDetails']);
    Route::patch('/{orderId}/status', [ShippingController::class, 'updateShippingStatus']);
});

Route::prefix('reports')->group(function () {
    Route::get('/sales', [ReportController::class, 'generateSalesReport']);
    Route::get('/products', [ReportController::class, 'generateProductReport']);
});

Route::prefix('customers')->group(function () {
    Route::post('create', [CustomerController::class, 'createCustomer']);
    Route::get('/{customerId}', [CustomerController::class, 'getCustomerDetails']);
    Route::put('/{customerId}', [CustomerController::class, 'updateCustomer']);
    Route::delete('/{customerId}', [CustomerController::class, 'deleteCustomer']);
});


Route::middleware('cors')->group(function () {
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/submit', [CartController::class, 'submitCart'])->name('cart.submit');
});






