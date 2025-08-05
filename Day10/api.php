<?php

    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: * ");

    if ($_SERVER["SERVER_NAME"] == '127.0.0.1'){
        // print_r($_SERVER);
        $data = ["data" => [["message" => "Wrong try to get data"]], "connection" => false, "message" => "Wrong"];
        echo json_encode($data);
        } else {
            $d = [
                "data" => [
                    [
                        "name" => "John",
                        "age" => 30,
                        "city" => "New York"
                    ],[
                        "name" => "Jane",
                        "age" => "26",
                        "city" => "Los Angeles"
                    ]
    
                    
                    ],
                    
                    "connection" => true,
                    "message" => "Data retrieved successfully"
                
            ];$data = json_encode($d);
            echo $data;
        
    }

    

?>