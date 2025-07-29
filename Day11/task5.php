<?php
    trait Timestampable{
        public $timestamp;
        
        public function __construct(){
            $this->timestamp = date('Y-m-d H:i:s');
        }

        public function currnetTimestamp(){
            return $this->timestamp;
        }
    }

    class Order{
        use Timestampable;
    }

    class Invoice{
        use Timestampable;
    }

    $O = new Order();
    echo $O->currnetTimestamp();
    echo "<br>";
    $I = new Invoice();
    echo $I->currnetTimestamp();
?>