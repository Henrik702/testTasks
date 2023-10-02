<?php

require_once('DeliveryServiceInterface.php');

class FastDeliveryService implements DeliveryServiceInterface {

    private $base_url;

    public function __construct($base_url) {
        $this->base_url = $base_url;
    }

    public function calculateShippingCost($sourceKladr, $targetKladr, $weight) {
        $price = 100.0;
        $date = date('Y-m-d', strtotime("+2 days"));
        $error = null; // No errors

        return [
            'price' => $price,
            'date' => $date,
            'error' => $error,
        ];
    }
}
