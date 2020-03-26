<?php
$alfabet = [
    'а' => 'a',   'б' => 'b',   'в' => 'v',
    'г' => 'g',   'д' => 'd',   'е' => 'e',
    'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
    'и' => 'i',   'й' => 'y',   'к' => 'k',
    'л' => 'l',   'м' => 'm',   'н' => 'n',
    'о' => 'o',   'п' => 'p',   'р' => 'r',
    'с' => 's',   'т' => 't',   'у' => 'u',
    'ф' => 'f',   'х' => 'h',   'ц' => 'c',
    'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
    'ь' => '\'',  'ы' => 'i',   'ъ' => '\'',
    'э' => 'e',   'ю' => 'yu',  'я' => 'ya'
];

$str = 'Привет, меня зовут Виталя и реальный кекс';
$str2 = '';

$i = 0;
$letter = '';
while ($i <= mb_strlen($str)) {
    $letter = mb_substr($str, $i, 1, "UTF-8");
    if (mb_strtoupper($letter, "UTF-8") == $letter) {
        $letter = mb_strtolower($letter);
        $letter = strtr($letter, $alfabet);
        $letter = strtoupper($letter);
    } else {
        $letter = strtr($letter, $alfabet);
    }
    $str2 .= $letter;
    $i++;
};

echo $str2;