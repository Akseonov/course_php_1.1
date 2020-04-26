<?php

session_start();

include $_SERVER['DOCUMENT_ROOT'] . '/../config/config.php';

$link = mysqli_connect(HOST, USER, PASS, DB);

if (isset($_GET['p'])) {
    $page = DIR_PAGES . $_GET['p'];
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }
} else {
    $page = DIR_PAGES . 'gallery';
}

if (!function_exists($conf[$page])) {
    $params = array(
        'str' => $conf['pages/gallery']($link, $id)
    );
} else {
    $params = array(
        'str' => $conf[$page]($link, $id)
    );
}

echo render($page, $params);
