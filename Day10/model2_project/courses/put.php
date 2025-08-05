<?php
    header("Content-Type: application/json");
    include "../db.php";

    $theALlData = file_get_contents("php://input"); // get the data from the request
    // $theAllData = $_POST;
    $data = json_decode($theALlData, true);

    if (isset($data['id'])) {
        $id = $data['id'];
        $title = $data['title'];
        $desc = $data['description'];
        $hours = $data['hours'];
        $price = $data['price'];

        $sql = "UPDATE courses SET title='$title' , description='$desc' , hours='$hours', price='$price' WHERE id=$id";
        if (mysqli_query($conn, $sql)) {
            echo json_encode(["status" => "updated"]);
        } else {
            echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
        }
    }else {
        echo json_encode(["status" => "error" , "message" => "id is required from form only"]);
    }
?>