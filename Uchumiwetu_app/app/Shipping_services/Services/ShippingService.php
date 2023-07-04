<?php

namespace App\ShippingManagement\Services;

use App\ShippingManagement\Repositories\ShippingRepository;

class ShippingService
{
    protected $shippingRepository;

    public function __construct(ShippingRepository $shippingRepository)
    {
        $this->shippingRepository = $shippingRepository;
    }

    public function getShippingDetails($orderId)
    {
        // Retrieve the shipping details from the repository
        return $this->shippingRepository->getShippingDetails($orderId);
    }

    public function updateShippingStatus($orderId, $status)
    {
        // Update the shipping status in the repository
        return $this->shippingRepository->updateShippingStatus($orderId, $status);
    }

}
