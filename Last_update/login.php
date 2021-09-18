<?php
if(!isset($_SESSION)) session_start();
if (isset($_SESSION['login'])) echo '<script> window.location="cp"; </script>';
?>

<!doctype html>
<html lang="RU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Вход для клиентов - Stealprod</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/styles.css">
	<script src="https://www.google.com/recaptcha/api.js"></script>
</head>
<body>
    <div class="loader"></div>
    <div class="gta_bg">
        <video autoplay="" loop="" muted="">
            <source src="./video/gta.mp4" type="video/mp4">
        </video>
    </div>
    <div class="glitch-effect"></div>
    <header>
        <div class="container">
            <nav class="navbar navbar-expand-lg justify-content-between">
                <a href="/" class="navbar-brand">Stealprod<span id="point">.</span></a>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-item nav-link" href="/">
                            Главная
                            <span id="line" style="background-color: #176091; box-shadow: 0px 3px 14px rgba(95,111,203,24);"></span>
                          </a>
                        <a class="nav-item nav-link" href="/about">
                          О сервисе
                          <span id="line" style="background-color: #176091; box-shadow: 0px 3px 14px rgba(95,111,203,24);"></span>
                        </a>
                        <a class="nav-item nav-link" href="/price">
                          Цены
                          <span id="line" style="background-color: #176091; box-shadow: 0px 3px 14px rgba(95,111,203,24);"></span>
                        </a>
                        <a class="nav-item nav-link" href="/community">
                          Коммьюнити
                          <span id="line" style="background-color: #176091; box-shadow: 0px 3px 14px rgba(95,111,203,24);"></span>
                        </a>
                        
                    </div>
                </div>
                <a class="nav-item nav-link btn-auth active" href="/login">
                    Вход для клиентов
                    <span id="line" style="background-color: #176091; box-shadow: 0px 3px 14px rgba(95,111,203,24);"></span>
                  </a>
                
            </nav>
        </div>
    </header>

    <section class="auth_page">
        <div class="container">
            <div class="head_part">
                <h2 class="main_page_slogan">Вход для клиентов</h2>
                <h1 class="main_page_h">Stealprod<span id="point">.</span></h1>
            </div>
            <form action="" class="auth_form" name="loginForm">
                <div class="alert-text"><p></p></div>
                <input type="text" class="auth_inp" placeholder="ID базы" name="login__inp">
                <input type="password" class="auth_inp" placeholder="Пароль" name="password__inp">
				<div class="g-recaptcha" data-sitekey="6Lfmb1MUAAAAAL2fizDJ7SYH5hFQw14ocRVV6NvZ" id="grecaptcha" style="transform:scale(0.8); transform-origin:0;"></div>
                <button type="submit" value="Login" class="btn-main" style="margin: 0 auto; margin-top: 40px;">Войти в панель</button>
            </form>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="copyright">
                <span id="copy">Stealprod 2018-2021 &copy; Последнее обновление от 30 июля 2021 г. // При поддержке <a href="https://t.me/alligator9728">barspinOff</a></span> <br>
                <span id="fermin_letter">Designed with love by <b>USEC&nbsp</b></span><br>
                
            </div>
        </div>
    </footer>

    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/main.js"></script>
    <script src="./js/loggg.js"></script>
</body>
</html>