<?php

session_start();

include $_SERVER['DOCUMENT_ROOT'] . '/../config/config.php';

$link = mysqli_connect(HOST, USER, PASS, DB);

if (isset($_GET['p'])) {
    $page = $_GET['p'];
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }
} else {
    $page = 'gallery';
}

if (!function_exists($conf[$page])) {
    $params = array(
        'str' => $conf['gallery']($link, $id)
    );
} else {
    $params = array(
        'str' => $conf[$page]($link, $id)
    );
}

echo render($page, $params);