<?php

function renderTemplate($page, $arrImg = [], $arrHtml = [])
{
    ob_start();
    include $page . ".php";
    return ob_get_clean();
}

function renderArr ($arr) {
    $dir = './gallery_img';
    $scanDir = array_diff(scandir($dir), array('..', '.'));
    var_dump($scanDir);
    for ($i = 2; $i < count($scanDir) + 2; $i++) {
        $dir = './gallery_img/' . $scanDir[$i];
        var_dump($dir);
        $scanDirImg = array_diff(scandir($dir), array('..', '.'));
        var_dump(count($scanDirImg) + 2);
        for ($j = 2; $j < count($scanDirImg) + 2; $j++) {
            $arr[$i - 2][$j - 2] = $dir . "/" . $scanDirImg[$j];
        }
    }
    return $arr;
}

$arrImg = renderArr($arrImg);

$gallery = renderTemplate('gallery', $arrImg);

$arrHtml = array($gallery);

echo renderTemplate('main', $arrImg, $arrHtml);


