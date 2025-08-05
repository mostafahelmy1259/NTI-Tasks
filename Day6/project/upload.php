<?php
    include_once("index.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <link href="../css/bootstrap.css" rel="stylesheet">
        <title>Upload Products</title>
    </head>
    <body class="bg-light">
        <div class="">
            <div class="row mt-5 d-flex justify-content-center">
                <div class="col-md-8">
                    <h2><span>Upload Image</span></h2>
                    <form method="POST" enctype="multipart/form-data" class="d-flex gap-3 align-items-center">
                        <input class="form-control" type="file" name="image" id="formFile" aria-label="Upload" style="max-width: 40%;">
                        <select class="form-select" aria-label="Choose type" style="max-width: 30%;">
                            <option selected>Choose type</option>
                            <option value="1">Avatar</option>
                            <option value="2">Product</option>
                        </select>
                        <button class="btn btn-primary text-white" type="submit" id="button-addon1" style="max-width: 20%;">Upload</button>
                    </form>
                    <br>
                    <a href="gallery.php">View Gallery</a> | <a href="login.php">Logout</a>
                </div>
            </div>
        </div>
    </body>
</html>