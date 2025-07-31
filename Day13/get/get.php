<?php
    header("Content-Type: application/json");
    require_once("../db.php");

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $stmt = mysqli_prepare($conn, "SELECT * FROM courses WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $course = mysqli_fetch_assoc($result);
            echo json_encode($course);
        } else {
            echo json_encode(array("message" => "Course not found"));
        }
    } else {
        $courses = [];
        $sql = "SELECT * FROM courses";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $courses[] = $row;
            }
        } else {
            $courses[] = array("error" => "No courses found");
        }

        echo json_encode($courses);
    }

?>