<?php
// Start session if not already started
 if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// Database credentials
$host = 'localhost';
$db   = 'scriptaid';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

// DSN and PDO setup
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Enable exceptions
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Fetch as associative arrays
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Use real prepared statements
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}
