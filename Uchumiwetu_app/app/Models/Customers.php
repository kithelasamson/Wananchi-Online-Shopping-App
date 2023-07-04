<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['name', 'phone_number', 'email'];

    // Relationship with the Order model
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}

