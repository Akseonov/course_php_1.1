<?php
function mathOperations ($arg1, $arg2, $operation) {
    if (empty($_GET)) {
        return 'Ничего не передано!';
    }

    if (empty($_GET['operation'])) {
        return 'Не передана операция';
    }

    if (empty($_GET['varA']) || empty($_GET['varB'])) {
        return 'Не переданы аргументы';
    }

    $varA = $_GET['varA'];
    $varB = $_GET['varB'];

    $str = $varA . ' ' . $operation . ' ' . $varB . ' = ';

    switch ($operation) {
        case 'add':
            $result = $arg1 + $arg2;
            break;
        case 'sub':
            $result = $arg1 - $arg2;
            break;
        case 'mul':
            $result = $arg1 * $arg2;
            break;
        case 'div':
            if ($arg2 === 0) {
                $result = 'Вы пытаетесь поделить на 0';
            } else {
                $result = $arg1 / $arg2;
            }
            break;
    }
    return $result;
}

include 'task1.php';