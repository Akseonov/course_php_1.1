<?php
define('HOST', '127.0.0.1');
define('USER', 'root');
define('PASS', '');
define('DB', 'lesson_6');
define('DIR_TEMPLATES', './templates/');
define('DIR_TASKS', 'tasks/');

$link = mysqli_connect(HOST, USER, PASS, DB);

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = DIR_TASKS . 'task1';
}

function render($page, $params = []) {
    return renderTasks('main', [
        'menu' => renderTasks('menu'),
        'content' => renderTasks($page, $params)
    ]);
}

function renderTasks ($page, $params = []) {
    ob_start();
    if (!is_null($params)) {
        extract($params);
    }
    $dir = DIR_TEMPLATES . $page . ".php";
    include $dir;
    return ob_get_clean();
}

function renderTask1() {
    $str = '';
    return $str .= '';
}

switch ($page) {
    case 'task1':
        $params['strTask1'] = $strTask1 = renderTask1();
        break;
}

echo render($page, $params);
