<?php 
    require "db.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <link href="../css/bootstrap.css" rel="stylesheet">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Training System</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="students_registration/students.php">Students</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="student_courses/courses.php">Courses</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="student_enrollment/enrollments.php">Enrollments</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container mt-4">
            <div class="row g-3">
                <div class="col-md-4">
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
