<?php
    //session_start();
    require ("db.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        // Hash the password before storing
        $password = password_hash($password, PASSWORD_DEFAULT);
        $command = "INSERT INTO admin (name, email, password) VALUES ('$name', '$email', '$password')";
        $result = mysqli_query($conn, $command);
        if ($result) {
            $is_valid = true;
        } else {
            $is_valid = false;
            $error_message = mysqli_error($conn);
        }
    }
?>

<!DOCTYPE html>
<html>

    <head>
        <link href="css/bootstrap.css" rel="stylesheet">
    </head>
    <body class="p-4 bg-dark">
        <div class="container">
            
            <div class="row mt-3 justify-content-center">
                <div class="col-md-6 p-4 rounded-4 bg-white text-white">
                    <form class="m-4" method="post" enctype="multipart/form-data">
                        <div class="col-md-12 mb-4">
                            <!-- <?php if ($is_valid): ?>
                                <div class="alert alert-success text-center" role="alert">
                                    ✅ Account created successfully!
                                </div>
                            <?php endif; ?> -->
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-black">Name:</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-black">Email address:</label>
                            <input type="email" name="email"  class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-black">Password:</label>
                            <input type="password" name="password"  class="form-control"
                                required>
                        </div>

                        <div class="col-12">
                            <button class="btn btn-primary w-100" type="submit">Sign up</button>
                        </div>
                    </form>
                    <h6 class="text-dark">have an account? <a href="login.php" class="md-3">Log in</a></h6>
                </div>
            </div>
        </div>
    </body>

</html>
