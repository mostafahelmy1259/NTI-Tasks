<?php
    session_start();
    require("db.php");

    $is_allowed = false;
    $error_message = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $command = "SELECT email, password, role_id FROM admin WHERE email = '$email'";
        $result = mysqli_query($conn, $command);

        if ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row['password'])) {
                $_SESSION['email'] = $email;
                $_SESSION['role_id'] = $row['role_id'];
                $is_allowed = true;
            } else {
                $error_message = "Invalid email or password.";
            }
        } else {
            $error_message = "Invalid email or password.";
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
            <div class="row mt-3 d-flex justify-content-center">
                <div class="col-md-6 p-4 mt-5 ml-4 shadow bg-white rounded-4">

                    <?php if ($is_allowed): ?>
                        <?php if ($_SESSION['role_id'] == 1){ ?>
                            <div class="alert alert-success" role="alert">WELCOME, Moustafa (Admin).</div>
                        <?php } else { ?>
                            <div class="alert alert-success" role="alert">WELCOME, User (User).</div>
                        <?php } ?>
                        <div class="gap-3 ml-4 d-flex justify-content-center text-center">
                            <a href="login.php" class="btn btn-primary col-md-4">Logout</a>
                            <a href="products.php" class="btn btn-primary col-md-3">Products</a>
                            <a href="signup.php" class="btn btn-primary col-md-4">Create Account</a>
                        </div>
                    

                    <?php elseif (!empty($error_message)): ?>
                        <div class="alert alert-danger" role="alert"><?php echo htmlspecialchars($error_message); ?></div>
                    <?php else: ?>

                        <form class="m-4" method="POST">
                            <div class="mb-3">
                                <label class="form-label text-black">Email address:</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-black">Password:</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100" type="submit">Submit</button>
                            </div>
                            <!-- <h6 class="text-center text-secondary mt-3">admin@example.com / 123456</h6>
                            <h6 class="text-center text-secondary">test@example.com / test123</h6> -->
                        </form>
                        <h6 class="text-dark">Don't have an account? <a href="signup.php" class="md-3">Sign up</a></h6>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </body>
</html>
                                