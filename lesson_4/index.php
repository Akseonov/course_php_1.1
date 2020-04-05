<?php
define('DIR_IMG', './gallery_img');
define('DIR_LOG', './logs');

function renderTemplate($page, $arrImg = [], $arrHtml = [])
{
    ob_start();
    include $page . ".php";
    return ob_get_clean();
}

function logging () {
    $day = date('G:i:s d:m:Y');
    file_put_contents(DIR_LOG . "/log.txt", $day . "\r\n", FILE_APPEND);

    $log = count(explode("\r\n", file_get_contents(DIR_LOG . "/log.txt")));
    var_dump($log);
    if ($log > 10) {
        $dir = DIR_LOG . "/";
        $count = count(scandir($dir)) - 2;
        rename($dir . "log.txt", $dir . "log" . $count . ".txt");
    }
}

function renderArr () {
    $arr = [];
    $scanDir = scandir(DIR_IMG);
    for ($i = 0; $i <= count($scanDir); $i++) {
        if (strlen($scanDir[$i]) > 2) {
            $scanDirImg = scandir(DIR_IMG . "/" . $scanDir[$i]);
            for ($j = 0; $j <= count($scanDirImg); $j++) {
                if (strlen($scanDirImg[$j]) > 2) {
                    $arr[$i - 2][$j - 2] = DIR_IMG . "/" . $scanDir[$i] . "/" . $scanDirImg[$j];
                }
            }
        }
    }
    return $arr;
}

$arrImg = renderArr();

$gallery = renderTemplate('gallery', $arrImg);

$arrHtml = array($gallery);

echo renderTemplate('main', $arrImg, $arrHtml);

logging();