<?php

define('HOST', '127.0.0.1');
define('USER', 'root');
define('PASS', '');
define('DB', 'lesson_6');
define('DIR_TEMPLATES', '../templates/');
define('DIR_PAGES', 'pages/');
define('DIR_IMG', './gallery_img');
define('DIR_LOG', './logs');

$conf = array(
    'pages/gallery' => 'renderGallery',
    'pages/img' => 'renderImg',
    'pages/basket' => 'renderBasket',
    'pages/account' => 'renderAccount'
);

include $_SERVER['DOCUMENT_ROOT'] . "/../engine/functions.php";
include $_SERVER['DOCUMENT_ROOT'] . "/../engine/log.php";
include $_SERVER['DOCUMENT_ROOT'] . "/../engine/gallery.php";
include $_SERVER['DOCUMENT_ROOT'] . "/../engine/account.php";
include $_SERVER['DOCUMENT_ROOT'] . "/../engine/basket.php";