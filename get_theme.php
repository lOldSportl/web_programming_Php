<?php
// Подключаемся к базе данных
require_once('db.php');

// Проверяем, авторизован ли пользователь
session_start();
if (!isset($_SESSION['login'])) {
    // Если пользователь не авторизован, отправляем ошибку
    http_response_code(401); // Unauthorized
    exit("Unauthorized");
}

// Получаем логин пользователя из сессии
$login = $_SESSION['login'];

// Получаем тему пользователя из базы данных
$sql = "SELECT theme FROM Users WHERE login = '$login'";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    // Если запрос выполнен успешно и найдена запись о пользователе
    $row = $result->fetch_assoc();
    $theme = $row['theme'];
    
    // Отправляем тему в ответ на запрос
    echo $theme;
} else {
    // Если пользователь не найден в базе данных или произошла ошибка
    http_response_code(500); // Internal Server Error
    exit("Internal Server Error");
}

// Закрываем соединение с базой данных
$conn->close();
?>
