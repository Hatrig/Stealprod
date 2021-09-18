<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include './php/safemysql.php';
$db = new SafeMySQL();

$sql = "SELECT COUNT(*) FROM `users`";
$userCount = $db->getOne($sql);

$sql = "SELECT COUNT(*) FROM `logs`";
$logsCount = $db->getOne($sql);
?>

<!doctype html>
<html lang="RU">
<head>
<link rel="canonical" href="https://stealprod.ru/"/>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>StealProd - Лучший стиллер SAMP и CRMP.</title>
	<meta name="description" content="StealProd - Самый популярный сервис по стиллерам САМП и КРМП, а именно по добыче аккаунтов. У нас имеются множество форматов стиллера под мультиплееры SA:MP и CR:MP, а именно форматы -  CLEO, ASI, SF, DLL, LUA. Так-же у нас самые дешевые стиллеры для ГТА."> 
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/styles.css">
	<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(85029583, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/85029583" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<meta name="yandex-verification" content="0da4d73397701dce" />
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
                        <a class="nav-item nav-link active" href="/">
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
                <a class="nav-item nav-link btn-auth" href="/login">
                    Вход для клиентов
                    <span id="line" style="background-color: #176091; box-shadow: 0px 3px 14px rgba(95,111,203,24);"></span>
                  </a>
                
            </nav>
        </div>
    </header>

    <section class="main_page">
        <div class="container">
            <div class="d-flex justify-content-between">
                <div class="col-md-6">
                    <h2 class="main_page_slogan">Лидер в сфере заработка SAMP / CRMP</h2>
                    <h1 class="main_page_h">Добыча аккаунтов SAMP, CRMP</h1>
                    <p class="main_page_info"> Сервис осуществляющий добычу аккаунтов <b>SAMP, CRMP</b> с помощью плагинов форматов <b>CLEO, ASI, SF, DLL, LUA</b>.
                        <br><br>Работает на всех проектах <b>SAMP & CRMP</b>, осуществляет мнгновенную доставку лога в вашу панель. Обходит все существующие защиты, включая все версии антистиллера от Darkpixel.</p>
                    <div class="main_statistic">
                        <span id="users"><span id="users_count"><?php echo $userCount ?></span>&nbsp участника</span>
                        <span id="logs"><span id="logs_count"><?php echo $logsCount ?></span> &nbsp логов в базе</span>
                    </div>
                    <a href="/about" class="btn-main">Подробнее о сервисе</a>
                </div>
                <div class="col-md-6">
                    <div class="main_page_img"></div>
                    <div class="main_page_smoke"></div>
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