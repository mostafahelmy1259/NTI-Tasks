<?php
    session_start();
    // Check if user is logged in by verifying session variables
    if (!isset($_SESSION["email"]) || !isset($_SESSION["password"])) {
        header("Location: login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <title>Project</title>
</head>
<body class="bg-light">
    <div class="">
        <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="dashboard.php">Dashboard</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="upload.php">Uplaod Products</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="gallery.php">Gallery</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="view_uploads.php">Image Log Table</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="view_logins.php">Login Log Table</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <p class="text-white">Welcome, <?= $_SESSION["email"] . " | " . " ";?></p>
                    <a href="login.php" class="btn btn-dark border-white text-white">Logout</a>
                </form>
                </div>
            </div>
        </nav>
        
        
        
    </div>
</body>
</html>