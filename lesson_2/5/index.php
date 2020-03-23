<?php

function renderTemplate($page, $arr = [])
{
    ob_start();
    include $page . ".php";
    return ob_get_clean();
}

$header = renderTemplate('header');
$content = renderTemplate('content');
$footer = renderTemplate('footer');

$arr = array($header, $content, $footer);

echo renderTemplate('main', $arr);