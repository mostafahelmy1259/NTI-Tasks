<?php
// session_start();

// // Check if user is logged in by verifying session variables
// if (!isset($_SESSION["email"]) || !isset($_SESSION["password"])) {
//     // Not logged in, redirect to login page
//     header("Location: login.php");
//     exit();
// }
include_once("index.php");
// You can add additional checks here to verify if the session email and password are valid
// For simplicity, we assume if session variables exist, user is logged in

?>

<!DOCTYPE html>
<html>
<head>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <title>Dashboard</title>
</head>
<body class="bg-light">
    
        <h3 class="mt-5 container">Welcome to your dashboard, <?= $_SESSION["email"];?>!</h3>
        
        
    </div>
</body>
</html>
