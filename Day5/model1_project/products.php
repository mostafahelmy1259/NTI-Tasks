<?php
  $errors = [];
  $uploaded = [];
  $product_name = '';
  $description = '';

  session_start();
  $email = isset($_SESSION["email"]) ? $_SESSION["email"] : "guest";

  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["images"])) {

    $allowed_ext = ["png", "jpg", "jpeg"];
    $maxSize = 3 * 1024 * 1024;
    $file = $_FILES["images"];

    $product_name = $_POST['product_name'] ?? '';
    $description = $_POST['description'] ?? '';

    for ($i = 0; $i < count($file["name"]); $i++) {
      $name = basename($file["name"][$i]);
      $tmp = $file["tmp_name"][$i];
      $size = $file["size"][$i];
      $type = explode("/", $file["type"][$i])[0];
      $extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));
      $order = $i + 1; // we should increment the order number by 1 to display in the right way, because the loop iterator starts from 0.

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
    <link href="../css/bootstrap.css" rel="stylesheet">
  </head>

  <body class="p-4 bg-dark">
    <div class="container">
      <div class="row mt-3 d-flex justify-content-center">
        <div class="col-md-6 p-4 bg-dark rounded-4">
          <form method="post" enctype="multipart/form-data">
            <div class="col-md-12 d-flex justify-content-center ">
                <div class="col-md-6 me-2 ">
                    <label class="form-label text-white">Product Name</label>
                    <input type="text" class="form-control " name="product_name" required
                    value="<?php echo $product_name; ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label text-white">Description</label>
                    <input type="text" class="form-control " name="description" required
                    value="<?php echo $description; ?>">
                </div>
            </div>
            <div class="mb-3 mt-3 col-md-12">
              <label class="form-label text-white">Product Images</label>
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
          $count = count($uploaded);
          foreach ($uploaded as $file) {
            $extension = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
            $new_name = uniqid('img_', true) . '.' . $extension;
            $upload_path = "../uploads/" . $new_name;
            move_uploaded_file($file["tmp"], $upload_path);
            echo "<div class='card m-2 mb-3 bg-secondary' style='width: 18rem; display:inline-block;'>";
            echo "<img src='$upload_path' class='img-thumbnail card-img-top mt-3' width='200'>";
            echo "<div class='card-body'>";
            echo "<p class='text-white'>" . htmlspecialchars($product_name) . "</p>";
            echo "<p class='card-text text-white'>" . htmlspecialchars($description) . "</p>";
            echo "<p class='card-text text-white '>" . 'added by <a href="#" class="text-decoration-underline text-dark">' . htmlspecialchars($email) . '</a>' . '</p>';
            echo "</div></div>";
          }
        }
        ?>
      </div>
    </div>
  </body>
</html>