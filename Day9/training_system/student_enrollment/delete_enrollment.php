<?php
    require_once("../db.php");


    $id = $_GET['id'] ?? null;

    if ($id) {
        $delete_query = "DELETE FROM enrollments WHERE id = '$id'";
        mysqli_query($conn, $delete_query);
        
    }

    header("Location: enrollments.php");
    exit;


?>