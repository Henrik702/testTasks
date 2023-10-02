<?php
// Database connection settings
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'testtasks';

// Connect to the database
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
