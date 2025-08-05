<?php 
    class Employee{
        public $name = "moustafa";
        protected $salary = 55000;
        private $bonus  = 10000;
        
        public function print_all(){
            echo "My name is $this->name";
            echo "<br>";
            echo "I take $this->salary per month";
            echo "<br>";
            echo "Some times I get $this->bonus as a bonus";
        }
    }

    $employee = new Employee();
    $employee->print_all();
?>