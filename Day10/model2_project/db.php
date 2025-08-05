<?php 
    $conn = mysqli_connect("localhost", "root", "", "training_system");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    // if (session_status() !== PHP_SESSION_ACTIVE) session_start();

?>