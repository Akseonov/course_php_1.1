<?php

function renderImg($link, $id)
{
    $str = '';
    $dir = DIR_IMG . "/";
    $sqlSelect = "SELECT `id`, `big_name`, `price`, `description`, `name`, `big`, `small`, `vews` FROM `img` WHERE `id`=" . $id;
    $sqlUpdate = "UPDATE `img` SET `vews` = `vews` + 1 WHERE `img`.`id` = " . $id;
    $sqlReview = "SELECT `id`, `review`, `name`, `data`, `picture` FROM `review` WHERE `picture`=" . $id . " ORDER BY `review`.`id` DESC";
    $sqlInsert = "INSERT INTO `review` (`id`, `review`, `name`, `data`, `picture`) 
    VALUES (NULL, '" . mysqli_real_escape_string($link, strip_tags($_POST['review'])) . "', '" . $_SESSION['user']['login'] . "', '" . date('Y-m-d') . "', '" . $id . "')";

    $resultSelect = mysqli_query($link, $sqlSelect);
    mysqli_query($link, $sqlUpdate);
    $result = mysqli_query($link, $sqlReview);

    while ($rowReview = mysqli_fetch_assoc($result)) {
        $str .= "<hr><div>
                <div>
                    <p>" . $rowReview['name'] . "</p>
                    <p>" . $rowReview['data'] . "</p>
                    <p>" . $rowReview['review'] . "</p>
                </div>
            </div>";
    }

    if (!empty($_POST['review'])) {
        mysqli_query($link, $sqlInsert);

        header("Location: /?p=" . $_GET['p'] . "&id=" . $_GET['id'] . "");
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
            $_SESSION['goods'][$_POST['id']]['count']++;
        }
    }

    if (checkAuth()) {
        $formReview = "<form method='post'>
        <textarea name='review'></textarea>
        <input type='submit' value='Оставить отзыв'>
    </form>";
    } else {
        $formReview = '';
    }

    $row = mysqli_fetch_assoc($resultSelect);


    return "<div id=\"main\">
        <div class=\"post_title\"><h2>" . $row['big_name'] . "</h2></div>
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
        </div>
        </div>";
}