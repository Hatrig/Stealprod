<!doctype html>
<html lang="RU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>О сервисе - Stealprod</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/styles.css">
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
                        <a class="nav-item nav-link active" href="/about">
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
                <a class="nav-item nav-link btn-auth" href="/login">
                    Вход для клиентов
                    <span id="line" style="background-color: #176091; box-shadow: 0px 3px 14px rgba(95,111,203,24);"></span>
                  </a>
                
            </nav>
        </div>
    </header>

    <section class="about">
        <div class="container">
            <h2 class="main_page_slogan">Информация о сервисе Stealprod</h2>
            <h1>Для любопытствующих</h1>
            <br>
            <div class="about_info">
                <div class="about_focus">
                    <h1 class="about_h1"> — Да кто такой, этот Ваш Stealprod?</h1>
                    <p class="about_page_info">
                    Stealprod - это сервис добычи аккаунтов SAMP & CRMP с помощью специальных внутриигровых плагинов, который был разработан в 2018 году дуэтом разработчиков в составе Fermin & Barspinoff.
                    <br><br>В состав приобретаемого продукта входят: панель управления клиента, а также внутриигровые плагины разных форматов, которые отвечают за отправку игровых аккаунтов.
                    </p>
                    <h1 class="about_h1"> — Что ещё за внутриигровые плагины?</h1>
                    <p class="about_page_info">
                    Внутриигровые плагины - так мы называем наши продукты форматов CLEO, ASI, SF, DLL, LUA, которые попадая в папку с игрой, пересылают данные введённые в игровом диалоге 
                    в панель клиента. <br><br>Эти данные направляются в панель в виде лога, в состав которого входит никнейм игрового персонажа, название и IP адрес сервера, на котором он играет,
                    IP адрес самого игрока, а также данные, которые он ввёл в игровой диалог, это может быть пароль, защитный ключ, пин-код от банковской ячейки и т.д. 
                    <br><br>Помимо этой информации, к каждому логу прикреплена
                    информация об игровом аккаунте и его статистика, с которой вы можете ознакомится прямо в панели клиента, не переходя в игру.
                    </p>
                    <h1 class="about_h1"> — Что такое панель клиента?</h1>
                    <p class="about_page_info">
                    Панель клиента, она же - панель управления - это личный кабинет клиента Stealprod, который вы получаете после покупки доступа. В неё вам будут приходить игровые аккаунты в виде логов, после их распространения. У каждого клиента - своя панель, свои плагины.
                    Логи, которые вы получите в свою панель - только ваши, их не видят другие участники проекта. <br><br>
                    Панель управления Stealprod - имеет богатый функционал, который облегчит вам управление вашими логами. Почитать о последних новинках вы можете в нашем официальном сообществе Вконтакте, в статье с информацией об обновлении.
                    </p>
                </div>
            </div>
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
</body>
</html>