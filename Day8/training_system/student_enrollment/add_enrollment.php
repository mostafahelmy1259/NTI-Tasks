<?php 
include '../db.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = $_POST['student_id'];
    $course_id = $_POST['course_id'];
    $grade = $_POST['grade'];

    $sql = "INSERT INTO enrollments (student_id, course_id, grade) VALUES ('$student_id', '$course_id', '$grade')";
    if (mysqli_query($conn, $sql)) {
        header("Location: enrollments.php");
        exit;
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link href="../../css/bootstrap.css" rel="stylesheet">
    <title>Add Enrollment</title>
</head>
<body class="bg-light">
    <?php include("../navbar.php"); ?>
    <div class="container mt-5">
        <div class="card shadow p-4">
            <h2 class="mb-4">Add Enrollment</h2>
            <?php if (!empty($error)) : ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="mb-3">
                    <label for="student_id" class="form-label">Student</label>
                    <select name="student_id" id="student_id" class="form-select" required>
                        <option value="" disabled selected>Select a student</option>
                        <?php
                        $res = mysqli_query($conn, "SELECT * FROM students");
                        while ($row = mysqli_fetch_assoc($res)) {
                            echo "<option value='{$row['id']}'>" . htmlspecialchars($row['name']) . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="course_id" class="form-label">Course</label>
                    <select name="course_id" id="course_id" class="form-select" required>
                        <option value="" disabled selected>Select a course</option>
                        <?php
                        $res = mysqli_query($conn, "SELECT * FROM courses");
                        while ($row = mysqli_fetch_assoc($res)) {
                            echo "<option value='{$row['id']}'>" . htmlspecialchars($row['title']) . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="grade" class="form-label">Grade</label>
                    <input type="text" name="grade" id="grade" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Save Enrollment</button>
            </form>
        </div>
    </div>
</body>
</html>
