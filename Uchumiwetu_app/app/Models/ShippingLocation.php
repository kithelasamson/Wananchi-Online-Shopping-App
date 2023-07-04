<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingLocation extends Model
{
    protected $fillable = ['address', 'city', 'country'];

    // Relationship with the Order model
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
