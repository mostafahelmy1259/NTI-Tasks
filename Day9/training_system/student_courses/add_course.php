<?php
    require '../db.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        $hours = $_POST['hours'] ?? '';
        $price = $_POST['price'] ?? '';

        $com = "INSERT INTO courses (title, description, hours, price) VALUES ('$title', '$description', '$hours', '$price')";
        mysqli_query($conn, $com);
    }
?>


<!DOCTYPE html>
<html>
<head>
    <link href="../../css/bootstrap.css" rel="stylesheet">
    <title>Project</title>
</head>
<body class="bg-light">
    <?php include("../navbar.php"); ?>
    <div class="container mt-3">    
        <form class="m-4" method="post" enctype="multipart/form-data">
            
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <input type="text" name="descriptoin" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Hours</label>
                <input type="number" name="hours" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Price</label>
                <input type="number" name="price" class="form-control" required>
            </div>

            <div class="col-12">
                <button class="btn btn-primary w-100" type="submit">Add Course</button>
            </div>
        </form>
    </div>
</body>
</html>
