<?php
    // native.php - Using mysqli procedural style with prepared statements to prevent SQL injection

    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "training_system";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare and bind
    $sql = "SELECT id, name, email FROM students WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Bind parameters (i = integer)
        $id = 2; // example id to select
        mysqli_stmt_bind_param($stmt, "i", $id);

        // Execute statement
        mysqli_stmt_execute($stmt);

        // Bind result variables
        mysqli_stmt_bind_result($stmt, $id, $name, $email);

        // Fetch value
        if (mysqli_stmt_fetch($stmt)) {
            echo "ID: " . htmlspecialchars($id) . "<br>";
            echo "Name: " . htmlspecialchars($name) . "<br>";
            echo "Email: " . htmlspecialchars($email) . "<br>";
        } else {
            echo "No user found with ID " . htmlspecialchars($id);
        }

        // Close statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Failed to prepare statement: " . mysqli_error($conn);
    }

    // Close connection
    mysqli_close($conn);
?>
