<?php

function mathOperations (int $arg1, int $arg2, $operation = 'add') {
    switch ($operation) {
        case 'add':
            return $arg1 + $arg2;
            break;
        case 'sub':
            return $arg1 - $arg2;
            break;
        case 'mul':
            return $arg1 * $arg2;
            break;
        case 'div':
            if ($arg2 === 0) {
                return 'Вы пытаетесь поделить на 0';
            } else {
                return $arg1 / $arg2;
            }
            break;
    }
}


$a = 1;
$b = 15;

echo mathOperations($a, $b, 'add') . '<br>';
echo mathOperations($a, $b, 'sub') . '<br>';
echo mathOperations($a, $b, 'mul') . '<br>';
echo mathOperations($a, $b, 'div') . '<br>';