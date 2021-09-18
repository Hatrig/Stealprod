<?php 
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

session_start();
include './php/safemysql.php';
$db = new SafeMySQL();

if (!isset($_SESSION['login'])) echo '<script> window.location="login"; </script>';

if (isset($_SESSION['login'])) 
{
	$login = $_SESSION['login'];
	if ($login == '') {
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

if ($logcount !== 0) {

    // Рабочий счетчик логов за сегодня, вчера и неделю.
    $n = $db->getOne("SELECT COUNT(*) FROM `logs` WHERE `date` LIKE '%$nowtime%'");
    $y = $db->getOne("SELECT COUNT(*) FROM `logs` WHERE `date` LIKE '%$yerstadaytime%'");
    $w = 0;


// Конец счетчика
} 


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
else {
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
				<a target="_blank" href="/help"><li name="forum">Помощь новичку</li></a>
				<a href="/shop"><li name="start">Магазин</li></a>
				<a href="https://vk.com/stlprd"><li name="shop">Группа вконтакте</li></a>
				<a href="https://vk.me/join/AJQ1d9h9nAaT/Q2JyEVLNWeS" target="_blank"><li name="help">Беседа вконтакте</li></a>
								 
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
			<a href="/index"><li name="">Главная</li></a>
			<a target="_blank" href="/help.php"><li class="link">Помощь новичку<span style="color: red"> (FIX!)</span></li></a>
			<a href="/shop"><li name="start">Магазин</li></a>
			<a href="https://vk.com/stlprd"><li name="shop">Группа вконтакте</li></a>
			<a href="https://vk.me/join/AJQ1d9h9nAaT/Q2JyEVLNWeS" target="_blank"><li name="help">Беседа вконтакте <span style="color: red">(NEW!)</span></li></a>
		</ul>
			<div class="control two">
			<a name="profile" href="http://stealprod.ru/cp">
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
						<a><button name="balance">Докупка форматов</button></a>		
						<a href="https://vk.com/iwuds"><button name="addchar">Пиар стиллера</button></a>				
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
	<link rel="stylesheet" href="./jscss/profile.css">
	
		<div class="scroll-to-up-wrapper" style="display: none;">
			<div class="scroll-to-up">
				<div class="icon"></div>
				<p>Вверх</p>
			</div>
		</div>

			<div class="block profile">
			<div class="content">
				<h2>Панель управления</h2>
				<h3>Ваши логи, различные настройки и другое</h3>
				
				<div class="main-info">
					<div class="info-blocks-wrapper">
						<div class="info-block">
							<p><span>Логов за сегодня:</span><span><? echo $n ?> строк</span></p>
							<p><span>Логов за вчера:</span><span><? echo $y ?> строк</span></p>
							<p><span>Логов за 2 дня:</span><span><? echo $n+$y+$w; ?> строк</span></p>
							<p><span>Логов за все время:</span><span><? echo $logcount ?> строк</span></p>
						</div>
						<div class="info-block">
							<p><span>Ваш ID:</span><span><? echo $id ?></span></p>
							<p><span>Ваш ник:</span><span><? echo $nickname ?></span></p>
							<p><span>На балансе:</span><span><? echo $balance ?> рублей</span></p>
							<p><span>Привязка VK:</span><span><? echo $vkstatus ?></span></p>
						</div>
					</div>
				</div>

				<div class="profile-nav-wrapper">
					<button name="dl__steal" class="download"><div class="icon"></div>Скачать плагины</button>
					<button name="dl__logs" class="download"><div class="icon"></div>Скачать логи</button>
					<button name="clogs" class="delete"><div class="icon"></div>Очистить логи</button>
					<button name="filter" class="filter"><div class="icon"></div>Фильтр</button>
					<button name="antispam" class="ban"><div class="icon"></div>Антиспам</button>
					<button name="reg" class="info"><div class="icon"></div>Рег. данные</button>
				</div>
				<? if ($logcount == 0) {?>
					<div class="logs">
						<table>
							<tbody><tr class="title">
								<th>Дата прихода</th>
								<th>Логин</th>
								<th>ID диалога</th>
								<th>Данные</th>
								<th>Статистика</th>
								<th>Название сервера</th>
								<th>IP сервера</th>
								<th>IP аккаунта</th>
							</tr>
						   </tbody>
						   <tr>
					       <td></td>
					       <td></td>
					       <td></td>
					       <td></td>
					       <td>Лог пуст</td>
					       <td></td>
					       <td></td>
					       <td></td>
				           </tr>
				       </table>
				   </div>
				<? } else { ?>
					<div id="data"></div>
				<? } ?>
			</div>
	</div>
	

	<div class="footer">
	<div class="links">
		<a href="https://vk.com/stlprd" target="_blank"><div class="icon vk"></div></a>
		<a href="https://vk.me/iwuds"><div class="icon help"></div></a>
		<a href="mailto:admin@stealprod.ru"><div class="icon mail"></div></a>
	</div>
	<h4>Для предложений: vk.com/iwuds</h4>
	<h3>STEALPROD © 2018-2020</h3>
	<div class="age"></div>
</div>
		</div>

		<!-- Настройки логов -->
		<div class="modal-wrapper notifysettings settings">
			<div class="modal-content-wrapper">
				<div class="closer"></div>
				<div class="modal-content">
					<div class="closer-icon"></div>
					<h2>Настройки логов<span></span></h2>
					<h3 id="setinfo">Выберите какие логи будут отображаться в панели</h3>
					<form name="settingsForm">
						<div class="settings-content">
							<div class="settings-wrapper" name="settings">
								
					<div class="setting <? if ($topserver == 1) echo "active"; ?>" id="topservers">
						<p>Только популярные сервера</p>
						<div class="selector"></div>
					</div>
				
					<div class="setting <? if ($topdialogs == 1) echo "active"; ?>" id="topdids">
						<p>Только важные диалоги</p>
						<div class="selector"></div>
					</div>
				
					<div class="setting <? if ($nonerepeat == 1) echo "active"; ?>" id="nonrep">
						<p>Не отображать повторения</p>
						<div class="selector"></div>
					</div>
				
					<!--<div class="setting" data-name="c_rent">
						<p>Не отображать 1 лвл</p>
						<div class="selector"></div>
					</div>
				
					<div class="setting" data-name="c_help">
						<p>Не отображать аккаунты с менее 100.000$</p>
						<div class="selector"></div>
					</div> -->
				
											</div>
							
						</div>
						<button name="set__button">Применить</button>
					</form>
				</div>
			</div>
		</div>
		<!-- Настройки логов конец -->
	
					
		
		<!-- Смена пароля -->
		<div class="modal-wrapper password settings">
			<div class="modal-content-wrapper">
				<div class="closer"></div>
				<div class="modal-content">
					<div class="closer-icon"></div>
					<h2>Смена пароля</h2>
					<h3>Для смены пароля на балансе должно быть 50 рублей. Чтобы пополнить баланс отпиши <a href="https://vk.com/iwuds">Fermin'у (кликабельно)</a>
					<h3 id="pwdinfo"></h3>
					<form action name="passwordForm">
						<div class="input animated" name="oldpassword">
							<div class="icon"></div>
							<input name="oldpassword__inp" autofocus="" maxlength="100" autocomplete="off" type="password" title="Минимум 6 символов" required placeholder="Введите текущий пароль">
							<div class="alert animated" style="display:none;"><i class="fa fa-ban" aria-hidden="true"></i></div>
						</div>
						<div class="input animated" name="newpassword">
							<div class="icon"></div>
							<input name="newpassword__inp" autofocus="" maxlength="100" autocomplete="off" type="password" title="Минимум 6 символов" required placeholder="Введите новый пароль">
							<div class="alert animated" style="display:none;"><i class="fa fa-ban" aria-hidden="true"></i></div>
						</div>
						<div class="input animated" name="renewpassword">
							<div class="icon"></div>
							<input name="newpasswordrepeat__inp" autofocus="" maxlength="100" autocomplete="off" type="password" title="Минимум 6 символов" required placeholder="Повторите новый пароль">
							<div class="alert animated" style="display:none;"><i class="fa fa-ban" aria-hidden="true"></i></div>
						</div>
						<button type="submit" name="password__button">Сменить</button>
					</form>
					<div class="img password"></div>
				</div>
			</div>
		</div>
        <!-- Конец смены пароля -->

        <!-- Смена ника -->
		<div class="modal-wrapper nickname settings">
			<div class="modal-content-wrapper">
				<div class="closer"></div>
				<div class="modal-content">
					<div class="closer-icon"></div>
					<h2>Смена ника</h2>
					<h3 id="nickinfo"></h3>
					<form name="nicknameForm">
						<div class="input animated" name="name">
							<div class="icon"></div>
							<input name="nickname__inp" autofocus="" maxlength="100" autocomplete="off" type="text" title="Введите ник" required placeholder="Введите ник">
							<div class="alert animated" style="display:none;"><i class="fa fa-ban" aria-hidden="true"></i></div>
						</div>
						<button name="nickname__button">Сменить</button>
					</form>
					<div class="img blank"></div>
				</div>
			</div>
		</div>
        <!-- Конец смены ника -->

        <!-- Привязка вк -->
		<div class="modal-wrapper vk settings">
			<div class="modal-content-wrapper">
				<div class="closer"></div>
				<div class="modal-content">
					<div class="closer-icon"></div>
					<? if ($vkact !== 'activated') { ?>
					<h2>Привязка вк</h2>
					<form name="vkFormPr">
						<h4>Для привязки вк к панели, отправьте ваш ключ активации в личные сообщения сообщества SP. Ваш ключ: <? echo $vkact; ?></h4>
						<button name="vkPr">Отправить</button>
					</form>
				    
				    <div style="display: none;">
				    <h2>Привязка вк</h2>
                    <h3 id="vkout">Ваша панель уже привязана к Вконтакте.</h3>
                    <form name="vkFormOt">
						<button name="vk__button">Отвязать</button>
					</form>
				    </div>
				    <? } else { ?>
				    <div style="display: none;">
				    <h2>Привязка вк</h2>
					<form name="vkFormPr">
						<p>Для привязки вк к панели, отправьте ваш ключ активации в личные сообщения сообщества SP. Ваш ключ: <b><? echo $vkact; ?></b>, затем обновите эту страницу.</p>
						<button name="vkPr">Отправить</button>
					</form>
				    </div>
				    
				    <h2>Привязка вк</h2>
                    <h3 id="vkout">Ваша панель уже привязана к Вконтакте.</h3>
                    <form name="vkFormOt">
						<button name="vk__button">Отвязать</button>
					</form>
				    <? } ?>	
					<div class="img blank"></div>
				</div>
			</div>
		</div>
        <!-- Конец привязки вк -->

        <!-- Пополнение баланса -->
		<div class="modal-wrapper balance settings">
			<div class="modal-content-wrapper">
				<div class="closer"></div>
				<div class="modal-content">
					<div class="closer-icon"></div>
					<h2>Докупка формата</h2>
					<h3>Желаешь дополнить свою панель новыми форматами? Ты можешь приобрести эту услугу у <a href="https://vk.com/iwuds">Фермина</a></h3>
						<a href="https://vk.com/iwuds">Связаться</a>
					<div class="img password"></div>
				</div>
			</div>
		</div>
        <!-- Конец смены ника -->

        <!-- Пополнение баланса -->
		<div class="modal-wrapper addchar">
			<div class="modal-content-wrapper">
				<div class="closer"></div>
				<div class="modal-content">
					<div class="closer-icon"></div>
					<h2>Пиар стиллера</h2>
					<h3>Вы можете заказать пиар вашего стиллера у Фермина.</h3>
						<a href="https://vk.com/iwuds">Связаться</a>
					<div class="img password"></div>
				</div>
			</div>
		</div>
        <!-- Конец смены ника -->


		
			<div class="modal-wrapper email">
			<div class="modal-content-wrapper">
				<div class="closer"></div>
				<div class="modal-content">
					<div class="closer-icon"></div>
					<h2>Привязать электронный адрес</h2>
					<form id="emailForm">
						<div class="input animated" name="email">
							<div class="icon"></div>
							<input autofocus="" type="email" required="" placeholder="Введите Email">
							<div class="alert animated" style="display:none;"><i class="fa fa-ban" aria-hidden="true"></i></div>
						</div>
						<input type="hidden" name="key" value="9f3f39e7a0c96e2f58f418a950b03273">
						<button type="submit" value="Add">Привязать</button>
					</form>
					<div class="img email"></div>
				</div>
			</div>
		</div>

	<!-- Очистка логов -->
		<div class="modal-wrapper clearlogs">
			<div class="modal-content-wrapper">
				<div class="closer"></div>
				<div class="modal-content">
					<div class="closer-icon"></div>
					<h2>Вы действительно хотите очистить логи?</h2>
					<form name="logsClear">
						<button name="clear__button">Да, очистить</button>
					</form>
					<div class="img password"></div>
				</div>
			</div>
		</div>
		<!-- Конец очистки логов -->

		<!-- Скачать логи -->
		<div class="modal-wrapper dlogs">
			<div class="modal-content-wrapper">
				<div class="closer"></div>
				<div class="modal-content">
					<div class="closer-icon"></div>
					<h2>Какие логи вы хотите скачать?</h2>
					
						<a class="a-button" href="/php/download.php?file=logs" target="_blank">Скачать все логи</a>
						<a class="a-button" href="/php/download.php?file=arizona" target="_blank">Скачать логи Arizona</a>
						<a class="a-button" href="/php/download.php?file=drp" target="_blank">Скачать логи Diamond</a>
						<a class="a-button" href="/php/download.php?file=srp" target="_blank">Скачать логи Samp-Rp</a>
						<a class="a-button" href="/php/download.php?file=arp" target="_blank">Скачать логи Advance</a>
						<a class="a-button" href="/php/download.php?file=evolve" target="_blank">Скачать логи Evolve</a>
						<a class="a-button" href="/php/download.php?file=trinity" target="_blank">Скачать логи Trinity</a>
						<a class="a-button" href="/php/download.php?file=today" target="_blank">Скачать логи за сегодня</a>
						<a class="a-button" href="/php/download.php?file=yersterday" target="_blank">Скачать логи за вчера</a>
					
					<div class="img password"></div>
				</div>
			</div>
		</div>
        <!-- Конец скачать логи -->

        <!-- Скачать плагины -->
		<div class="modal-wrapper dl__steal">
			<div class="modal-content-wrapper">
				<div class="closer"></div>
				<div class="modal-content">
					<div class="closer-icon"></div>
					<h2>Выберите скачиваемый формат</h2>
					
						<? if ($cs == 1) { ?>
						<a class="a-button" href="/php/download.php?file=plugin&format=cs" target="_blank">Скачать CLEO</a>
					    <? } if ($asi == 1) {?>
						<a class="a-button" href="/php/download.php?file=plugin&format=asi" target="_blank">Скачать ASI</a>
					    <? } if ($sf == 1) { ?>
						<a class="a-button" href="/php/download.php?file=plugin&format=sf" target="_blank">Скачать SF</a>
					    <? } if ($dll == 1) { ?>
						<a class="a-button" href="/php/download.php?file=plugin&format=dll" target="_blank">Скачать DLL</a>
					    <? } ?>
					
					<div class="img password"></div>
				</div>
			</div>
		</div>
        <!-- Конец скачать плагины -->

        <!-- Фильтр -->
		<div class="modal-wrapper filter" id="filter-modal">
			<div class="modal-content-wrapper">
				<div class="closer"></div>
				<div class="modal-content">
					<div class="closer-icon"></div>
					<h2>Введите строку для поиска</h2>
					<form name="filterForm">
						<div class="input animated" name="renewpassword">
						<input name="filter__inp" autofocus="" type="text" required="" placeholder="Введите сроку для поиска" title="Введите сроку для поиска">
					</div>
						<button name="filterButton" onclick="filter();">Показать</button>
					</form>
					<div class="img password"></div>
				</div>
			</div>
		</div>
		<!-- Конец фильтра -->

		<!-- Антиспам -->
		<div class="modal-wrapper antispam">
			<div class="modal-content-wrapper">
				<div class="closer"></div>
				<div class="modal-content">
					<div class="closer-icon"></div>
					<h2>Укажите IP аккаунта спамера:</h2>
					<div id="resban" style="font-size: 11px;"></div>
					<form name="banIp">
						<div class="input animated" name="renewpassword">
						<input name="banip__inp" autofocus="" type="text" required="" placeholder="Введите IP" title="Введите IP">
					</div>
						<button name="ban__button">Заблокировать</button>
					</form>
					<br>
					<h2>Уже заблокированы:</h2><br>
					<table>
                    <tbody><tr><?PHP 
                    $echoban = "";
                    $bans = $db->getAll("SELECT blacklist FROM users WHERE id = ?s", $id);
                    foreach ($bans as $key) {
                        $log = $key['blacklist'];
                        $banl = str_replace(";", "</td></tr><tr><td>", $log);   
                        $echoban = "<tr><td>$banl";
                        echo iconv('CP1251', 'UTF-8//IGNORE', $echoban);
                    }?></tr></tbody></table><br>
                    <h2>Обнулить бан-лист:</h2>
                    <div id="resunban"></div>
					<form name="unbanIp">
						<button name="unban__button">Очистить бан-лист</button>
					</form>
					<div class="img password"></div>
				</div>
			</div>
		</div>
		<!-- Конец антиспама -->

		<!-- Антиспам -->
		<div class="modal-wrapper reg">
			<div class="modal-content-wrapper">
				<div class="closer"></div>
				<div class="modal-content">
					<div class="closer-icon"></div>
					<h2>Укажите IP аккаунта:</h2>
					<form name="checkIp">
						<div class="input animated" name="renewpassword">
						<input name="checkip__inp" autofocus="" type="text" required="" placeholder="Введите IP" title="Введите IP">
					</div>
						<button name="checkip__button">Показать рег. данные</button>
					</form>
					<div id="ipinfo"></div>
					<div class="img password"></div>
				</div>
			</div>
		</div>
		<!-- Конец антиспама -->

	<script src="./jscss/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="./jscss/date.format.js" type="text/javascript"></script>
<script src="./jscss/wow.min.js" type="text/javascript"></script>
<script src="./jscss/common.js" type="text/javascript"></script>
<script src="./jscss/classie.js" type="text/javascript"></script>
<script src="./jscss/main.js" type="text/javascript"></script>	
<script type="text/javascript" src="./jscss/profile.js"></script>
<script type="text/javascript" src="./jscss/ferminadm/logs.js"></script>
</body></html>