<?php
    session_start();
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    $_SESSION["email"] = $email;
    $_SESSION["password"] = $password;


    $allowed_users = [
        ['email' => "user@example.com", 'password' => "123456"],
        ['email' => "test@example.com", 'password' => "test123"]
    ];

    $is_allowed = false;
    foreach ($allowed_users as $user) {
        if ($email === $user['email'] && $password === $user['password']) {
            $is_allowed = true;
            break;
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <link href="../css/bootstrap.css" rel="stylesheet">
    </head>
    <body class="p-4 bg-dark">
        <div class="container">
            <div class="row mt-3 d-flex justify-content-center">
                <div class="col-md-6 p-4 mt-5 ml-4 shadow bg-dark rounded-4">

                    <?php if ($is_allowed): ?>
                        <div class="alert alert-success" role="alert">WELCOME, Admin (Admin).</div>

                        <div class="gap-3 ml-4 d-flex justify-content-center text-center">
                            <a href="login.php" class="btn btn-primary col-md-4">Logout</a>
                            <a href="products.php" class="btn btn-primary col-md-3">Products</a>
                            <a href="signup.php" class="btn btn-primary col-md-4">Create Account</a>
                        </div>

                    <?php elseif (!empty($email) || !empty($password)): ?>

                        <form class="m-4" method="POST">
                            <div class="alert alert-danger ">
                                ⚠ Wrong Email or Pass
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-white">Email address</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-white">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100" type="submit">Submit</button>
                            </div>
                            <h6 class="text-center text-secondary mt-3">admin@example.com / 123456</h6>
                            <h6 class="text-center text-secondary">test@example.com / test123</h6>
                        </form>
                    <?php else: ?>
                        <form class="m-4" method="POST">
                            <div class="mb-3">
                                <label class="form-label text-white">Email address</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-white">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100" type="submit">Submit</button>
                            </div>
                            <h6 class="text-center text-secondary mt-3">admin@example.com / 123456</h6>
                            <h6 class="text-center text-secondary">test@example.com / test123</h6>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </body>
</html>
                                