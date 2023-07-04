<?php
namespace CustomerCareManagement\Repositories;

use App\Models\Customer;

class CustomerRepository
{
    public function getById($customerId)
    {
        // Retrieve customer by ID from the database
        return Customer::find($customerId);
    }

    public function create(array $data)
    {
        // Create a new customer in the database
        return Customer::create($data);
    }

    public function update($customerId, array $data)
    {
        // Update an existing customer in the database
        $customer = Customer::find($customerId);
        $customer->update($data);

        return $customer;
    }

    public function delete($customerId)
    {
        // Delete a customer from the database
        return Customer::destroy($customerId);
    }
}
