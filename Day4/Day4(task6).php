<?php 
    $languages = ["HTML", "CSS", "JS", "PHP"];
    array_push($languages, "MYSQL");
    array_unshift($languages, "Git");
?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTC-8">
            <title>Task 6</title>
            <link rel="stylesheet" href="css/bootstrap.css">
        </head>
        <body class="bg-success">
            <div class="container">
                <div class="row py-5">
                    <h4 class="text-info"><strong>Available Courses</strong></h4>
                    <ul class="list-group">
                        <?php
                        for ($i = 0; $i < count($languages); $i++) {
                            echo "<li class='list-group-item'> $languages[$i]</li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </body>
    </html>