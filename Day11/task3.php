<?php
    class Course{
        
        private $instuctor;
        private $title;

        function __construct($title, $instructor){
            $this->title = $title;
            $this->instructor = $instructor;
        }

        public function describe(){
            echo "This course is called $this->title and is taught by $this->instructor.";
        }
    }

    $courses = new Course("Introduction to PHP", "John Doe");
    $courses->describe();

?>
