<?php

    // Another tasks required during the session

    $n1 = 23;
    $n2 = 53;
    echo "Result: " . ($n1 + $n2) . "<br>";
    echo "Result: " . ($n1 % $n2) . "<br>";


    
    for ($i = 0; $i <= 20; $i+=5){
        echo $i . "<br>";
    }

    for ($i = 0; $i <= 20; $i+=5){
        echo ($i % 5 == 0)? $i . "<br>" : "";
    }

   
?>