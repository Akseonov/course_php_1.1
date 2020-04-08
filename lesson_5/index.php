<?php

$link = mysqli_connect('127.0.0.1', 'root', '', 'lesson_5');



define('DIR_IMG', './gallery_img');
define('DIR_LOG', './logs');
define('DIR_TEMPLATES', './templates/');

if (isset($_GET['page'])) {
    $page = $_GET['page'];
    if (isset($_GET['id'])){
        $id = $_GET['id'];
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

function renderGallery ($link) {
    $str = '';
    $dir = DIR_IMG . "/";
    $sql = "SELECT `id`, `name`, `big`, `small`, `vews` FROM `users` ORDER BY `users`.`vews` DESC";
    $result = mysqli_query($link, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $str .= "<div class='gallery_block'>
                <a rel=\"gallery\" class=\"photo\" href=\"/?page=img&id=" . $row['id'] . "\">
                    <img src=\"" . $dir . $row['small'] . "/" . $row['name'] . "\" width=\"150\" height=\"100\">
                </a>
                <H6>Просмотров: " . $row['vews'] . "</H6>
            </div>";
    }
    return $str;
}

function renderImg ($link, $id) {
    $dir = DIR_IMG . "/";
    $sqlSelect = "SELECT `id`, `name`, `big`, `small`, `vews` FROM `users` WHERE `id`=" . $id;
    $sqlUpdate = "UPDATE `users` SET `vews` = `vews` + 1 WHERE `users`.`id` = " . $id;
    $resultSelect = mysqli_query($link, $sqlSelect);
    mysqli_query($link, $sqlUpdate);
    $row = mysqli_fetch_assoc($resultSelect);
    return "<img src=\"" . $dir . "big" . "/" . $row['name'] . "\">";
}

switch ($page) {
    case 'gallery':
        $params['strGal'] = $strGal = renderGallery($link);
        break;
    case 'img':
        $params['strImg'] = $strImg = renderImg($link, $id);
        break;
}

echo render($page, $params);