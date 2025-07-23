<?php
    require '../db.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $date_of_birth = $_POST['date_of_birth'] ?? '';

        $com = "INSERT INTO students (name, email, phone, date_of_birth) VALUES ('$name', '$email', '$phone', '$date_of_birth')";
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
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="<?php echo $email; ?>" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="number" name="phone" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Data of Birth</label>
                <input type="text" name="date_of_birth" class="form-control" required>
            </div>

            <div class="col-12">
                <button class="btn btn-primary w-100" type="submit">Add Student</button>
            </div>
        </form>
    </div>
</body>
</html>
