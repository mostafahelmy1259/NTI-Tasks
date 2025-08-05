<?php
    header("Content-Type: application/json");

    $method = $_SERVER["REQUEST_METHOD"];

    switch ($method) {
        case 'GET':
            include 'get.php';
            break;
        
        case 'POST':
            include 'post.php';
            break;

        case 'PUT':
            include 'put.php';
            break;

        case "DELETE":
            include 'delete.php';
            break;
        
        default:
            http_response_code(404);
            echo json_encode(array("message" => "Not Found"));
    }
?>