<?php

interface DeliveryServiceInterface {
    public function calculateShippingCost($sourceKladr, $targetKladr, $weight);
}
