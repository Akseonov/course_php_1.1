<?php
$a = 5;
$b = '05';
var_dump($a == $b) . '<br>';                             // Почему true? предположу, что так же как и в js это не строгое
// сравнение и идет неявное преобразование типов и b преобразовывается в int, отбрасывая 0
var_dump((int)'012345') . '<br>';                        // Почему 12345? при преобразовании в число, все 0 стоящие впереди отбразываются
var_dump((int)'000012345') . '<br>';
var_dump((float)123.0 === (int)123.0) . '<br>'; // Почему false?  сравнение по типу не проходит
var_dump((int)0 === (int)'hello, world') . '<br>'; // Почему true? при преобразвании строки в число, если в строке не
// содержится число, то оно будет равно 0
var_dump((int)'hello, world') . '<br>';
?>

