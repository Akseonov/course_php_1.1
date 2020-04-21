<?php
define('HOST', '127.0.0.1');
define('USER', 'root');
define('PASS', '');
define('DB', 'lesson_6');
define('DIR_TEMPLATES', './templates/');
define('DIR_PAGES', 'pages/');
define('DIR_IMG', './gallery_img');
define('DIR_LOG', './logs');

$link = mysqli_connect(HOST, USER, PASS, DB);

session_start();

if (isset($_GET['page'])) {
    $page = DIR_PAGES . $_GET['page'];
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }
} else {
    $page = DIR_PAGES . 'gallery';
}

function render($page, $params = [])
{
    return renderPage('main', [
        'menu' => renderPage('menu'),
        'content' => renderPage($page, $params)
    ]);
}

function renderPage($page, $params = [])
{
    ob_start();
    if (!is_null($params)) {
        extract($params);
    }
    $dir = DIR_TEMPLATES . $page . ".php";
    include $dir;
    return ob_get_clean();
}

function logging()
{
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

function renderGallery($link)
{
    $str = '';
    $dir = DIR_IMG . "/";
    $sql = "SELECT `id`, `name`, `big`, `small`, `vews` FROM `img` ORDER BY `img`.`vews` DESC";
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

function renderImg($link, $id)
{
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

    if (empty($_SESSION['goods'])) {
        $_SESSION['goods'] = [];
    }

    if (!empty($_POST['id'])) {
        if (!array_key_exists((int)$_POST['id'], $_SESSION['goods'])) {
            $_SESSION['goods'][$_POST['id']] = [
                'id' => $_POST['id'],
                'name' => $_POST['big_name'],
                'price' => $_POST['price'],
                'count' => (int)$_POST['count']
            ];
        } else {
            $_SESSION['goods'][$_POST['id']]['count']++ ;
        }
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
            <form method='post'>
                <input type='hidden' name='id' value='" . $row['id'] . "'>
                <input type='hidden' name='big_name' value='" . $row['big_name'] . "'>
                <input type='hidden' name='price' value='" . $row['price'] . "'>
                <input type='hidden' name='count' value=1>
                <input type='submit' value='В корзину'>
            </form>
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

function renderBasket()
{
    $strBasket = '';
    if (empty($_SESSION['goods'])) {
        $strBasket = 'Ваша корзина пуста';
    } else {
        if (!empty($_POST['del'])) {
            unset($_SESSION['goods'][(int)$_POST['del']]);
        }

        if (!empty($_POST['addCount'])) {
            ++$_SESSION['goods'][$_POST['addCount']]['count'];
        }

        if (!empty($_POST['subCount'])) {
            --$_SESSION['goods'][$_POST['subCount']]['count'];
            if ($_SESSION['goods'][$_POST['subCount']]['count'] == 0) {
                unset($_SESSION['goods'][$_POST['subCount']]);
            }
        }

        foreach ($_SESSION['goods'] as $good) {
            $strBasket .= "<div class=\"basket_good\">
        <div>
            <p>" . $good['name'] . "</p>
        </div>
        <div>
            <p>" . $good['price'] . " руб.</p>
        </div>
        <div>
            <p>  Х  </p>
        </div>
        <div>
            <p>" . $good['count'] . " шт.</p>
            <div class=\"basket_good\">
                <form method='post'>
                    <input type='hidden' name='addCount' value='" . $good['id'] . "'>
                    
                    <input type='submit' value='+'>
                </form>
                <form method='post'>
                    <input type='hidden' name='subCount' value='" . $good['id'] . "'>
                    <input type='submit' value='-'>
                </form>
            </div>
        </div>
        <div>
            <p> = " . $good['price'] * $good['count'] . " руб.</p>
        </div>
        <div>
            <form method='post'>
                <input type='hidden' name='del' value='" . $good['id'] . "'>
                <input type='submit' value='Удалить'>
            </form>
        </div>
        </div>";
        }
    }
    return $strBasket;
}

function renderAccount($link) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($_POST['login']) || empty($_POST['password'])) {
            header('location: /?page=account');
            exit;
        }
        $login = $_POST['login'];
        $password = $_POST['password'];

        $sql = "SELECT `id`, `loggin`, `password` FROM `users` WHERE `loggin` = '$login'";
        $result = mysqli_query($link, $sql);
        $row = mysqli_fetch_assoc($result);

        if (empty($row)) {
            header('location: /');
        }

        if (password_verify($password, $row['password'])) {
            $_SESSION['auth'] = true;
        }
        header('location: /?page=account');
    }

    if (!empty($_GET['exit'])) {
        session_destroy();
        header('location: /?page=account');
    }

    if (!empty($_SESSION['auth'])) {
        return "<h1>Добро пожаловать</h1>
            <a href=\"?page=account&exit=1\">Выход</a>";
    } else {
        return "<form method=\"post\">
            <input type=\"text\" name=\"login\" placeholder=\"login\">
            <input type=\"text\" name=\"password\" placeholder=\"password\">
            <input type=\"submit\">
        </form>";
    }
}

switch ($page) {
    case 'pages/gallery':
        $params['strGal'] = $strGal = renderGallery($link);
        break;
    case 'pages/img':
        $params['strImg'] = $strImg = renderImg($link, $id);
        break;
    case 'pages/basket':
        $params['strBasket'] = $strBasket = renderBasket();
        break;
    case 'pages/account':
        $params['strAccount'] = $strAccount = renderAccount($link);
        break;
}

echo render($page, $params);

var_dump($_SESSION);
var_dump($_POST);

