<?php 
    //session_start();
    require("db.php");

    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>index</title>
        <link href="../css/bootstrap.css" rel="stylesheet">
    </head>
    <body>
        <?php include("navbar.php"); ?>

        <div class="container mt-4">
            <div class="row g-3">
            <h2>Dashboard Overview  
                <?php if ($role_id == 1) { ?>
                    <a href="index.php" class="btn btn-dark">Go to Admin Panel</a>
                    <a href="login_logs.php" class="btn btn-white border-black">View Login Logs</a>
                    <a href="#" class="btn btn-white border-black">View Failed Login Attempts</a>
                    <?php } elseif ($role_id == 0) { ?>
                        <a href="index.php" class="btn btn-secondary">User Dashboard</a>
                    <?php } ?>
            </h2>
                <div class="col-md-4 mt-3">
                    
                    <div class="card p-3">
                        <h5>Students</h5>
                        <?php $command = mysqli_query($conn, "SELECT COUNT(*) AS total FROM students");
                            $row = mysqli_fetch_assoc($command);
                        ?>
                        <p>Total students: <?= $row['total']; ?></p>
                        <a href="students_registration/students.php" class="btn btn-primary">View Students</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-3">
                        <h5>Courses</h5>
                        <?php $command = mysqli_query($conn, "SELECT COUNT(*) AS total FROM courses");
                            $row = mysqli_fetch_assoc($command);
                        ?>
                        <p>Total courses: <?= $row['total']; ?></p>
                        <a href="student_courses/courses.php" class="btn btn-success">View Courses</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-3">
                        <h5>Enrollments</h5>
                        <?php $command = mysqli_query($conn, "SELECT COUNT(*) AS total FROM enrollments");
                            $row = mysqli_fetch_assoc($command);
                        ?>
                        <p>Total enrollments: <?= $row['total']; ?></p>
                        <a href="student_enrollment/enrollments.php" class="btn btn-warning">View Enrollments</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
