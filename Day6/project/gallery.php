<?php
    //session_start();
    // Check if user is logged in by verifying session variables
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
                    <h2><span>Gallery</span></h2>
                        <table class="table table-striped table-hover table-white justify-content-center mt-5 rounded">
                        <thead class="">
                            <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Type</th>
                            <th scope="col">Size</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($images)){ ?>
                                <?php foreach($images as $key => $image){ ?>
                                    <tr>
                                    <td>
                                        <img src="<?= $image; ?>" alt="Image" style="max-width: 150px; display: block; margin-bottom: 5px;">
                                        <?= htmlspecialchars($image); ?>
                                    </td>
                                    <td>
                                        <?= htmlspecialchars(basename($image)); ?>
                                    </td>
                                    <td>
                                        <?= htmlspecialchars(mime_content_type($image)); ?>
                                    </td>
                                    <td>
                                        <?= number_format(filesize($image) / 1024, 2) . ' KB'; ?>
                                    </td>
                                    <td>
                                        <a href="?delete=<?= urlencode($image); ?>" class="btn btn-dark border-primary text-primary">Delete</a>
                                    </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>     
                        </tbody>
                    </table>
                    <a href="gallery.php">View Gallery</a> | <a href="login.php">Logout</a>
                </div>
            </div>
        </div>
    </body>
</html>



