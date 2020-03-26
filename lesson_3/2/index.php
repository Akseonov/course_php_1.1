<?php
$i = 0;
do {
    if ($i == 0) {
        echo $i . ' - ноль.<br>';
    } elseif ($i % 2) {
        echo $i . ' - нечетное число.<br>';
    } else {
        echo $i . ' - четное число.<br>';
    }
    $i++;
} while ($i <= 10);