<?php 
    session_start();

    // Initialize the session array if not set
    if (!isset($_SESSION["user"])) {
        $_SESSION["user"] = [];
    }

    if (isset($_GET['name']) && isset($_GET['email'])) {
        $_SESSION["user"][] = [
            'username' => $_GET['name'],
            'email' => $_GET['email']
        ];
    }

    // Clear session users
    if (isset($_GET['clear'])) {
        $_SESSION["user"] = [];
    }

    // Remove last user
    if (isset($_GET['remove_last'])) {
        array_pop($_SESSION["user"]);
    }
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Task 3</title>
        <link href="css/bootstrap.css" rel="stylesheet">
    </head>
    <body class="bg-dark">
        <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="row w-100">
                <div class="col-md-6">
                    <form class="mx-auto p-4 border rounded bg-white p-3" method="GET" action="">
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Name</label>
                            <input type="text" class="form-control w-100" id="fullname" name="name" placeholder="Jane Doe" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="example@gmail.com" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Save</button>
                    </form>
                    <div class="d-flex justify-content-between mt-3">
                        <form method="GET" action="">
                            <button type="submit" name="clear" value="1" class="btn btn-danger">Clear Session</button>
                        </form>
                        <form method="GET" action="">
                            <button type="submit" name="remove_last" value="1" class="btn btn-warning">Remove Last</button>
                        </form>
                    </div>
                </div>
                <div class="md-6 mt-5">
                    <table class="table table-striped table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">user name</th>
                                <th scope="col">user email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($_SESSION["user"])): ?>
                                <?php foreach ($_SESSION["user"] as $user): ?>
                                    <tr>

                                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="alert alert-daner m-3">No users!</div>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>              
            </div>
        </div>
    </body>
</html>
