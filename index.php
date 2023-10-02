<?php
require_once('FastDeliveryService.php');
require_once('SlowDeliveryService.php');
require_once('connection/connect.php');
global $conn;
global $error;

//For Test Interface
$fastDeliveryService = new FastDeliveryService('http://fastdelivery.com');
$slowDeliveryService = new SlowDeliveryService('http://slowdelivery.com');

$sourceKladr = '111111';
$targetKladr = '222222';
$weight = 5.0;

$results = [];

// Calculate and store shipping costs for Fast Delivery
$fastDeliveryResult = $fastDeliveryService->calculateShippingCost($sourceKladr, $targetKladr, $weight);
$results[] = $fastDeliveryResult;

// Calculate and store shipping costs for Slow Delivery
$slowDeliveryResult = $slowDeliveryService->calculateShippingCost($sourceKladr, $targetKladr, $weight);
$results[] = $slowDeliveryResult;

// Insert the results into the 'deliveries' table
foreach ($results as $result) {
    $sourceKladr = $conn->real_escape_string($sourceKladr);
    $targetKladr = $conn->real_escape_string($targetKladr);
    $weight = $conn->real_escape_string($weight);
    $price = $conn->real_escape_string($result['price']);
    $date = $conn->real_escape_string($result['date']);
    $error = isset($result['error']) ? $conn->real_escape_string($result['error']) : null;

    $insertQuery = "INSERT INTO deliveries (sourceKladr, targetKladr, weight, price, delivery_date, error)
                    VALUES ('$sourceKladr', '$targetKladr', $weight, $price, '$date', '$error')";

    if ($conn->query($insertQuery) === true) {
        echo "Data inserted successfully.\n" . "<br>" ;
    } else {
        echo "Error: " . $insertQuery . "<br>" . $conn->error . "\n";
    }
}

// Close the database connection
$conn->close();

// Display the results in an HTML table
echo '<table border="1">';
echo '<tr><th>Price</th><th>Date</th><th>Error</th></tr>';
foreach ($results as $result) {
    echo '<tr>';
    echo '<td>' . $result['price'] . '</td>';
    echo '<td>' . $result['date'] . '</td>';
    echo '<td>' . $result['error'] . '</td>';
    echo '</tr>';
}
echo '</table>';

