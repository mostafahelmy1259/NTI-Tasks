<?php
    require '../db.php';
    
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
            <h2>Student List</h2>
            <a href="add_student.php" class="btn btn-success text-white mb-" style="max-width: 150px;">+ Add Student</a>
       
        
            <table class="table table-striped table-hover table-white justify-content-center mt-3 rounded">
                <thead class="thead-black">
                    <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Date of Birth</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $res = "SELECT * FROM students";
                        $show = mysqli_query($conn, $res);
                        if ($show) {
                            while ($row = mysqli_fetch_assoc($show)) {
                    ?>
                            <tr>
                                <td><?= htmlspecialchars($row['name']); ?></td>
                                <td><?= htmlspecialchars($row['email']); ?></td>
                                <td><?= htmlspecialchars($row['phone']); ?></td>
                                <td><?= htmlspecialchars($row['date_of_birth']); ?></td>
                                <td>
                                    <a href="edit_student.php?id=<?= $row['id']; ?>" class="btn btn-warning">Edit</a>
                                    <a href="delete_student.php?id=<?= $row['id']; ?>" class="btn btn-danger">Delete</a>
                                </td>
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