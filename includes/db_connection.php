<?php

session_start();

// Database configuration
$host = 'localhost';
$db = 'furniture_db';
$user = 'root';
$pass = 'Ashu123';

try {
    // Enable exception mode for mysqli
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    // Create connection
    $conn = new mysqli($host, $user, $pass, $db);

    // Set charset to avoid charset-related issues
    $conn->set_charset("utf8mb4");
} catch (mysqli_sql_exception $e) {
    // Log the specific error (could be stored in a log file for admin reference)
    error_log("Database connection error: " . $e->getMessage());

    // Return a user-friendly message
    echo json_encode(["status" => "error", "message" => "Unable to connect to the database. Please try again later."]);
    exit; // Stop further script execution
}
?>
