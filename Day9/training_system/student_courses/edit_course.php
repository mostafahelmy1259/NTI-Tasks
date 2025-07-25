<?php
    require '../db.php';

    $id = $_GET['id'] ?? null;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        $hours = $_POST['hours'] ?? '';
        $price = $_POST['price'] ?? '';

        $update_query = "UPDATE courses SET title='$title', description='$description', hours='$hours', price='$price' WHERE id=$id";
        mysqli_query($conn, $update_query);
        header("Location: courses.php");
        exit;
    }

    $course = null;
    if ($id) {
        $res = "SELECT * FROM courses WHERE id = $id";
        $show = mysqli_query($conn, $res);
        if ($show) {
            $course = mysqli_fetch_assoc($show);
        }
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
            <h2>Edit a student</h2>

            <form class="m-4" method="post">
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($course['title'] ?? '') ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <input type="text" name="description" class="form-control" value="<?= htmlspecialchars($course['description'] ?? '') ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Hours</label>
                    <input type="number" name="hours" class="form-control" value="<?= htmlspecialchars($course['hours'] ?? '') ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Price</label>
                    <input type="number" name="price" class="form-control" value="<?= htmlspecialchars($course['price'] ?? '') ?>" required>
                </div>

                <div class="col-12">
                    <button class="btn btn-primary w-100" type="submit">Update Information</button>
                </div>
            </form>
        </div>
    </body>
</html>
