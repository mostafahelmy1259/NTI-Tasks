<?php
    $tools = ["VS Code", "Git", "Github", "Figma", "Postman"];

    echo "Tool Count: " . count($tools) . "<br>";

    $tool = "VS Code";

    echo (in_array($tool, $tools))? $tool . " is in the list.": $tool . " is not in the list.";
    echo "<br>";
    echo "All Tools: ";
    print_r(array_values($tools));
?>