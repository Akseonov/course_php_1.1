<?php
$alfabet = [ ' ' => '_'];

$str = 'Привет, меня зовут Виталя и реальный кекс';

echo strtr($str, $alfabet);
