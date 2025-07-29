<?php
    class Book{
        public $title;
        public function read(){
            echo "You have read $this->title";
        }
    }

    $book = new Book();
    $book->title = "Harry Potter";
    $book->read();

    echo '<br>';

    class Student{
        public $name;
        public $email;

        public function sayHello(){
            echo "Hello, $this->name";
        }

        public function showEmail(){
            echo "Email: $this->email";
        }
    }

    $em = new Student();
    $em->name = "John";
    $em->email = "john@example.com";
    $em->sayHello();
    echo '<br>';
    $em->showEmail();
?>