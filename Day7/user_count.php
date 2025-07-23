<?php
    session_start();
    $_SESSION['visits'] = ($_SESSION['visits'] ?? 0) + 1;
    
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Visits Counter</title>
        <link rel="stylesheet" href="css/bootstrap.css">

    </head>
    <body>
        <?php include "test.php"; ?>
        <?php require "test.php"; ?>
        <p class="m-3">Page Visits: <span class="badge bg-primary"><?= $_SESSION['visits'] ?></span></p>
    </body>
</html>
