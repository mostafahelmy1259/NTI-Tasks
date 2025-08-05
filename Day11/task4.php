<?php 
    class Vehicle{
        public $model = 'ms5-2025';
        public $make = "china";
        function info(){
            echo "This is a $this->make it's model $this->model.";
        }
    }


    class Car extends Vehicle{
        public $fuelType = 95;
        function info(){
            echo parent::info() . " It's fuel type is $this->fuelType.";
        }
    }

    $test = new Car();
    $test->info();

    echo "<br>";

    class BankAccount{
        private $balance = 10000;

        function deposit($amount){
            return $this->balance += $amount;
        }
        function withd($amount){
            return $this->balance -= $amount;
        }
        function getBalance(){
            return $this->balance;
        }

    }

    $test2 = new BankAccount();
    echo $test2->getBalance() . "\n";

    echo "<br>";

    class Animal{
        public $name;
        public function makeSound(){

        }
    }

    class Dog extends Animal{
        public function makeSound(){
            echo "Woof!";
        }
    }

    $dog = new Dog();
    $dog->makeSound();
?>
