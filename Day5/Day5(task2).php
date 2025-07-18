<!DOCTYPE html>
<html>
    <head>
        <title>Task 2</title>
        <link href="css/bootstrap.css" rel="stylesheet">
    </head>
    <body>
        <?php
            //echo ($_SERVER['HTTP_HOST']);
            if ($_SERVER['REMOTE_ADDR'] == '192.168.1.3'){
                header("Location: denied(task2).php");
                exit;
            } else {
                echo '<div class="alert alert-success m-3">Access OK: GOOD host.</div>';
            }
        ?>
    </body>
</html>
