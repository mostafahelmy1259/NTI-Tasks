<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Day 1</title>
    <link href="css/bootstrap.css" rel="stylesheet" >
    <style>
        body {
            background: linear-gradient(135deg, #599041ff 100%, #5ad884ff 0%);
            min-height: 100vh;
            padding: 20px 0;
        }
        .profile-container {
            background: while;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 500px;
            margin: 0 auto;
        }
    </style>
</head>

<body class="bg-success container">
    
    <?php
    $name = htmlspecialchars($_POST['name'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $age = htmlspecialchars($_POST['age'] ?? '');
    $city = htmlspecialchars($_POST['city'] ?? '');
    ?>

    <div class="card">
    <div class="card-header text-center">
        <h5>User Profile</h5>
    </div>
    <div class="card-body">
        <div class="alert alert-success text-center">
        Welcome, <strong><?php echo $name; ?></strong>!
        </div>
        <ul class="list-group list-group-flush mb-3">
        <li class="list-group-item"><strong>Full Name: Mostafa Ahmed Helmy</strong> <?php echo $name; ?></li>
        <li class="list-group-item"><strong>Email: mostafa.helmy@gmail.com</strong> <?php echo $email; ?></li>
        <li class="list-group-item"><strong>Age: 20</strong> <?php echo $age; ?></li>
        <li class="list-group-item"><strong>City: Cairo</strong> <?php echo $city; ?></li>
        </ul>
        <a href="login.php" class="btn btn-primary w-100">Back to Form</a>
    </div>



    <!-- </div>
    <ul class="list-group">
    <li class="list-group-item active" aria-current="true">Full name: Mostafa Helmy</li>
    <li class="list-group-item">Email: mostafa.helmy@gmail.com</li>
    <li class="list-group-item">Age: 20</li>
    <li class="list-group-item">City: Cairo</li>
    </ul> -->
    
    <script href = "js/bootstrap.bundle.js"></script>
</body>
</html>
