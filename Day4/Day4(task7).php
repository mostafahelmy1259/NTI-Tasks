<?php 
    $Products = ["Montitor" => 1200, "Chair" => 1000, "Headset" => 400, "Keyboard" => 300, "Mouse" => 150];
    asort($Products);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTC-8">
        <title>Task 7</title>
        <link rel="stylesheet" href="css/bootstrap.css">
    </head>
    <body class="bg-dark">
        <div class="container mt-4">
            <h4 class="text-danger">Product Prices</h4>
            <ul class="list-group">
                <?php foreach ($Products as $Product => $Price): ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <span><?= $Product ?></span>
                        <span class="badge bg-black rounded-pill">
                        <?=$Price ?> EGP</span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </body>
</html>

