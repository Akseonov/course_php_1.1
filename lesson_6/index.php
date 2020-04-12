<?php
define('HOST', '127.0.0.1');
define('USER', 'root');
define('PASS', '');
define('DB', 'lesson_6');
define('DIR_TEMPLATES', './templates/');
define('DIR_TASKS', 'tasks/');
define('DIR_IMG', './gallery_img');

$link = mysqli_connect(HOST, USER, PASS, DB);

if (isset($_GET['page'])) {
    $page = DIR_TASKS . $_GET['page'];
    if (isset($_GET['id'])){
        $id = $_GET['id'];
    }
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

function renderTask1 () {
    if (empty($_POST)) {
        return 'Ничего не передано!';
    }

    if (empty($_POST['operation'])) {
        return 'Заполните поля и выберите операцию';
    }

    if ((empty($_POST['varA']) && ($_POST['varA'] !== '0')) || (empty($_POST['varB']) && ($_POST['varB'] !== '0'))) {
        return 'Заполните поля';
    }

    $varA = $_POST['varA'];
    $varB = $_POST['varB'];
    $operation = $_POST['operation'];

    switch ($operation) {
        case 'add':
            $result = $varA + $varB;
            break;
        case 'sub':
            $result = $varA - $varB;
            break;
        case 'mul':
            $result = $varA * $varB;
            break;
        case 'div':
            if ($varB == 0) {
                $result = 'Вы пытаетесь поделить на 0';
            } else {
                $result = $varA / $varB;
            }
            break;
    }
    return $result;
}

function renderGallery ($link) {
    $str = '';
    $dir = DIR_IMG . "/";
    $sql = "SELECT `id`, `name`, `big`, `small`, `vews` FROM `img` ORDER BY `img`.`vews` DESC";
    $result = mysqli_query($link, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $str .= "<div class='gallery_block'>
                <a rel=\"gallery\" class=\"photo\" href=\"/?page=task3.2&id=" . $row['id'] . "\">
                    <img src=\"" . $dir . $row['small'] . "/" . $row['name'] . "\" width=\"150\" height=\"100\">
                </a>
                <H6>Просмотров: " . $row['vews'] . "</H6>
            </div>";
    }
    return $str;
}

function renderImg ($link, $id) {
    $str = '';
    $dir = DIR_IMG . "/";
    $sqlSelect = "SELECT `id`, `big_name`, `price`, `description`, `name`, `big`, `small`, `vews` FROM `img` WHERE `id`=" . $id;
    $sqlUpdate = "UPDATE `img` SET `vews` = `vews` + 1 WHERE `img`.`id` = " . $id;
    $sqlReview = "SELECT `id`, `review`, `name`, `data`, `picture` FROM `review` WHERE `picture`=" . $id . " ORDER BY `review`.`id` DESC";
    $sqlInsert = "INSERT INTO `review` (`id`, `review`, `name`, `data`, `picture`) 
    VALUES (NULL, '" . $_POST['review'] . "', '" . $_POST['name'] . "', '" . date('Y-m-d') . "', '" . $id . "')";
    $resultSelect = mysqli_query($link, $sqlSelect);
    mysqli_query($link, $sqlUpdate);
    $result = mysqli_query($link, $sqlReview);
    while ($rowReview = mysqli_fetch_assoc($result)) {
        $str .= "<div>
                <div>
                    <p>" . $rowReview['name'] . "</p>
                    <p>" . $rowReview['data'] . "</p>
                    <p>" . $rowReview['review'] . "</p>
                </div>
            </div>";
    }
    if (!empty($_POST['review']) && !empty($_POST['name'])) {
        mysqli_query($link, $sqlInsert);

        header("Location: /?page=" . $_GET['page'] . "&id=" . $_GET['id'] . "");
    }
    $formReview = "<form method='post'>
        <input type='text' name='name'>
        <textarea name='review'></textarea>
        <input type='submit' value='Отправить'>
    </form>";
    $row = mysqli_fetch_assoc($resultSelect);
    return "<div class=\"post_title\"><h2>" . $row['big_name'] . "</h2></div>
        <div class=\"img_big\">
            <img src=\"" . $dir . "big" . "/" . $row['name'] . "\">
        </div>
        <div>
            <h4>Цена картины: " . $row['price'] . " руб.</h4>
        </div>
        <div>
            <p>" . $row['description'] . "</p>
        </div>
        <div class='form_review'>
            " . $formReview . "
        </div>
        <div>
            " . $str . "
        </div>";
}

switch ($page) {
    case 'tasks/task1':
        $params['strTask1'] = $strTask1 = renderTask1();
        break;
    case 'tasks/task2':
        $params['strTask2'] = $strTask2 = renderTask1();
        break;
    case 'tasks/task3.1':
        $params['strGal'] = $strGal = renderGallery($link);
        break;
    case 'tasks/task3.2':
        $params['strImg'] = $strImg = renderImg($link, $id);
        break;
}

echo render($page, $params);
