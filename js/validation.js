  function validateForm() {
  var firstName = document.getElementById('name').value;
  var lastName = document.getElementById('surname').value;
  var email = document.getElementById('email').value;
  var username = document.getElementById('login').value;
  var password = document.getElementById('password').value;
  var confirmPassword = document.getElementById('confirmPassword').value;
  var age = document.getElementById('ageSelect').value;
  var gender = document.querySelector('input[name="gender"]:checked');

  // Проверка на валидность имени и фамилии
  if (firstName.length < 2 || firstName.length > 15 || lastName.length < 2 || lastName.length > 15) {
    alert("Имя и фамилия должны содержать от 2 до 15 символов.");
    return false;
  }

  // Проверка на валидность имени и фамилии
  var namePattern = /^[а-яА-ЯёЁa-zA-Z]+$/;
  if (!namePattern.test(firstName)) {
    alert("Имя должно содержать только буквы.");
    return false;
  }

  if (!namePattern.test(lastName)) {
    alert("Фамилия должна содержать только буквы.");
    return false;
  }


  // Проверка на валидность email
  var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailPattern.test(email)) {
    alert("Пожалуйста, введите корректный email адрес.");
    return false;
  }

  // Проверка на валидность логина
  if (username.length < 6) {
    alert("Логин должен содержать не менее 6 символов.");
    return false;
  }

  // Проверка на валидность пароля
  var passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/;
  if (!passwordPattern.test(password)) {
    alert("Пароль должен содержать не менее 8 символов, включая как минимум одну цифру, одну прописную и одну строчную букву.");
    return false;
  }

  // Проверка совпадения пароля и подтверждения пароля
  if (password !== confirmPassword) {
    alert("Пароль и подтверждение пароля не совпадают.");
    return false;
  }

  return true;
}

// Обработчики событий для проверки пароля и подтверждения пароля
document.getElementById('password').addEventListener('keyup', function() {
  var password = document.getElementById('password').value;
  var confirmPassword = document.getElementById('confirmPassword').value;
  var passwordMatch = document.getElementById('passwordMatch');

  if (password === '' && confirmPassword === '') {
    passwordMatch.innerText = ''; 
  } else if (password === confirmPassword) {
    passwordMatch.innerText = 'Пароли совпадают';
  } else {
    passwordMatch.innerText = 'Пароли не совпадают';
  }
});

document.getElementById('confirmPassword').addEventListener('keyup', function() {
  var password = document.getElementById('password').value;
  var confirmPassword = document.getElementById('confirmPassword').value;
  var passwordMatch = document.getElementById('passwordMatch');

  if (password !== confirmPassword) {
    passwordMatch.innerText = 'Пароли не совпадают';
  } else {
    passwordMatch.innerText = ''; 
  }


});