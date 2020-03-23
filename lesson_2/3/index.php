<?php

function add(int $a, int $b)
{
    return $a + $b;
}

function sub(int $a, int $b)
{
    return $a - $b;
}

function mul(int $a, int $b)
{
    return $a * $b;
}

function div(int $a, int $b)
{
    if ($b === 0) {
        return 'Вы пытаетесь поделить на 0';
    } else {
        return $a / $b;
    }
}

$a = 1;
$b = 10;

echo add($a,$b) . '<br>';
echo sub($a,$b) . '<br>';
echo mul($a,$b) . '<br>';
echo div($a,$b) . '<br>';