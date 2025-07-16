<?php
    $grade = 87;
    if (isset($grade)){
        echo ($grade >= 50) ? "You passed!" : "You failed!";
    } else {
        echo "Please enter your grade!";
    }

?>