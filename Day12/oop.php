<?php
// oop.php - Using mysqli OOP style with prepared statements to prevent SQL injection

    class Database {
        private $servername = "localhost";
        private $username = "root";
        private $password = "";
        private $dbname = "training_system";
        public $conn;

        public function __construct() {
            // Create connection
            $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

            // Check connection
            if ($this->conn->connect_error) {
                die("Connection failed: " . $this->conn->connect_error);
            }
        }

        public function getUserById($id) {
            $sql = "SELECT id, name, email FROM students WHERE id = ?";
            $stmt = $this->conn->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $stmt->bind_result($id, $name, $email);

                if ($stmt->fetch()) {
                    echo "ID: " . htmlspecialchars($id) . "<br>";
                    echo "Name: " . htmlspecialchars($name) . "<br>";
                    echo "Email: " . htmlspecialchars($email) . "<br>";
                } else {
                    echo "No user found with ID " . htmlspecialchars($id);
                }

                $stmt->close();
            } else {
                echo "Failed to prepare statement: " . $this->conn->error;
            }
        }

        public function __destruct() {
            $this->conn->close();
        }
    }

    // Usage example
    $db = new Database();
    $db->getUserById(2);
?>
