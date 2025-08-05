<?php
    header("Content-Type: application/json");
    include "../db.php";

    $courses = [];

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $stmt = mysqli_prepare($conn, "SELECT * FROM courses WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id); // i معناها integer
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    }else {
        $sql = "SELECT * FROM courses";
        $result = mysqli_query($conn, $sql);
    }

    while ($row = mysqli_fetch_assoc($result)) {
        $courses[] = $row;
    }

    echo json_encode($courses);
?>