<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Регистрация</title>
  <!-- Подключение Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Подключение своего CSS -->
  <link rel="stylesheet" href="../css/Registration.css">
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>

<div class="container mt-4 mb-4">
  <div class="card"> 
    <div class="card-body">
      <h3 class="card-title text-center">Регистрация</h3>
      <form id="registrationForm" onsubmit="return validateForm()" action="register.php" method="post">
        <div class="form-group">
          <label for="name">Имя:</label>
          <input type="varchar" class="form-control" id="name" name="name" minlength="2" maxlength="15" required>
        </div>
        <div class="form-group">
          <label for="surname">Фамилия:</label>
          <input type="text" class="form-control" id="surname" name="surname" minlength="2" maxlength="15" required>
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
          <label for="login">Логин:</label>
          <input type="text" class="form-control" id="login" name="login" minlength="6" required>
        </div>
        <div class="form-group">
          <label for="password">Пароль:</label>
          <div class="input-group">
              <input type="password" class="form-control" id="password" name="password" minlength="8" required>
              <div class="input-group-append">
                  <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                      <img src="img/eye-closed-icon.png" alt="Показать/Скрыть пароль" style="width: 15px; height: 15px;">
                  </button>
              </div>
          </div>
        </div>
        <div class="form-group">
          <label for="confirmPassword">Подтверждение пароля:</label>
          <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" minlength="8" required>
          <span id="passwordMatch" style="color: red;"></span>
        </div>
        <div class="form-group form-check">
          <input type="checkbox" class="form-check-input" id="termsCheckbox" required>
          <label class="form-check-label" for="termsCheckbox">Я даю своё согласие на обработку персональных данных.</label>
        </div>
        <div class="form-group row">
            <label for="ageSelect" class="col-sm-3 col-form-label">Мне:</label>
            <div class="col-sm-9">
                <select class="form-control" id="ageSelect" name="age18" required>
                    <option value="">Выберите...</option>
                    <option value="Есть 18">Есть 18 лет</option>
                    <option value="Нет 18">Нет 18 лет</option>
                </select>
            </div>
        </div>
        <div class="form-group d-flex">
          <label class="mr-3">Пол:</label>
          <div class="form-check form-check-inline" >
            <input type="radio" class="form-check-input" id="maleRadio" name="gender" value="Мужской" required>
            <label class="form-check-label" for="maleRadio">Мужской</label>
          </div>
          <div class="form-check form-check-inline">
            <input type="radio" class="form-check-input" id="femaleRadio" name="gender" value="Женский" required>
            <label class="form-check-label" for="femaleRadio">Женский</label>
          </div>
        </div>
        <!-- Капча -->
        <div class="form-group" required>
          <div class="g-recaptcha" data-sitekey="6LdXu8kpAAAAABft2ULrvd98KeyfgCVRMQ2Gii3s" ></div>
          <div id="captchaError" style="color: red;"></div>
        </div>   
        <div class="form-group text-center">
          <button type="submit" class="btn btn-primary btn-block" id="registerButton">Зарегистрироваться</button>
        </div>
        <div class="form-group text-center">
          <p>Если есть аккаунт, нажмите<a href="index2.php"> здесь</a>.</p>
        </div>
      </form>
    </div>
  </div>
</div>



<!-- Подключение Bootstrap JS и своего JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../js/validation.js"></script>
<script src="../js/form.js"></script>


</body>
</html>
