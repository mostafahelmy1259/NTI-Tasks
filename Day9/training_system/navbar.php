<?php 
    //require "../db.php";
    $path = (pathinfo(getcwd())["basename"] == "training_system" ? '' : '../');
    session_start();
    require("db.php");

    $email = isset($_SESSION['email']) ? $_SESSION['email'] : '';

    $role_id = 0;
    if ($email) {
        // Use session role_id directly if available
        if (isset($_SESSION['role_id'])) {
            $role_id = $_SESSION['role_id'];
        } else {
            $command = "SELECT role_id FROM admin WHERE email = '$email'";
            $result = mysqli_query($conn, $command);

            if ($row = mysqli_fetch_assoc($result)){
                $role_id = $row['role_id'];
            }
        }
    }
?>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <!-- Removed outer <a> tag to avoid nested links -->
        <?php if ($role_id == 1){ ?>
            <a class="navbar-brand text-white" href="<?= $path?>index.php">WELCOME, Moustafa (Admin)</a>
        <?php } else{ ?>
            <a class="navbar-brand text-white" href="<?= $path?>index.php">WELCOME, User (User)</a>
        <?php } ?>
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
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-secondary border" href="<?= $path?>login.php">Logout</a>
            </ul>
        </div>
    </div>
</nav>
