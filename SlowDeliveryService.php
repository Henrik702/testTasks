<?php

require_once('DeliveryServiceInterface.php');

class SlowDeliveryService implements DeliveryServiceInterface {

    private $base_url;

    public function __construct($base_url) {
        $this->base_url = $base_url;
    }

    public function calculateShippingCost($sourceKladr, $targetKladr, $weight) {
        $coefficient = 1.5;
        $date = date('Y-m-d', strtotime("+7 days"));
        $error = null;

        return [
            'price' => 150 * $coefficient,
            'date' => $date,
            'error' => $error,
        ];
    }
}
