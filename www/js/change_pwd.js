const form = document.querySelector('.change_pwd_form');

form.addEventListener('submit', function (evt) {
    evt.preventDefault();
    var pwd1 = null;
    var pwd2 = null;
    pwd1 = document.querySelector('#pwd1').value;
    pwd2 = document.querySelector('#pwd2').value;

    if (!pwd1) {
        alert('Введите пароль');
        return false;
    }
    if (!pwd2) {
        alert('Введите повтор пароля');
        return false;
    }
    if (pwd1 != pwd2) {
        alert('Пароли не совпадают');
        return false;
    }
    this.submit();
});