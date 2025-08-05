<?php
    $devices = [["name" => "Laptop", "price" => 15000, "quantity" => 3],
                ["name" => "Phone", "price" => 8000, "quantity" => 5],
                ["name" => "Tablet", "price" => 6000, "quantity" => 2]];

    $employee = ["Name" => "Mona Hassan", "Job Title" => "Frontend Developer", "Department" => "UI/UX", "Salary" => 10000];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTC-8">
        <title>Task 3&4</title>
        <link rel="stylesheet" href="css/bootstrap.css">
    </head>
    <body class="bg-success">
        <div class="container">
            <div class="row py-5">
                <table class="table table-black table-striped-column table-hover">
                    <thead class="table-dark">
                        <tr>   
                        <th scope="col text-white">Name</th>
                        <th scope="col">Price(EGP)</th>
                        <th scope="col">Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for($i = 0; $i < count($devices); $i++) { ?>
                            <tr>
                            <td><?= $devices[$i]["name"] ?></td>
                            <td><?= $devices[$i]["price"] ?></td>
                            <td><?= $devices[$i]["quantity"] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            
            <div class="row py-5">
                <ul class="list-group">
                    <?php  foreach($employee as $key => $value): ?>
                    <li class="list-group-item">
                        <strong><?= $key ?></strong> : <?= $value ?>
                    </li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </body>
</html>