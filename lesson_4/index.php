<?php

function renderTemplate($page, $arrImg = [], $arrHtml = [])
{
    ob_start();
    include $page . ".php";
    return ob_get_clean();
}

$arrImg = array(
//    array(
//        "gallery_img/big/01.jpg",
//        "gallery_img/big/02.jpg",
//        "gallery_img/big/03.jpg",
//        "gallery_img/big/04.jpg",
//        "gallery_img/big/05.jpg",
//        "gallery_img/big/06.jpg",
//        "gallery_img/big/07.jpg",
//        "gallery_img/big/08.jpg",
//        "gallery_img/big/09.jpg",
//        "gallery_img/big/10.jpg"
//    ),
//    array(
//        "gallery_img/small/01.jpg",
//        "gallery_img/small/02.jpg",
//        "gallery_img/small/03.jpg",
//        "gallery_img/small/04.jpg",
//        "gallery_img/small/05.jpg",
//        "gallery_img/small/06.jpg",
//        "gallery_img/small/07.jpg",
//        "gallery_img/small/08.jpg",
//        "gallery_img/small/09.jpg",
//        "gallery_img/small/10.jpg"
//    )
);

$arrImg[0][0] = 'gallery_img/big/01.jpg';
$arrImg[0][1] = 'gallery_img/big/02.jpg';
$arrImg[0][2] = 'gallery_img/big/03.jpg';
$arrImg[0][3] = 'gallery_img/big/04.jpg';
$arrImg[0][4] = 'gallery_img/big/05.jpg';
$arrImg[0][5] = 'gallery_img/big/06.jpg';
$arrImg[0][6] = 'gallery_img/big/07.jpg';
$arrImg[0][7] = 'gallery_img/big/08.jpg';
$arrImg[0][8] = 'gallery_img/big/09.jpg';
$arrImg[0][9] = 'gallery_img/big/10.jpg';

$arrImg[1][0] = 'gallery_img/small/01.jpg';
$arrImg[1][1] = 'gallery_img/small/02.jpg';
$arrImg[1][2] = 'gallery_img/small/03.jpg';
$arrImg[1][3] = 'gallery_img/small/04.jpg';
$arrImg[1][4] = 'gallery_img/small/05.jpg';
$arrImg[1][5] = 'gallery_img/small/06.jpg';
$arrImg[1][6] = 'gallery_img/small/07.jpg';
$arrImg[1][7] = 'gallery_img/small/08.jpg';
$arrImg[1][8] = 'gallery_img/small/09.jpg';
$arrImg[1][9] = 'gallery_img/small/10.jpg';

$gallery = renderTemplate('gallery', $arrImg);

$arrHtml = array($gallery);

//$arrImg = array($arrImgBig, $arrImgSmall);

echo renderTemplate('main', $arrImg, $arrHtml);

