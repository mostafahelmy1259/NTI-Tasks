<?php
    require '../db.php';
    //session_start();
    $email = isset($_SESSION['email']) ? $_SESSION['email'] : '';

    $role_id = 0;
    if ($email) {
        $command = "SELECT role_id FROM admin WHERE email = '$email'";
        $result = mysqli_query($conn, $command);

        if ($row = mysqli_fetch_assoc($result)){
            $role_id = $row['role_id'];
        }
    }
    
?>


<!DOCTYPE html>
<html>
    <head>
        <link href="../../css/bootstrap.css" rel="stylesheet">
        <title>Project</title>
    </head>
    <body class="bg-light">
        <?php include("../navbar.php"); ?>
        <div class="container mt-3">    
            <h2>Courses List</h2>
            <a href="add_course.php" class="btn btn-success text-white mb-" style="max-width: 150px;">+ Add Course</a>
       
        
            <table class="table table-striped table-hover table-white justify-content-center mt-3 rounded">
                <thead class="thead-black">
                    <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Hours</th>
                    <th scope="col">Price</th>
                    <?php if ($role_id == 1){ ?>
                        <th scope="col">Actions</th>
                    <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $res = "SELECT * FROM courses";
                        $show = mysqli_query($conn, $res);
                        if ($show) {
                            while ($row = mysqli_fetch_assoc($show)) {
                    ?>
                            <tr>
                                <td><?= htmlspecialchars($row['title']); ?></td>
                                <td><?= htmlspecialchars($row['description']); ?></td>
                                <td><?= htmlspecialchars($row['hours']); ?></td>
                                <td><?= htmlspecialchars($row['price']); ?></td>
                                <?php if ($role_id == 1){ ?>
                                    <td>
                                        <a href="edit_course.php?id=<?= $row['id']; ?>" class="btn btn-warning">Edit</a>
                                        <a href="delete_course.php?id=<?= $row['id']; ?>" class="btn btn-danger">Delete</a>
                                    </td>
                                <?php } ?>
                            </tr>
                    <?php
                            }
                        }
                    ?>     
                </tbody>
            </table>
        </div>
    </body>
</html>