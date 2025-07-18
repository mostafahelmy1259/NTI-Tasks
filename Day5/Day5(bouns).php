<?php
    $allowed = ["jpg", "jpeg", "png"];
    $allowedSize = 4 * 1024 * 1024;
    $allowedTypes = ["image", "wave"];
    $errors = [];
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
        //print_r($_FILES);
        foreach ($_FILES['image']['name'] as $key => $name) {
            $file = $_FILES['image']['tmp_name'][$key];
            $file_size= $_FILES['image']['size'][$key];
            $file_type = mime_content_type($file);
            $file_extension = pathinfo($name, PATHINFO_EXTENSION);

            if (!in_array(strtolower($file_extension), $allowed)) {
                $errors[] = "File $name type not allowed $file_extension";
            }

            if ($file_size > $allowedSize) {
                $errors[] = "File $name size is too large " . round($file_size / 1024 / 1024, 2) . " MB";
            }

            $type_main = explode('/', $file_type)[0];
            if (!in_array($type_main, $allowedTypes)) {
                $errors[] = "File $name MIME type not allowed ($file_type)";
            }
        }

        if (!empty($errors)){
            echo '<div class="alert alert-danger" role="alert">';
            echo "<strong>Failed to upload files!</strong><br>";
            foreach ($errors as $error) {
                echo htmlspecialchars($error) . "<br>";
            }
            echo '</div>';
        } else {
            foreach($_FILES['image']['name'] as $key => $name) {
                $filetmp = $_FILES['image']['tmp_name'][$key];
                $file_extension = pathinfo($name, PATHINFO_EXTENSION);
                $new_name = uniqid('img_' , true) . '.' . $file_extension;
                move_uploaded_file($filetmp, "uploads/$new_name");
            }
            echo '<div class="alert alert-success" role="alert">Files uploaded successfully!</div>';
        }
    }
?>


<!DOCTYPE html>
<html>
  <head>
    <title>bouns task</title>
    <link href="css/bootstrap.css" rel="stylesheet">
  </head>
  <body class="bg-success">
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
      <form method='POST' enctype='multipart/form-data' class="mx-auto p-4 border rounded bg-white p-3" style="max-width: 400px;">
        <h3 class="text-center mb-4"><strong>Upload File</strong></h3>
        <div class="mb-3">
          <label for="formFile" class="form-label">Upload File</label>
          <input class="form-control" type="file" name="image[]" multiple id="formFile">
        </div>
        <button type="submit" class="btn btn-primary w-100">Submit</button>
      </form>     
    </div>
  </body>
</html>