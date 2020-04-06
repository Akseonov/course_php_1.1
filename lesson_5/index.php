<?php

$link = mysqli_connect('127.0.0.1', 'root', '', 'lesson_5');
$sqlSelect = "SELECT `id`, `name`, `big`, `small`, `vews` FROM `users`";
$result = mysqli_query($link, $sqlSelect);

define('DIR_IMG', './gallery_img');
define('DIR_LOG', './logs');

function renderTemplate($page, $strImg = '', $arrHtml = [])
{
    ob_start();
    include $page . ".php";
    return ob_get_clean();
}

function logging () {
    $day = date('G:i:s d:m:Y');
    file_put_contents(DIR_LOG . "/log.txt", $day . "\r\n", FILE_APPEND);

    $log = count(explode("\r\n", file_get_contents(DIR_LOG . "/log.txt")));
    if ($log > 10) {
        $dir = DIR_LOG . "/";
        $count = count(scandir($dir)) - 2;
        rename($dir . "log.txt", $dir . "log" . $count . ".txt");
    }
}

function renderStr ($res) {
    $str = '';
    $dir = DIR_IMG . "/";
    while ($row = mysqli_fetch_assoc($res)) {
        $str .= "<a rel=\"gallery\" class=\"photo\" href=\"" . $dir . $row['big'] . "/" . $row['name'] . "\" target=\"_blank\">
            <img src=\"" . $dir . $row['small'] . "/" . $row['name'] . "\" width=\"150\" height=\"100\">
        </a>";
    }
    return $str;
}

$strImg = renderStr($result);

$gallery = renderTemplate('gallery', $strImg);

$arrHtml = array($gallery);

echo renderTemplate('main', $strImg, $arrHtml);

logging();