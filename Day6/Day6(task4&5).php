<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $today = date("l jS \of F Y h:i:s A");
        $folder = "uploads/$today";
        $logFile = fopen("logs/logfile.txt", "a");
        fwrite($logFile, "File uploaded at $today\n");
        fclose($logFile);
        if (!is_dir($folder)) mkdir($folder, 0777, true);
        //if (!is_dir($folder2)) mkdir($folder2, 0777, true);

        $filename = basename($_FILES['image']['name']);

        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $new_name = uniqid("img_", true) . "." . $extension;
        $target = $folder . "/" . time() . "_" . $new_name;

    
        $allowed_ext = ["image/jpeg", "image/png"];
        if (in_array($_FILES['image']['type'], $allowed_ext)) {
            move_uploaded_file($_FILES['image']['tmp_name'], $target);
            echo "<div class='alert alert-success mt-3' style='width: 90%; max-width: 900px; margin: 10px auto'>File uploaded to: $target</div>";
        } else {
            echo "<div class='alert alert-danger mt-3' style='width: 90%; width: 900px; margin: 10px auto'>Invalid type of image check it out!</div>";
        }
    }
     
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Task 4&5</title>
        <link href="css/bootstrap.css" rel="stylesheet">
    </head>
    <body class="bg-success">
        <div class="row mt-5 d-flex justify-content-center">
            <div class="col-md-8">
                <form method="POST" enctype="multipart/form-data" class="input-group">
                <input class="form-control" type="file" name="image" id="formFile">
                <button class="btn btn-dark border-primary text-primary" type="submit" id="button-addon1">Upload</button>
                </form>
            </div>
        </div>  
    </body>
</html>