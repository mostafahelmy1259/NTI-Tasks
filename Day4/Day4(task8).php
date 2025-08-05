<?php 
    $Persons = ["Mona" => 6000, "Tarek" => 7000, "Ziad" => 5500];
    $cond = array_filter($Persons, function($value) { return $value > 5000; });

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTC-8">
        <title>Task 8</title>
        <link rel="stylesheet" href="css/bootstrap.css">
    </head>
    <body class="bg-dark">
        <div class="container mt-5">
            <h4 class="text-info">High Salary Employees</h4>
            <ul class="list-group">
                <?php foreach ($cond as $Person => $value): ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <span><?= $Person ?></span>
                        <span class="badge bg-black ">
                        <?=$value ?> EGP</span>
                    </li>
                <?php endforeach; ?>
            </ul>

            <br><br><br>
            <h4 class="text-info">High Salary Employees</h4>
            <table class="table table-hover">
                <thead class="table-danger">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Salary</th>
                    </tr>
                </thead>
                <tbody>              
                    <?php for($i = 0; $i < count($cond); $i++){ ?>
                    <tr>
                        <th scope="row"><?= $i + 1 ?></th>
                        <td><?= array_keys($cond)[$i] ?></td>
                        <td><?= array_values($cond)[$i] ?></td>
                    <tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </body>
</html>