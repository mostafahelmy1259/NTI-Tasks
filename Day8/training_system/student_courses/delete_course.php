<?php
    require "../db.php";

    $id = $_GET['id'] ?? null;

    if ($id) {
        $delete_query = "DELETE FROM courses WHERE id = '$id'";
        mysqli_query($conn, $delete_query);
    }

    header("Location: courses.php");
    exit;
?>
