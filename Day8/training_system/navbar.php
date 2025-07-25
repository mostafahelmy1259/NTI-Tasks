<?php 
    //require "../db.php";
    $path = (pathinfo(getcwd())["basename"] == "training_system" ? '' : '../');
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="../index.php">Training System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="<?= $path?>students_registration/students.php">Students</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $path?>student_courses/courses.php">Courses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $path?>student_enrollment/enrollments.php">Enrollments</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
