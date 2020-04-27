<?php

function render($page, $params = [])
{
    return renderPage('main', [
        'menu' => renderPage('menu'),
        'content' => renderPage('content', $params)
    ]);
}

function renderPage($page, $params = [])
{
    ob_start();

    if (!is_null($params)) {
        extract($params);
    }

    $file = DIR_TEMPLATES . $page . ".php";

    if (!file_exists($file)) {
        $file = DIR_TEMPLATES . 'content' . ".php";
    }

    include $file;

    return ob_get_clean();
}
