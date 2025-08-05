<?php
    header("Content-Type: application/json");
    include "../db.php";

    $theALlData = file_get_contents("php://input"); // get the data from the request
    // $theAllData = $_POST;
    $data = json_decode($theALlData, true);

    if (isset($data['id'])) {
        $id = $data['id'];
        $name = $data['name'];
        $email = $data['email'];
        $phone = $data['phone'];
        $date_of_birth = $data['date_of_birth'];

        $sql = "UPDATE courses SET name='$name' , email='$email' , phone='$phone', date_of_birth='$date_of_birth' WHERE id=$id";
        if (mysqli_query($conn, $sql)) {
            echo json_encode(["status" => "updated"]);
        } else {
            echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
        }
    }else {
        echo json_encode(["status" => "error" , "message" => "id is required from form only"]);
    }
?>