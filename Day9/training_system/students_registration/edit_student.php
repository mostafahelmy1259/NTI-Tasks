<?php
    require '../db.php';

    $id = $_GET['id'] ?? null;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $date_of_birth = $_POST['date_of_birth'] ?? '';

        $update_query = "UPDATE students SET name='$name', email='$email', phone='$phone', date_of_birth='$date_of_birth' WHERE id=$id";
        mysqli_query($conn, $update_query);
        header("Location: students.php");
        exit;
    }

    $student = null;
    if ($id) {
        $res = "SELECT * FROM students WHERE id = $id";
        $show = mysqli_query($conn, $res);
        if ($show) {
            $student = mysqli_fetch_assoc($show);
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
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($student['name'] ?? '') ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($student['email'] ?? '') ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="number" name="phone" class="form-control" value="<?= htmlspecialchars($student['phone'] ?? '') ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Date of Birth</label>
                    <input type="date" name="date_of_birth" class="form-control" value="<?= htmlspecialchars($student['date_of_birth'] ?? '') ?>" required>
                </div>

                <div class="col-12">
                    <button class="btn btn-primary w-100" type="submit">Update Information</button>
                </div>
            </form>
        </div>
    </body>
</html>
