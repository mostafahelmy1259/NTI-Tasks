<?php
    header("Content-Type: application/json");
    include "../db.php";
    // $_GET[''];
    $data = json_decode(file_get_contents("php://input"), true);
    if (isset($data['title'])) {
        $title = $data['title'];
        $desc = $data['description'];
        $hours = $data['hours'];
        $price = $data['price'];

        $sql = "INSERT INTO courses (title, description, hours, price) VALUES ('$title', '$desc', '$hours', '$price')";
        if (mysqli_query($conn, $sql)) {
            echo json_encode(["status" => "inserted"]);
        } else {
            echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
        }
    } else {
        echo json_encode(["status" => "error" , "message" => "title is required from form only"]);
    }

?>