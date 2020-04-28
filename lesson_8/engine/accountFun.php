<?php

function renderAccount($link)
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($_POST['login']) || empty($_POST['password'])) {
            header('location: /?p=account');
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
        header('location: /?p=account');
    }

    if (!empty($_GET['exit'])) {
        session_destroy();
        header('location: /?p=account');
    }

    if (!empty($_SESSION['auth'])) {
        return "<h1>Добро пожаловать</h1>
            <a href=\"?p=account&exit=1\">Выход</a>";
    } else {
        return "<form method=\"post\">
            <input type=\"text\" name=\"login\" placeholder=\"login\">
            <input type=\"text\" name=\"password\" placeholder=\"password\">
            <input type=\"submit\">
        </form>";
    }
}