<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
    <!-- Подключение Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/../css/Log_in.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body card"> 
                <h2 class="text-center">Вход в систему</h2>
                <form action="login.php" method="POST">
                    <div class="form-group">
                        <label for="login">Логин:</label>
                        <input type="text" class="form-control" id="login" name="login" required>
                        <span id="error" style="color: red;"></span>
                    </div>
                    <div class="form-group">
                        <label for="password">Пароль:</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <img src="img/eye-closed-icon.png" alt="Показать/Скрыть пароль" style="width: 15px; height: 15px;">
                                </button>
                            </div>
                        </div>
                        <span id="error" style="color: red;"></span>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Войти</button>
                    <div class="form-group text-center">
                      <p>Для регистрации, нажмите<a href="index.php"> здесь</a>.</p>
                    </div>
                </form>
            </div>
        </div>
    </div>




<!-- Подключение Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../js/form.js"></script>

</body>
</html>
