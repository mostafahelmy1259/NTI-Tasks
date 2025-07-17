<?php
    $books = ["Clean Code", "The Pragmatic Programmer", "Design Patterns", "You Don’t Know JS", "Eloquent JavaScript"];
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Task 1</title>
        <link rel="stylesheet" href="css/bootstrap.css">

    </head>
    <body class="bg-danger">
        <div class="container">
            <div class="row mt-5">
                <div class="list-group">
                    <?php foreach($books as $book){ ?>
                    <button type="button" class="list-group-item list-group-item-action"><?= $book ?></button>
                    <?php } ?>
                </div>
            </div>
        </div>
    </body>
</html>