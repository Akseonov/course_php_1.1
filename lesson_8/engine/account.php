<?php

function renderAccount($link)
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($_POST['login']) || empty($_POST['password'])) {
            header('location: /?p=account');
            exit;
        }
        $login = mysqli_real_escape_string($link, strip_tags(trim($_POST['login'])));
        $password = $_POST['password'];

        $sql = "SELECT `id`, `loggin`, `password`, `admin` FROM `users` WHERE `loggin` = '$login'";
        $result = mysqli_query($link, $sql);
        $row = mysqli_fetch_assoc($result);

        if (empty($row)) {
            header('location: /?p=account');
        }

        if (password_verify($password, $row['password'])) {
            $_SESSION['auth'] = true;
            $_SESSION['user']['id'] = $row['id'];
            $_SESSION['user']['login'] = $row['loggin'];
            if ($row['admin'] == 'admin') {
                $_SESSION['user']['admin'] = true;
            }
        }
        header('location: /?p=account');
    }

    if (!empty($_GET['exit'])) {
        session_destroy();
        header('location: /?p=account');
    }

    if (checkAuth()) {
        $strAcc = "<h1>Добро пожаловать</h1>
            <a href='?p=account&exit=1'>Выход</a>" . renderOrder($link);
    } else {
        $strAcc = "<form method=\"post\">
            <input type=\"text\" name=\"login\" placeholder=\"login\">
            <input type=\"text\" name=\"password\" placeholder=\"password\">
            <input type=\"submit\">
        </form>";
    }

    return "<div id=\"main\">
    <div class=\"post_title\"><h2>Личный кабинет</h2></div>
    <div class=\"account\">
        " . $strAcc . "
    </div>
    </div>";
}

function checkAuth()
{
    if ($_SESSION['auth'] == true) {
        return true;
    } else {
        return false;
    }
}

function checkAdmin()
{
    if ($_SESSION['user']['admin'] == true) {
        return true;
    } else {
        return false;
    }
}

function renderOrder($link)
{
    $str = '';

    if (checkAdmin()) {
        $sqlSelectOrder = "SELECT `id`, `user_id`, `address`, `status` FROM `orders`";
    } else {
        $sqlSelectOrder = "SELECT `id`, `user_id`, `address`, `status` FROM `orders` WHERE `user_id` ="
            . $_SESSION['user']['id'];
    }

    if (!empty($_GET['status'])) {
//        changeStatus($link, $_POST['id'], $_POST['status']);
    }

    $resultSelectOrder = mysqli_query($link, $sqlSelectOrder);

    while ($rowOrder = mysqli_fetch_assoc($resultSelectOrder)) {
        $totalPrice = 0;
        $sqlSelectItem = "SELECT `id`, `order_id`, `img_id`, `price`, `count` FROM `order_items` 
            WHERE `order_id` =" . $rowOrder['id'];
        $resultSelectItem = mysqli_query($link, $sqlSelectItem);
        if (checkAdmin()) {
            $str .= "<div class='basket_total'>
                <p>Номер заказа: " . $rowOrder['id'] . ".</p>
            </div>
            <div class='basket_total'>
                <p>Статус заказа: </p>
                <form method='get'>
                    <input type='hidden' name='id' value='" . $rowOrder['id'] . "'>
                    <p><select name='status'>
                        <option disabled>" . $rowOrder['status'] . "</option>
                        <option value='Обрабатывается'>Обрабатывается</option>
                        <option value='Упаковывается'>Упаковывается</option>
                        <option value='Отплавлен'>Отплавлен</option>
                        <option value='Доставлен'>Доставлен</option>
                    </select></p>
                    <p><input type='submit' value='Изменить'></p>
                </form>
            </div>
            <div class='basket_total'>
                <p>ID пользователя :" . $rowOrder['user_id'] . ".</p>
            </div>";
        } else {
            $str .= "<div class='basket_total'>
                <p>Номер заказа: " . $rowOrder['id'] . ".</p>
            </div>
            <div class='basket_total'>
                <p>Статус заказа: " . $rowOrder['status'] . ".</p>
            </div>";
        }
        while ($rowItem = mysqli_fetch_assoc($resultSelectItem)) {
            $priceCommon = $rowItem['price'] * $rowItem['count'];
            $totalPrice += $priceCommon;
            $sqlSelectImg = "SELECT `id`, `big_name` FROM `img` WHERE `id` =" . $rowItem['img_id'];
            $resultSelectImg = mysqli_query($link, $sqlSelectImg);
            $rowImg = mysqli_fetch_assoc($resultSelectImg);

            $str .= "
                <div class=\"basket_good\">
            <div>
                <p>" . $rowImg['big_name'] . "</p>
            </div>
            <div>
                <p>" . $rowItem['price'] . " руб.</p>
            </div>
            <div>
                <p>  Х  </p>
            </div>
            <div>
                <p>" . $rowItem['count'] . " шт.</p>
            </div>
            <div>
                <p> = " . $priceCommon . " руб.</p>
            </div>
            </div>";
        }

        $str .= "<div class='basket_total'>
                <p>Итого: " . $totalPrice . " руб.</p>
            </div><hr>";
    }
    return $str;
}

function changeStatus($link, $id, $status)
{
    $sqlUpdate = "UPDATE `orders` SET `status` = '" . $status . "' WHERE `orders`.`id` =" . $id;
    mysqli_query($link, $sqlUpdate);
}