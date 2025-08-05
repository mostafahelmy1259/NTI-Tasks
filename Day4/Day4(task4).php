<?php
    $employee = [["Name" => "Ali", "Department" => "IT", "Salary" => 9500],
                ["Name" => "Khaled", "Department" => "Finance", "Salary" => 8200]];

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTC-8">
        <title>Task 4</title>
        <link rel="stylesheet" href="css/bootstrap.css">
    </head>
    <body class="bg-success">
        <div class="container">
            <div class="row py-5">
                <table class="table table-black table-striped-column table-hover">
                    <thead class="table-dark">
                        <tr>   
                        <th scope="col text-white">Name</th>
                        <th scope="col">Department</th>
                        <th scope="col">Salary</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for($i = 0; $i < count($employee); $i++) { ?>
                            <tr>
                            <td><?= $employee[$i]["Name"] ?></td>
                            <td><?= $employee[$i]["Department"] ?></td>
                            <td><?= $employee[$i]["Salary"] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>