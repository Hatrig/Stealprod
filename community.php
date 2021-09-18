<!doctype html>
<html lang="RU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Сообщество - Stealprod</title>
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
                        <a class="nav-item nav-link" href="/about">
                          О сервисе
                          <span id="line" style="background-color: #176091; box-shadow: 0px 3px 14px rgba(95,111,203,24);"></span>
                        </a>
                        <a class="nav-item nav-link" href="/price">
                          Цены
                          <span id="line" style="background-color: #176091; box-shadow: 0px 3px 14px rgba(95,111,203,24);"></span>
                        </a>
                        <a class="nav-item nav-link active" href="/community">
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
            <h2 class="main_page_slogan">Информация о сообществе</h2>
            <h1>Комьюнити проекта</h1>
            <br>
            <p class="main_page_info">В настоящий момент наш проект насчитывает <span id="users"><span id="users_count">1293</span>&nbsp клиента</span>, которые уже приобрели доступ. В нашей беседе
            <span id="members">293</span> участника, а в официальной группе Вконтакте <span id="group_members">600</span> участников. Коммьюнити активно развивается и растёт. Мы всегда рады новым людям и окажем вам
            помощь и содействие, в ваших начинаниях.</p>
            <script type="text/javascript" src="https://vk.com/js/api/openapi.js?169"></script>

            <!-- VK Widget -->
            <!-- VK Widget -->
            <div id="vk_groups"></div>
            <script type="text/javascript">
            VK.Widgets.Group("vk_groups", {mode: 3, wide: 1, width: "650", height: "550"}, 181631253);
            </script>
            
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