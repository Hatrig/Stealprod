<!doctype html>
<html lang="RU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Активация ключа - Stealprod</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
    <div class="loader"></div>
    <div class="info-alert-mini">
        <div class="info-alert-mini-content">
            <div class="icon"></div>
            <h3></h3>
        </div>
    </div>
    <div class="info-alert">
        <div class="icon"></div>
        <h3></h3>
    </div>
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
                <a class="nav-item nav-link btn-auth active" href="/community">
                    Вход для клиентов
                    <span id="line" style="background-color: #176091; box-shadow: 0px 3px 14px rgba(95,111,203,24);"></span>
                  </a>
                
            </nav>
        </div>
    </header>

    <section class="auth_page">
        <div class="container">
            <div class="head_part">
                <h2 class="main_page_slogan">Активация ключа</h2>
                <h1 class="main_page_h">Stealprod<span id="point">.</span></h1>
            </div>
            <div class="elems-wrapper">
                <div class="elems-header">
                    <div class="step active" name="1">
                        <p>1</p>
                        <h3>ВВЕДИТЕ КЛЮЧ</h3>
                    </div>
                    <div class="step hidden" name="2">
                        <p>2</p>
                        <h3>ПРИДУМАЙТЕ ПАРОЛЬ</h3>
                    </div>
                    <div class="step hidden" name="3">
                        <p>3</p>
                        <h3>НАЧИНАЙТЕ ПОЛЬЗОВАТЬСЯ</h3>
                    </div>
                </div>
                <div class="elems-content">
                    <form name="1" id="registerLoginForm" class="step-content animated">
                        <div class="input animated" name="login">
                            <div class="icon"></div>
                            <input autocomplete="off" autofocus="" maxlength="20" title="Введите ключ активации, который вы купили в нашем магазине" type="text" required="" placeholder="Введите ключ">
                            <div class="alert animated" style="display:none"><i class="fa fa-ban" aria-hidden="true"></i></div>
                        </div>
                        <div class="input hidden animated" name="password" style="display:none">
                            <div class="icon"></div>
                            <input autocomplete="off" type="password" maxlength="100" title="Минимум 6 символов" required="" disabled="" placeholder="Придумайте пароль">
                        </div>
                        <button type="submit" value="registerLogin">Продолжить</button>
                    </form>
                    <div name="2" id="finish" class="step-content hidden animated" style="display:none">
                        <h2>УСПЕШНАЯ АКТИВАЦИЯ</h2>
                        <h3>
                            Вы успешно активировали ключ: <span name="login">ключ</span>, ваша панель управления готова.
                            <br><br>
                            Ваш ID базы: <span name="idbase"></span>,<br> ваш пароль: <span name="pwd"></span>
                            <br><br>
                            <span>ЗАПОМНИТЕ ЭТИ ДАННЫЕ! ВОССТАНОВИТЬ ИХ БУДЕТ НЕЛЬЗЯ!</span><br><br>
                            К вашему аккаунту мы советуем привязать аккаунт Вконтакте, сделать это вы сможете в личном кабинете.
                        </h3><br>
                        <a href="https://stealprod.ru/login"><button>Авторизоваться</button></a>
                    </div>
                </div>
            </div>
            <!-- <form action="" class="auth_form" method="POST">
                <input type="text" class="auth_inp" placeholder="Ключ">
                <button type="submit" class="btn-main" style="margin: 0 auto; margin-top: 40px;">Активировать</button>
            </form> -->
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
    <script src="./js/activate.js"></script>
</body>
</html>