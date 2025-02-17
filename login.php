<?php
require_once('db.php');

// Проверяем, был ли выполнен вход
if(isset($_POST['login']) && isset($_POST['password'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `Users` WHERE login = '$login'";
    $result = $conn->query($sql);

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];

        if(password_verify($password, $hashedPassword)) {
            // Если пароль верный, выводим приветственное сообщение и данные профиля
            $name = $row['name'];
            $surname = $row['surname'];
            $gender = $row['gender'];
            $email = $row['email'];
            $age18 = $row['age18'];

            
            setcookie('login', $login, time() + (86400 * 30), "/"); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль клиента</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container-fluid mt-2">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Добро пожаловать, <?php echo $name . ' ' . $surname; ?> !</h5>
                        <p class="card-text">Пол: <?php echo $gender; ?></p>
                        <p class="card-text">Возраст: <?php echo $age18; ?></p>
                        <p class="card-text">Email: <?php echo $email; ?></p>
                        <button onclick="logout()" class="btn btn-danger">Выход</button>
                        <button id="themeToggle" class="btn btn-dark float-right" style="position: absolute; top: 10px; right: 10px;">Сменить тему</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

  <!-- Форма для поиска по фамилии -->
<div class="container-fluid mt-1">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="search1.php" method="GET" class="search-form">
                <div class="form-row align-items-center">
                    <div class="col-9">
                        <div class="form-group yellow-text">
                            <label for="searchSurname">Поиск по фамилии:</label>
                            <input type="text" id="searchSurname" name="search" class="form-control inputSearch " style="width: 100%">
                        </div>
                    </div>
                    <div class="col-3">
                        <button type="submit" class="btn btn-dark btn-block">Искать</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Форма для поиска по фразе -->
<div class="container-fluid mt-1">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="search2.php" method="GET" class="search-form">
                <div class="form-row align-items-center">
                    <div class="col-9">
                        <div class="form-group yellow-text">
                            <label for="searchPhrase">Поиск по фразе:</label>
                            <input type="text" id="searchPhrase" name="search" class="form-control inputSearch" style="width: 100%">
                        </div>
                    </div>
                    <div class="col-3">
                        <button type="submit" class="btn btn-dark btn-block">Искать</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

    <!-- Статистика пользователей -->
    <div class="container-fluid mt-2">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-center">Статистика пользователей</h4>
                        <p>Список фамилий пользователей:</p>
                        <ul>
                            <?php
                            require_once('db.php');
                            $sql = "SELECT surname FROM Users";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<li>" . $row['surname'] . "</li>";
                                }
                            } else {
                                echo "<li>Нет зарегистрированных пользователей</li>";
                            }
                            ?>
                        </ul>
                        <?php
                        $sql = "SELECT COUNT(*) as totalRecords FROM Users";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();
                        $totalRecords = $row['totalRecords'];

                        $lastMonth = date('Y-m-d H:i:s', strtotime('-1 month'));
                        $sql = "SELECT COUNT(*) as recordsLastMonth FROM Users WHERE datereg >= '$lastMonth'";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();
                        $recordsLastMonth = $row['recordsLastMonth'];

                        $sql = "SELECT * FROM Users ORDER BY datereg DESC LIMIT 1";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();
                        $lastRecord = (isset($row['id']) ? " " . $row['id'] : "Нет данных") . 
                                      (isset($row['login']) ? " " . $row['login'] : "Нет данных") . 
                                      (isset($row['name']) ? " " . $row['name'] : "Нет данных") . 
                                      (isset($row['surname']) ? " " . $row['surname'] : "Фамилия: Нет данных");
                        ?>
                        <p>Всего сделано записей: <?php echo $totalRecords; ?></p>
                        <p>За последний месяц создано записей: <?php echo $recordsLastMonth; ?></p>
                        <p>Последняя запись: <?php echo $lastRecord; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>


<script>
    //ВЫХОД 
    function logout() {
    window.location.href = 'index2.php';
}

    window.onload = function() {
    var body = document.querySelector('body');
    var themeToggle = document.getElementById('themeToggle');

// Обработчик события для изменения темы
function changeTheme() {
    var themeValue = (body.classList.contains('dark')) ? 'light' : 'dark';
    if (themeValue === 'dark') {
        body.classList.add('dark');
        body.classList.remove('light'); // Удаляем класс 'light', если текущая тема темная
    } else {
        body.classList.add('light');
        body.classList.remove('dark'); // Удаляем класс 'dark', если текущая тема светлая
    }
}

document.getElementById('themeToggle').addEventListener('click', function() {
    const currentTheme = document.body.className;
    let newTheme = (currentTheme === 'light-theme') ? 'dark-theme' : 'light-theme'; // Определяем новую тему на основе текущей

    // Создаем AJAX запрос
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'update_theme.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log(xhr.responseText); // Ответ от сервера (полезно для отладки)
            if (xhr.responseText === 'success') {
                document.body.className = newTheme; // Устанавливаем новый класс темы после успешного обновления на сервере
            } else {
                alert('Произошла ошибка при обновлении темы.');
            }
        }
    };
    xhr.send('theme=' + newTheme);
});


    themeToggle.addEventListener('click', changeTheme);
};
</script>

<?php
        } else {
            // Если пароль неверный, выводим сообщение об ошибке
            echo "<div class='alert alert-danger' role='alert'>Неверный пароль. <a href='index2.php' class='alert-link'>Попробуйте ещё раз</a></div>";
        }
    } else {
        // Если пользователь с таким логином не найден, выводим сообщение об ошибке
        echo "<div class='alert alert-danger' role='alert'>Нет такого пользователя. <a href='index2.php' class='alert-link'>Попробуйте ещё раз</a></div>";
    }
} else {
    // Выводим форму входа, если данные для входа не были отправлены
    include('index2');
}
?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>