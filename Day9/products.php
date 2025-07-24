<?php
    $errors = [];
    $uploaded = [];
    $product_name = '';
    $description = '';

    session_start();              
    require ("db.php");
    $email = isset($_SESSION["email"]) ? $_SESSION["email"] : "guest";

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["images"])) {
        
        $product_name = $_POST['product_name'] ?? '';
        $description = $_POST['description'] ?? '';
        $command = "UPDATE admin SET product_name = '$product_name', description = '$description' WHERE email = '$email'";
        mysqli_query($conn, $command);
        $allowed_ext = ["png", "jpg", "jpeg"];
        $maxSize = 3 * 1024 * 1024;
        $file = $_FILES["images"];

        for ($i = 0; $i < count($file["name"]); $i++) {
            $name = basename($file["name"][$i]);
            $tmp = $file["tmp_name"][$i];
            $size = $file["size"][$i];
            $type = explode("/", $file["type"][$i])[0];
            $extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));
            $order = $i + 1;

            if (!in_array($extension, $allowed_ext)) {
                $errors[] = "photo $order <br> photo extension ( $name ) not allowed";
            }
            if ($size > $maxSize) {
                $errors[] = "Photo $order <br> Photo ( $name ) its size more than 3MB";
            }
            if ($type != "image") {
                $errors[] = "The photo $order <br> ($name ) not an image";
            }
            if (empty($errors)) {
                $uploaded[] = ["name" => $name, "tmp" => $tmp];
            }
        }
    }

?>

<!DOCTYPE html>
<html>

  <head>
    <meta charset="UTF-8">
    <title>Products page!</title>
    <link href="css/bootstrap.css" rel="stylesheet">
  </head>

  <body class="p-4 bg-dark">
    <div class="container">
      <div class="row mt-3 d-flex justify-content-center">
        <div class="col-md-6 p-4 bg-white rounded-4">
          <form method="post" enctype="multipart/form-data">
            <div class="col-md-12 d-flex justify-content-center ">
                <div class="col-md-6 me-2 ">
                    <label class="form-label text-dark">Product Name:</label>
                    <input type="text" class="form-control " name="product_name" required
                    value="<?php echo htmlspecialchars($product_name); ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label text-dark">Description:</label>
                    <input type="text" class="form-control " name="description" required
                    value="<?php echo htmlspecialchars($description); ?>">
                </div>
            </div>
            <div class="mb-3 mt-3 col-md-12">
              <label class="form-label text-dark">Product Images:</label>
              <input class="form-control" type="file" name="images[]" multiple required>
            </div>
            <div class="text-center">
              <button type="submit" class="box col-6 text-center w-50 mb-3 btn btn-primary ">Add Product</button>
            </div>
          </form>
          <?php if (!empty($errors)): ?>
            <div class='alert alert-danger mt-2'>
              <ul>
                <?php foreach ($errors as $err): ?>
                <li><?php echo $err; ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <hr class="mt-5 text-secondary">
    </hr>
    <div class="container bg-dark">
      <div class="row d-flex justify-content-center ">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($errors)) {
          foreach ($uploaded as $file) {
            $extension = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
            $new_name = $file["name"];
            $upload_path = "uploads/" . $new_name;
            $en_upload_path = base64_encode($upload_path);
            move_uploaded_file($file["tmp"], "../" . $upload_path);

            // Update admin table to set img_path for the logged-in user
            $stmt = mysqli_prepare($conn, "UPDATE admin SET img_path = ? WHERE email = ?");
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "ss", $en_upload_path, $email);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            }

            echo "<div class='card m-2 mb-3 bg-secondary' style='width: 18rem; display:inline-block;'>";
            $de_upload_path = base64_decode($en_upload_path);
            echo "<img src='" . htmlspecialchars($de_upload_path) . "' class='img-thumbnail card-img-top mt-3' width='200'>";
            echo "<div class='card-body'>";
            echo "<p class='text-white'>" . htmlspecialchars($product_name) . "</p>";
            echo "<p class='card-text text-white'>" . htmlspecialchars($description) . "</p>";
            echo "<p class='card-text text-white '>" . 'added by <a href="#" class="text-decoration-underline text-dark">' . htmlspecialchars($email) . '</a>' . '</p>';
          }
        }
        ?>
      </div>
    </div>
  </body>
</html>
