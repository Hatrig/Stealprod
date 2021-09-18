var servResponse = document.querySelector('.alert-text p');

document.forms.loginForm.onsubmit = function(e){
    e.preventDefault();

    var userLogin = document.forms.loginForm.login__inp.value;
    userLogin = encodeURIComponent(userLogin);
    var userPassword = document.forms.loginForm.password__inp.value;
    userPassword = encodeURIComponent(userPassword);
    var reCaptch = grecaptcha.getResponse(); // - это раскоментировать после добавления гугл-капчи


    var xhr = new XMLHttpRequest();

    xhr.open('POST', '../php/login.php');

    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function(){
        if(xhr.readyState === 4 && xhr.status === 200){
            servResponse.textContent = xhr.responseText;
            if(xhr.responseText === 'Авторизация прошла успешно'){
                location.reload();
            }
            if(xhr.responseText === 'okАвторизация прошла успешно'){
                location.reload();
            }
        }
    }

     xhr.send('login__inp=' + userLogin + '&password__inp=' + userPassword + '&g-recaptcha-response=' + reCaptch); // вместе с капчей - этот запрос
  //  xhr.send('login__inp=' + userLogin + '&password__inp=' + userPassword);
}