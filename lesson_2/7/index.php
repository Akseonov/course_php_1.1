<?php

$a = mt_rand(0,23);
$b = mt_rand(0,59);

function timeDef(int $arg1, int $arg2) {
    if (($arg1 % 10) == 1 && ((int)($arg1/10) !== 1)) {
        $hour = 'час';
    } elseif (($arg1 % 10) >= 2 && ($arg1 % 10) <= 4 && ((int)($arg1/10) !== 1)) {
        $hour = 'часа';
    } else {
        $hour = 'часов';
    }

    if (($arg2 % 10) == 1 && ((int)($arg2/10) !== 1)) {
        $min = 'минута';
    } elseif (($arg2 % 10) >= 2 && ($arg2 % 10) <= 4 && ((int)($arg2/10) !== 1)) {
        $min = 'минуты';
    } else {
        $min = 'минут';
    }

    return "$arg1 $hour : $arg2 $min";
}

echo timeDef($a, $b);