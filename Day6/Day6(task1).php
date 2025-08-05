<?php
    function cal_total($product1, $product2, $product3) {
        return $product1 + $product2 + $product3;
    }

    $cal_tax = fn($total, $tax) => $total * $tax;
    $fun = cal_total(750, 325, 100);
    
    echo "The total price: " . $fun . "<br>". "The total price after tax: " . $fun - $cal_tax($fun, 0.08) . "<br>";

?>