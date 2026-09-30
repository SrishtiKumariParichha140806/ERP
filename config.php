<?php
// Configuration settings for College ERP System
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'erp_college');

define('SITE_NAME', 'CSI Ewart Women\'s Christian College');
define('SITE_SHORT', 'CSI Ewart ERP');
define('COLLEGE_ADDRESS', 'No. 9, Dr. Gurusamy Road, Chetpet, Chennai, Tamil Nadu 600031');

// Database connection
$conn = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    // Fallback if DB isn't imported yet or connection fails
    $db_connected = false;
    $db_error = $conn->connect_error;
} else {
    $db_connected = true;
    $conn->set_charset("utf8mb4");
}

// Base URL detection
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'];
$script_name = $_SERVER['SCRIPT_NAME'];
$base_dir = preg_replace('#/(admin|staff|student|includes|database).*$#', '', dirname($script_name));
$base_url = $protocol . '://' . $host . rtrim($base_dir, '/') . '/';
define('BASE_URL', $base_url);
?>
