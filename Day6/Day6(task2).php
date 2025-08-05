<?php
    $text = "I am a bad guy.";
    echo strlen($text);
    echo "<br>";
    echo str_replace("bad", "***", $text);
    echo "<br>";
    echo substr($text, 10);
    echo "<br>";
    echo ucfirst($text);
    echo "<br>";
    echo strtoupper($text);
    echo "<br>";