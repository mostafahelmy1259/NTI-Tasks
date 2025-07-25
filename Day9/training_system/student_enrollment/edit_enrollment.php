<?php
    require '../db.php';

    $id = $_GET['id'] ?? null;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $title = $_POST['title'];
        $enrollment_date = $_POST['enrollment_date'];
        // $student_id = $_POST['student_id'];
        // $course_id = $_POST['course_id'];
        $grade = $_POST['grade'];

        $update_grade = "UPDATE enrollments SET grade='$grade', enrollment_date='$enrollment_date' WHERE id=$id";
            mysqli_query($conn, $update_grade);
            header("Location: enrollments.php");
            exit;

        $update_student = "UPDATE students SET name='$name' WHERE id=$id";
            mysqli_query($conn, $update_student);
            header("Location: enrollments.php");
            exit;

        $update_course = "UPDATE courses SET title='$title' WHERE id=$id";
            mysqli_query($conn, $update_course);
            header("Location: enrollments.php");
            exit;

        } else {
            $error = "Error: " . mysqli_error($conn);
    }


    $enrollments = null;
    if ($id) {
        $res = "SELECT * FROM enrollments WHERE id = $id";
        $show = mysqli_query($conn, $res);
        if ($show) {
            $enrollments = mysqli_fetch_assoc($show);
        }
    }

    $student = null;
    if ($id) {
        $res = "SELECT * FROM students WHERE id = $id";
        $show = mysqli_query($conn, $res);
        if ($show) {
            $student = mysqli_fetch_assoc($show);
        }
    }

    $course = null;
    if ($id) {
        $res = "SELECT * FROM courses WHERE id = $id";
        $show = mysqli_query($conn, $res);
        if ($show) {
            $course = mysqli_fetch_assoc($show);
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
            <h2>Edit an Enrollment</h2>

            <form class="m-4" method="post">
                <div class="mb-3">
                    <label class="form-label">Student Name:</label>
                    <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($student['name'] ?? '') ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Course Title:</label>
                    <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($course['title'] ?? ''); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Course Enrollment Date:</label>
                    <input type="date" name="enrollment_date" class="form-control" value="<?php echo htmlspecialchars($enrollments['enrollment_date'] ?? ''); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Grade:</label>
                    <input type="text" name="grade" class="form-control" value="<?php echo htmlspecialchars($enrollments['grade'] ?? ''); ?>" required>
                </div>

                <div class="mb-3">
                    <button class="btn btn-primary w-100" type="submit">Update Information</button>
                </div>
            </form>
        </div>
    </body>
</html>



