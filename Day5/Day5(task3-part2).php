<?php 
    $name = $_GET['fullname'] ?? '';
    $email = $_GET['email'] ?? '';
    $age = $_GET['age'] ?? '';
    $city = $_GET['city'] ?? '';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Task 3(part 2)</title>
        <link href="css/bootstrap.css" rel="stylesheet">
    </head>
    <body class="bg-success">
        <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
            <?php if ($name || $email || $age || $city){ ?>
                <div class="mx-auto p-4 border rounded bg-white mt-4" style="width: 400px;">
                    <h3 class="text-center mb-4"><strong>User Profile</strong></h3>
                    <p class="alert alert-success py-2 border rounded">Welcome, <?php echo $name; ?>!</p>
                    <ul class="list-group">
                        <li class="list-group-item"><h5 class="mt-2"><strong>User Information</strong></h5></li>
                        <li class="list-group-item"><strong>Full Name:</strong> <?php echo $name; ?></li>
                        <li class="list-group-item"><strong>Email:</strong> <?php echo $email; ?></li>
                        <li class="list-group-item"><strong>Age:</strong> <?php echo $age; ?></li>
                        <li class="list-group-item"><strong>City:</strong> <?php echo $city; ?></li>
                    </ul>
                    <div class="d-flex justify-content-center">
                        <a href="Day5(task3).php" class="btn btn-primary mt-3 w-30">Back to Form</a>
                    </div>
                    
                </div>
            <?php }; ?>
        </div>
    </body>
</html>
