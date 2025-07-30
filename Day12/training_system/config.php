<?php
// Database configuration - update with your credentials
define('DB_HOST', 'localhost');
define('DB_NAME', 'training_system');
define('DB_USER', 'root');
define('DB_PASS', '');

// JWT secret key
define('JWT_SECRET', 'your_secret_key_here');

// Connect to database using PDO
function getDBConnection() {
    static $conn;
    if ($conn === null) {
        try {
            $conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Database connection failed']);
            exit;
        }
    }
    return $conn;
}
?>
