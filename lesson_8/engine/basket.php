<?php

function renderBasket($link)
{
    $totalPrice = 0;
    $strBasket = '';
    $control = "";
    if (empty($_SESSION['goods'])) {
        $strBasket = "<div class='basket_total'>
            <p>Ваша корзина пуста</p>
            </div>";
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

        if (!empty($_POST['address'])) {
            sendOrder($link);
            $_SESSION['goods'] = [];
            $control = "<div class='basket_total'>
                <p>Ваш заказ отправлен</p>
            </div>";
        }

        foreach ($_SESSION['goods'] as $good) {
            $priceCommon = $good['price'] * $good['count'];
            $totalPrice += $priceCommon;
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
                <p> = " . $priceCommon . " руб.</p>
            </div>
            <div>
                <form method='post'>
                    <input type='hidden' name='del' value='" . $good['id'] . "'>
                    <input type='submit' value='Удалить'>
                </form>
            </div>
            </div>
            <hr>";
        }

        if (empty($_SESSION['goods'])) {
            $strBasket .= "<div class='basket_total'>
                <p>Ваша корзина пуста</p>
            </div>";
        } else {
            $strBasket .= "<div class='basket_total'>
            <p>Итого: " . $totalPrice . " руб.</p>
            </div>
            <hr>
            <div class='form_order'>
                " . renderOrderForm() . "
            </div>";
        }
    }

    return "<div id=\"main\">
        <div class=\"post_title\"><h2>Ваша корзина</h2></div>
        <div class=\"basket\"><hr>
            " . $strBasket . $control . "
        </div>
    </div>";
}

function renderOrderForm()
{
    if (checkAuth()) {
        return "<form method='post'>
            <p>Для оформления заказа введите свой адрес</p>
            <input type='text' name='address' size='70'>
            <input type='submit' value='Оформить заказ'>
        </form>";
    } else {
        return '';
    }
}

function sendOrder($link)
{
    $sqlInsertOrders = "INSERT INTO `orders` (`id`, `user_id`, `address`) VALUES 
        (NULL, '" . $_SESSION['user']['id'] . "', '" . $_POST['address'] . "')";
    mysqli_query($link, $sqlInsertOrders);
    $sqlSelectOrder = "SELECT `id` FROM `orders` WHERE ID = (SELECT MAX(ID) FROM `orders`)";
    $resultSelect = mysqli_query($link, $sqlSelectOrder);
    $row = mysqli_fetch_assoc($resultSelect);
    $id = $row['id'];
    var_dump($sqlInsertOrders);
    foreach ($_SESSION['goods'] as $good) {
        $sqlInsertItems = "INSERT INTO `order_items` (`id`, `order_id`, `img_id`, `price`, `count`) VALUES 
        (NULL, '" . $id . "', '" . $good['id'] . "', '" . $good['price'] . "', '" . $good['count'] . "')";
        mysqli_query($link, $sqlInsertItems);
        var_dump($sqlInsertItems);
    }
}