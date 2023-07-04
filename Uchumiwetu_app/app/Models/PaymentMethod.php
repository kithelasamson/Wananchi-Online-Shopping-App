<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $fillable = ['name'];

    // Relationship with the Order model
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
