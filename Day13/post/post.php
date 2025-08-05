<?php 
    header("Content-Type: application/json");
    require_once("../db.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);

        $title = $data['title'] ?? null;
        $description = $data['description'] ?? null;
        $hours = $data['hours'] ?? null;
        $price = $data['price'] ?? null;


        if (!$title || !$description || !$hours || !$price) {
            echo json_encode(['status' => 'error', 'message' => 'All fields are required']);
            exit;
        }

        $com = "INSERT INTO courses (title, description, hours, price) VALUES ('$title', '$description', '$hours', '$price')";

        if (mysqli_query($conn, $com)) {
            echo json_encode(['status' => 'success', 'message' => 'Course added successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to add course']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    }

?>