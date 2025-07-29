<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['name'], $_POST['email'], $_POST['age'], $_POST['isActive'])) {
        class Student {
            public $name;
            public $age;
            protected $email;
            private $isActive;

            public function __construct($name, $email, $age, $isActive) {
                $this->name = $name;
                $this->email = $email;
                $this->age = $age;
                $this->isActive = filter_var($isActive, FILTER_VALIDATE_BOOLEAN);
            }

            public function activate() {
                if (!$this->isActive) {
                    $this->isActive = true;
                }
            }

            public function getStatus() {
                return json_encode([
                    "Welcome "  => $this->name . "!",
                    "your status is: " => $this->isActive]);
            }
        }

        $test = new Student($_POST['name'], $_POST['email'], $_POST['age'], $_POST['isActive']);
        $test->activate();
        echo $test->getStatus();
    } else {
        echo "Please submit all required fields.";
    }
} else {
    echo "Please use POST method.";
}
?>

