<?php
    $students = [
        ["name" => "Ahmed", "course" => "PHP", "grade" => 75],
        ["name" => "Salma", "course" => "JS", "grade" => 95],
        ["name" => "Youssef", "course" => "MySQL", "grade" => 78],
        ["name" => "Laila", "course" => "HTML", "grade" => 45]
    ];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Practice Project</title>
        <link rel="stylesheet" href="css/bootstrap.css">
    </head>
    <body class="bg-dark">
        <div class="container mt-5">
            <table class="table table-hover table-bordered ">
                <thead class="table-info">
                    <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Course</th>
                    <th scope="col">Grade</th>
                    <th scope="col">Status</th>
                    <th scope="col">Details</th>
                    </tr>
                </thead>
                <tbody>              
                    <?php foreach ($students as $index => $student): ?>
                        <tr class="<?= $student['grade'] < 60 ? 'table-danger' : ''; ?>">
                            <td><?= $student['name'] ?></td>
                            <td><?= $student['course'] ?></td>
                            <td>
                            <span class="badge bg-<?= $student['grade'] < 60 ? 'danger' : 'success' ?>">
                                <?= $student['grade'] ?>%
                            </span>
                            </td>
                            <td>
                            <?= $student['grade'] > 60 ? 'Passed' : 'Failed' ?>
                            </td>
                            <td>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal<?= $index ?>">View</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php foreach ($students as $index => $student){ ?>
                <div class="modal fade" id="modal<?= $index ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Student Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Name:</strong> <?= $student['name'] ?></p>
                                <p><strong>Course:</strong> <?= $student['course'] ?></p>
                                <p><strong>Grade:</strong> <?= $student['grade'] ?>%</p>
                                <p><strong>Status:</strong> <?= $student['grade'] > 60 ? 'Passed' : 'Failed' ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <script src="js/bootstrap.bundle.js"></script>
    </body>
</html>