<?php
    $today = date("Y-m-d_H-i");
    $folder = "uploads/$today";
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        

        if (!is_dir("uploads")) mkdir("uploads", 0777, true);
        if (!is_dir($folder)) mkdir($folder, 0777, true);

        $filename = basename($_FILES['image']['name']);
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $new_name = uniqid("img_", true) . "." . $extension;
        $target = $folder . "/" . time() . "_" . $new_name;

        $allowed_ext = ["image/jpeg", "image/png"];
        if (in_array($_FILES['image']['type'], $allowed_ext)) {
            move_uploaded_file($_FILES['image']['tmp_name'], $target);
            echo "<div class='alert alert-success mt-3' style='width: 90%; max-width : 900px; margin: 10px auto'>File uploaded to: $target</div>";
        } else {
            echo "<div class='alert alert-danger mt-3' style='width: 90%; max-width : 900px; margin: 10px auto'>Invalid type of image check it out!</div>";
        }
    }

    //$folder = "uploads/" . date("Y-m-d_H-i");
    $images = glob($folder . "/*.{jpg,png,jpeg}", GLOB_BRACE);

    if (isset($_GET['delete'])){
        $targeted = $_GET['delete'];
        if(file_exists($targeted)) {
            unlink($targeted);
            echo "<div class='alert alert-success mt-3' style='width: 90%; max-width : 900px; margin: 10px auto'>File deleted $targeted !</div>";
        } else {
            echo "<div class='alert alert-danger mt-3' style='width: 90%; max-width : 900px; margin: 10px auto'>File not found!</div>";
        }
    }
     
?>



<!DOCTYPE html>
<html>
    <head>
        <title>Task 6&7</title>
        <link href="css/bootstrap.css" rel="stylesheet">
    </head>
    <body class="bg-dark">
        <div class="container">
            <div class="row mt-5 d-flex justify-content-center">
                <div class="col-md-8">
                    <form method="POST" enctype="multipart/form-data" class="input-group">
                        <input class="form-control" type="file" name="image" id="formFile">
                        <button class="btn btn-dark border-primary text-primary" type="submit" id="button-addon1">Upload</button>
                    </form>
                </div>
            </div> 
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-hover table-dark justify-content-center mt-5 rounded">
                        <thead class="">
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Image path</th>
                            <th scope="col">actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($images)){ ?>
                                <?php foreach($images as $key => $image){ ?>
                                    <tr>
                                    <td scope="row"><?= $key + 1; ?></td>
                                    <td>
                                        <img src="<?= $image; ?>" alt="Image" style="max-width: 150px; display: block; margin-bottom: 5px;">
                                        <?= $image; ?>
                                    </td>
                                    <td>
                                        <a href="?delete=<?= urlencode($image); ?>" class="btn btn-dark border-primary text-primary">Delete</a>
                                    </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>     
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>