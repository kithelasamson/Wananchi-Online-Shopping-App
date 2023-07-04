<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['product_id', 'customer_id', 'payment_method_id', 'shipping_location_id', 'quantity'];

    // Relationship with the Customer model
    public function customer()
    {
        return $this->belongsTo(Customers::class);
    }

    // Relationship with the PaymentMethod model
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    // Relationship with the ShippingLocation model
    public function shippingLocation()
    {
        return $this->belongsTo(ShippingLocation::class);
    }

    // Relationship with the Product model
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
