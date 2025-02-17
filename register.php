<?php
require_once('db.php');

$recaptcha_secret = '6LdXu8kpAAAAAFEXHeDsL_X-NmzChSKfEibjb0BT';
$response = $_POST['g-recaptcha-response'];

$verify = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$recaptcha_secret.'&response='.$response);

$captcha_success = json_decode($verify);

if ($captcha_success->success)
{
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];
    $encrypted_password = password_hash($password, PASSWORD_DEFAULT);
    $gender = $_POST['gender'];
    $age18 = $_POST['age18']; 
    $date_registered = date("Y-m-d H:i:s");

    
    // Проверяем, есть ли пользователь с таким же именем пользователя или адресом электронной почты
    $check_query = "SELECT * FROM Users WHERE login='$login' OR email='$email'";
    $result = $conn->query($check_query);
    
    if ($result->num_rows > 0) 
    {
        echo "Пользователь с таким именем пользователя или адресом электронной почты уже существует";
    } else 
    {
        echo $name, $surname, $email, $login, $encrypted_password, $gender, $age18, $date_registered;
        $sql = "INSERT INTO Users (name, surname, email, login, password, gender, age18, datereg) 
        VALUES ('$name', '$surname', '$email', '$login', '$encrypted_password', '$gender', '$age18', '$date_registered')";
        if($conn->query($sql) === TRUE) 
        {
            echo "<div class='alert alert-danger' role='alert'>Успешная регистрация!) Теперь можно<a href='index2.php' class='alert-link'> войти.</a></div>";              
        } 
        else 
        {
            echo "Ошибка: " . $conn->error;
        }
    }
} else{echo "<div class='alert alert-danger' role='alert'>Подтвердите, что вы не робот!<a href='index1.php' class='alert-link'> Вернуться</a></div>";}
?>
