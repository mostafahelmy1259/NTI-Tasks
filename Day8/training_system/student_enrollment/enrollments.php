<?php
require_once("../db.php");

?>
<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Enrollment</title>
        <link rel="stylesheet" href="../../css/bootstrap.css">
    </head>

    <body class="bg-light">
        <?php include("../navbar.php");?>
        <div class="container py-5">
            
            <h2 class="mb-4">Students Enrolled</h2>
            <a href="add_enrollment.php" class="btn btn-success text-white mb-3">+ Add Enrollment</a>
            <div class="table-responsive-md table-responsive-sm">
                <table class="table table-striped table-bordered table-striped custom-table text-center shadow">
                    <thead class="text-center">
                        <tr>
                            <th>Student Name</th>
                            <th>Course Title</th>
                            <th>Course Degree</th>
                            <th>Enrollment Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $enrollData = mysqli_query(
                                $conn,
                                "  SELECT 
                                        enrollments.id,
                                        students.name,
                                        courses.title,
                                        enrollments.grade,
                                        enrollments.enrollment_date
                                    FROM
                                        enrollments
                                    JOIN students ON students.id = enrollments.student_id
                                    JOIN courses ON courses.id = enrollments.course_id
                                ");
                            if (mysqli_num_rows($enrollData) == 0) {
                                echo "<tr><td colspan='5' class='text-center text-danger fs-3'>No one Enrolled yet </td></tr>";
                            } else {
                                while ($row = mysqli_fetch_assoc($enrollData)) {
                                    echo "<tr>";
                                    foreach ($row as $key => $value) {
                                        if ($key == 'id')
                                            continue;
                                        echo "<td>" . $value . "</td>";
                                    }
                                    echo '<td><a href="edit_enrollment.php?id=' . $row['id'] . '" class="btn btn-warning">Edit</a>
                                    <a href="delete_enrollment.php?id=' . $row['id'] . '" class="btn btn-danger">Delete</a></td>';
                                    echo "</tr>";
                                }
                            }
                        ?>                                               
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>