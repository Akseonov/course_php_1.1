<?php

$link = mysqli_connect('127.0.0.1', 'root', '', 'lesson_5');
$sqlSelect = "SELECT `id`, `name`, `big`, `small`, `vews` FROM `users`";
$result = mysqli_query($link, $sqlSelect);

define('DIR_IMG', './gallery_img');
define('DIR_LOG', './logs');
define('DIR_TEMPLATES', './templates/');

if (isset($_GET['page'])) {
    $page = $_GET['page'];
    if (isset($_GET['name'])){
        $name = $_GET['name'];
    }
} else {
    $page = 'gallery';
}

function render ($page, $params = []) {
    return renderTemplate('main', [
        'menu' => renderTemplate('menu'),
        'content' => renderTemplate($page, $params)
    ]);
}

function renderTemplate($page, $params = []) {
    ob_start();
    $tpl = DIR_TEMPLATES . $page . ".php";

    if (!is_null($params)) {
        extract($params);
    }

    include  $tpl;
    return ob_get_clean();
}

function renderGallery ($res) {
    $str = '';
    $dir = DIR_IMG . "/";
    while ($row = mysqli_fetch_assoc($res)) {
        $str .= "<a rel=\"gallery\" class=\"photo\" href=\"/?page=img&name=" . $row['name'] . "\" target=\"_blank\">
            <img src=\"" . $dir . $row['small'] . "/" . $row['name'] . "\" width=\"150\" height=\"100\">
        </a>";
    }
    return $str;
}

function renderImg ($name) {
    $dir = DIR_IMG . "/";

    return "<img src=\"" . $dir . "big" . "/" . $name . "\">";
}

switch ($page) {
    case 'gallery':
        $params['strGal'] = $strGal = renderGallery($result);
        break;
    case 'img':
        $params['strImg'] = $strImg = renderImg($name);
        break;
}

echo render($page, $params);