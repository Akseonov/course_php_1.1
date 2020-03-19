<?php
$a = 1;
$b = 2;

echo $a = $a ^ $b;
echo $b = $b ^ $a;
echo $a = $a ^ $b;

echo '<br>' . "a = {$a}, b = {$b}" . '<br>';

$a = 1;
$b = 2;

$a ^= $b ^= $a ^= $b;

echo '<br>' . "a = {$a}, b = {$b}" . '<br>';

$a = 1;
$b = 2;

list($a, $b) = [$b, $a];

echo '<br>' . "a = {$a}, b = {$b}" . '<br>';

?>