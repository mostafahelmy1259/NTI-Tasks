<?php
    header("Content-Type: application/json");
    include "../db.php";
    // $_GET[''];
    $data = json_decode(file_get_contents("php://input"), true);
    if (isset($data['name'])) {
        $name = $data['name'];
        $email = $data['email'];
        $phone = $data['phone'];
        $date_of_birth = $data['date_of_birth'];

        $sql = "INSERT INTO courses (name, email, phone, date_of_birth) VALUES ('$name', '$email', '$phone', '$date_of_birth')";
        if (mysqli_query($conn, $sql)) {
            echo json_encode(["status" => "inserted"]);
        } else {
            echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
        }
    } else {
        echo json_encode(["status" => "error" , "message" => "name is required from form only"]);
    }

?>