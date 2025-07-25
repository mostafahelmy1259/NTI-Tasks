<?php
    $log_file = 'login_attempts.csv';
    $logs = [];

    if (file_exists($log_file)) {
        $file = fopen($log_file, 'r');
        while (($line = fgetcsv($file)) !== false) {
            $logs[] = $line;
        }
        fclose($file);
    }
?>


<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Login Logs</title>
      <link href="../css/bootstrap.css" rel="stylesheet">
      <style>
        body {
          background-color: #f8f9fa;
        }
        .navbar {
          background-color: #212529;
        }
        .navbar-dark .navbar-nav .nav-link,
        .navbar-dark .navbar-brand {
          color: #ffffff;
        }
        table {
          background-color: #ffffff;
        }
        .table thead {
          background-color: #212529;
          color: #ffffff;
        }
        .icon {
          font-size: 1.5rem;
        }
      </style>
    </head>
    <body>
      <nav class="navbar navbar-dark px-3">
        <a class="navbar-brand" href="index.php">Back to Dashboard</a>
        <span class="text-white">Admin | ahmed</span>
      </nav>

      <div class="container mt-5">
        <h3><span class="icon">📜</span> Login Logs</h3>
        <div class="table-responsive mt-4">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Login Time</th>
                <th>IP Address</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $id = 1;
                foreach ($logs as $log) {
                  list($email, $login_time, $ip_address, $status) = $log;
                  echo "<tr>";
                  echo "<td>" . $id++ . "</td>";
                  echo "<td>" . htmlspecialchars($email) . "</td>";
                  echo "<td>" . htmlspecialchars($login_time) . "</td>";
                  echo "<td>" . htmlspecialchars($ip_address) . "</td>";
                  echo "<td>" . htmlspecialchars($status) . "</td>";
                  echo "</tr>";
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>

    </body>
</html>
