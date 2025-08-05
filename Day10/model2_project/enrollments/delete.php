<?php
    header("Content-Type: application/json");
    include "../db.php";

    $data = json_decode(file_get_contents("php://input"), true);
    if (isset($data['id'])) {
        $id = $data['id'];
        $sql = "DELETE FROM courses WHERE id=$id";
        if (mysqli_query($conn, $sql)) {
            echo json_encode(["status" => "deleted"]);
        } else {
            echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
        }
    }else {
        echo json_encode(["status" => "error" , "message" => "id is required from form only"]);
    }

?>