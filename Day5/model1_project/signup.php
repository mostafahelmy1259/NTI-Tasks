<?php
    session_start();
    $email = isset($_SESSION["email"]) ? $_SESSION["email"] : "";
    $password = isset($_SESSION['password']) ? $_SESSION['password'] : "";
    $NAME = $_POST["name"] ?? "";
    $EMAIL = $_POST["email"] ?? "";
    $is_valid = false;


    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["images"])) {
        $name = $_FILES["images"]["name"];
        $tmp = $_FILES["images"]["tmp_name"];

        $file_extension = pathinfo($name, PATHINFO_EXTENSION);
        $typ = explode("/", $_FILES["images"]["type"])[0];
        $is_allowed = ["png", "jpg", "jpeg"];

        if (in_array($file_extension, $is_allowed) && $typ == "image") {
            $new_name = uniqid('img_' , true) . '.' . $file_extension;
            move_uploaded_file($tmp, "../uploads/$new_name");
            $is_valid = true;
            $_SESSION["email"] = $_POST["email"];
            $_SESSION["password"] = $_POST["password"];
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
            <div class="row mt-3 justify-content-center">
                <div class="col-md-3 p-4 rounded-4 bg-dark">
                    <?php if ($is_valid): ?>
                        <div class="card mb-4">
                            <img src="../uploads/<?php echo $new_name; ?>" class="img-thumbnail card-img-top mt-3">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $NAME ?></h5>
                                <p class="card-text"><?php echo $EMAIL ?></p>
                                <a href="products.php" class="btn btn-primary">Go to Products</a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row mt-3 justify-content-center">
                <div class="col-md-6 p-4 rounded-4 bg-dark text-white">
                    <form class="m-4" method="post" enctype="multipart/form-data">
                        <div class="col-md-12 mb-4">
                            <?php if ($is_valid): ?>
                                <div class="alert alert-success text-center" role="alert">
                                    ✅ Account created successfully!
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" name="email" value="<?php echo $email; ?>" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" value="<?php echo $password; ?>" class="form-control"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Profile Image</label>
                            <input class="form-control" type="file" name="images" required>
                        </div>

                        <div class="col-12">
                            <button class="btn btn-primary w-100" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>

</html>