const togglePassword = document.getElementById('togglePassword');
const password = document.getElementById('password');

    togglePassword.addEventListener('click', function (e) {
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    this.querySelector('img').src = type === 'password' ? 'img/eye-closed-icon.png' : 'img/eye-open-icon.png';
});
