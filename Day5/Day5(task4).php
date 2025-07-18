<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
        //print_r($_FILES);
        $name = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];
        $allowed = ['png', 'jpg'];
        $ext = (explode('.', $name)[ count(explode('.', $name)) - 1]);
        $typ = (explode('/' , $_FILES['image']['type'])[0]);
        if (in_array($ext, $allowed) && $typ == 'image') {
            move_uploaded_file($tmp, "upload/$name");
            echo "<img src='upload/$name' class='img-thumbnail m-3' width='200' height='200'>";
        } else{
            echo '<div class="alert alert-danger m-3">Invalid file type</div>';
        }
    }

?>


<!DOCTYPE html>
<html>
  <head>
    <title>Task 4</title>
    <link href="css/bootstrap.css" rel="stylesheet">
  </head>
  <body class="bg-info">
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
      <form method='POST' enctype='multipart/form-data' class="mx-auto p-4 border rounded bg-white p-3" style="max-width: 400px;">
        <h3 class="text-center mb-4"><strong>Upload File</strong></h3>
        <div class="mb-3">
          <label for="formFile" class="form-label">Upload File</label>
          <input class="form-control" type="file" name="image" id="formFile">
        </div>
        <button type="submit" class="btn btn-primary w-100">Submit</button>
      </form>     
    </div>
  </body>
</html>
