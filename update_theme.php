<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $theme = $_POST['theme'];
    $login = $_COOKIE['login'];
    
    // Подключение к базе данных и выполнение запроса
    $mysql = new mysqli('localhost', 'root', '', 'DB');

    // Проверяем соединение на ошибки
    if ($mysql->connect_error) {
        die("Connection failed: " . $mysql->connect_error);
    }

    $result = $mysql->query("UPDATE Users SET theme = '$theme' WHERE login = '$login'");

    // Проверяем, было ли обновление успешным
    if ($result) {
        $_SESSION['theme'] = $theme;
        echo "success";
    } else {
        echo "error: " . $mysql->error;
    }

    $mysql->close(); // Закрываем соединение с базой данных
}
?>
