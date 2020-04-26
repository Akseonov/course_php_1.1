<?php

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