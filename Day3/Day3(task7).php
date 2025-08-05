<?php
    //first method
    for ($i = 0; $i <= 20; $i+=5){
        echo $i . "<br>";
    }
    echo '<br>';
    //second method
    for ($i = 0; $i <= 20; $i+=5){
        echo ($i % 5 == 0)? $i . "<br>" : "";
    }
?>