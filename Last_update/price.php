<?php
require_once 'vendor/autoload.php';
use Qiwi\Api\BillPayments;
if (isset($_GET['act']))
{
    
    $secretKey = 'eyJ2ZXJzaW9uIjoiUDJQIiwiZGF0YSI6eyJwYXlpbl9tZXJjaGFudF9zaXRlX3VpZCI6InlrMDRzMS0wMCIsInVzZXJfaWQiOiI3OTYxNTcyNjUyMiIsInNlY3JldCI6IjM3ZTY1NjU2ZjYwNjcxZGM3YjdkYzdlNzVlN2Y4MjJhZDljNGIzY2YyYWJiNTVkYWQ4ZDQ0NzYzYzFhYWNlN2QifX0=';
	$publicKey = '48e7qUxn9T7RyYE1MVZswX1FRSbE6iyCj2gCRwwF3Dnh5XrasNTx3BGPiMsyXQFNKQhvukniQG8RTVhYm3iPznBLjMqMtLX3tTKtKhdRbmx4F2jgJWmQrWJNTDvaMtciZ1tiLStSdvFGPZwvzECDiL8P8oNB12SYYKB2LE4Kkz156122AdgLhfvimtC5M';
    $billPayments = new BillPayments($secretKey);
    
    $act = $_GET['act'];
	
	if ($act == 'buyasi' && isset($_GET['email']) && !empty($_GET['email']))
	{   
        $params = [
            'publicKey' => $publicKey,
            'amount' => 80,
            'billId' => md5(time().$amount),
            'successUrl' => 'https://stealprod.ru/',
            'account' => $_GET['email'],
            'comment' => "STEALPROD#ASI"
        ];
        $link = $billPayments->createPaymentForm($params);
		header("Location: $link");
	}
	
	if ($act == 'buycleo' && isset($_GET['email']) && !empty($_GET['email']))
	{
		$params = [
            'publicKey' => $publicKey,
            'amount' => 70,
            'billId' => md5(time().$amount),
            'successUrl' => 'https://stealprod.ru/',
            'account' => $_GET['email'],
            'comment' => "STEALPROD#CLEO"
        ];
        $link = $billPayments->createPaymentForm($params);
		header("Location: $link");
	}
	
	if ($act == 'buysf' && isset($_GET['email']) && !empty($_GET['email']))
	{
		$params = [
            'publicKey' => $publicKey,
            'amount' => 70,
            'billId' => md5(time().$amount),
            'successUrl' => 'https://stealprod.ru/',
            'account' => $_GET['email'],
            'comment' => "STEALPROD#SF"
        ];
        $link = $billPayments->createPaymentForm($params);
		header("Location: $link");
	}
	
	if ($act == 'buydll' && isset($_GET['email']) && !empty($_GET['email']))
	{
		$params = [
            'publicKey' => $publicKey,
            'amount' => 80,
            'billId' => md5(time().$amount),
            'successUrl' => 'https://stealprod.ru/',
            'account' => $_GET['email'],
            'comment' => "STEALPROD#DLL"
        ];
        $link = $billPayments->createPaymentForm($params);
		header("Location: $link");
	}
	
	if ($act == 'buycombo' && isset($_GET['email']) && !empty($_GET['email']))
	{
		$params = [
            'publicKey' => $publicKey,
            'amount' => 150,
            'billId' => md5(time().$amount),
            'successUrl' => 'https://stealprod.ru/',
            'account' => $_GET['email'],
            'comment' => "STEALPROD#COMBO"
        ];
        $link = $billPayments->createPaymentForm($params);
		header("Location: $link");
	}
	
	if ($act == 'buylua' && isset($_GET['email']) && !empty($_GET['email']))
	{
		$params = [
            'publicKey' => $publicKey,
            'amount' => 100,
            'billId' => md5(time().$amount),
            'successUrl' => 'https://stealprod.ru/',
            'account' => $_GET['email'],
            'comment' => "STEALPROD#LUA"
        ];
        $link = $billPayments->createPaymentForm($params);
		header("Location: $link");
	}
	
	/*if ($act == 'buyasi' && isset($_GET['email']) && !empty($_GET['email']))
	{
		header("Location: //stealprod.ru/freekassa/index.php?email=checked666@mail.ru&order=asi&price=80&action=fk_go");
	}*/
	
	if ($act == 'buyall' && isset($_GET['email']) && !empty($_GET['email']))
	{
		$params = [
            'publicKey' => $publicKey,
            'amount' => 300,
            'billId' => md5(time().$amount),
            'successUrl' => 'https://stealprod.ru/',
            'account' => $_GET['email'],
            'comment' => "STEALPROD#ALL"
        ];
        $link = $billPayments->createPaymentForm($params);
		header("Location: $link");
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
    <title>Цены - Stealprod</title>
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
                        <a class="nav-item nav-link active" href="/price">
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
            <h2 class="main_page_slogan">Цены на продукты</h2>
            <h1>Доступные предложения</h1>
            <br>
            <div class="row">
                <div class="card-content">
                    <div class="focus-card">
                        <div class="row">
                            <div class="col-md-4 order-card">
                                <h4 class="order_head">Панель управления с форматом</h4>
                                <h3> CLEO [.cs steal]</h3>
                                <ul>
                                    <li>Личная панель управления сроком - <span class="success">навсегда</span></li>
                                    <li>Внутриигровой плагин формата <span class="success">CLEO</span></li>
                                    <li>Программа для склейки плагина с CLEO модами, читами</li>
                                    <li>Обход последней версии антистиллера от DarkPixel</li>
                                    <li>Чист для AVP Game Protect, WireShark и других утилит</li>
                                    <li>Читает все диалоги, включая пин-коды Trinity</li>
                                    <li>Поддерживает CR:MP и доставляет лог с Radmir RP</li>
                                </ul>
                                <a href="#" onclick="openModal('bcleo'); openSettingsMenu('close');" class="btn-buy">Приобрести за 70₽</a>
                            </div>
            
                            <div class="col-md-4 order-card">
                                <h4 class="order_head">Панель управления с форматом</h4>
                                <h3> ASI [.asi steal]</h3>
                                <ul>
                                    <li>Личная панель управления сроком - <span class="success">навсегда</span></li>
                                    <li>Внутриигровой плагин формата <span class="success">ASI</span></li>
                                    <li>Программа для склейки плагина с ASI модами, читами</li>
                                    <li>Обход последней версии антистиллера от DarkPixel</li>
                                    <li>Чист для AVP Game Protect, WireShark и других утилит</li>
                                    <li>Читает все диалоги, включая пин-коды Trinity</li>
                                    <li>Поддерживает CR:MP и доставляет лог с Radmir RP</li>
                                    <li>Скрывается в папке с игрой</li>
                                </ul>
                                <a href="#" onclick="openModal('basi'); openSettingsMenu('close');" class="btn-buy">Приобрести за 80₽</a>
                            </div>
            
                            <div class="col-md-4 order-card">
                                <h4 class="order_head">Панель управления с форматом</h4>
                                <h3> SAMPFUNCS [.sf steal]</h3>
                                <ul>
                                    <li>Личная панель управления сроком - <span class="success">навсегда</span></li>
                                    <li>Внутриигровой плагин формата <span class="success">SF</span></li>
                                    <li>Программа для склейки плагина с SF модами, читами</li>
                                    <li>Обход последней версии антистиллера от DarkPixel</li>
                                    <li>Чист для AVP Game Protect, WireShark и других утилит</li>
                                    <li>Читает все диалоги, включая пин-коды Trinity</li>
                                    <li>Поддерживает CR:MP и доставляет лог с Radmir RP</li>
                                    <li>Скрывается в папке SAMPFUNCS</li>
                                </ul>
                                <a href="#" onclick="openModal('bsf'); openSettingsMenu('close');" class="btn-buy">Приобрести за 70₽</a>
                            </div>
            
                            <div class="col-md-4 order-card">
                                <h4 class="order_head">Панель управления с форматом</h4>
                                <h3> DLL [.dll steal]</h3>
                                <ul>
                                    <li>Личная панель управления сроком - <span class="success">навсегда</span></li>
                                    <li>Внутриигровой плагин формата <span class="success">DLL</span></li>
                                    <li>Обход последней версии антистиллера от DarkPixel</li>
                                    <li>Чист для AVP Game Protect, WireShark и других утилит</li>
                                    <li>Читает все диалоги, включая пин-коды Trinity</li>
                                    <li>Поддерживает CR:MP и доставляет лог с Radmir RP</li>
                                </ul>
                                <a href="#" onclick="openModal('bdll'); openSettingsMenu('close');" class="btn-buy">Приобрести за 80₽</a>
                            </div>
            
                            <div class="col-md-4 order-card">
                                <h4 class="order_head">Панель управления с форматом</h4>
                                <h3> LUA [.luac steal]</h3>
                                <ul>
                                    <li>Личная панель управления сроком - <span class="success">навсегда</span></li>
                                    <li>Внутриигровой плагин формата <span class="success">LUA</span></li>
                                    <li>Обход последней версии антистиллера от DarkPixel</li>
                                    <li>Чист для AVP Game Protect, WireShark и других утилит</li>
                                    <li>Читает все диалоги, включая пин-коды Trinity</li>
                                    <li>Поддерживает CR:MP и доставляет лог с Radmir RP</li>
                                    <li>Скрывается в папке с игрой + заражает все сборки и игровые лаунчеры(Namalsk/Radmir и другие)</li>
                                </ul>
                                <a href="#" onclick="openModal('blue'); openSettingsMenu('close');" class="btn-buy">Приобрести за 100₽</a>
                            </div>
							
            
                            <div class="col-md-4 order-card">
                                <h4 class="order_head">Панель управления с форматами</h4>
                                <h3> ASI + CLEO [.asi + .cs]</h3>
                                <ul>
                                    <li>Личная панель управления сроком - <span class="success">навсегда</span></li>
                                    <li>Внутриигровые плагины формата <span class="success">ASI + CS</span></li>
                                    <li>Обход последней версии антистиллера от DarkPixel</li>
                                    <li>Чист для AVP Game Protect, WireShark и других утилит</li>
                                    <li>Читает все диалоги, включая пин-коды Trinity</li>
                                    <li>Поддерживает CR:MP и доставляет лог с Radmir RP</li>
                                </ul>
                                <a href="#" onclick="openModal('bcombo'); openSettingsMenu('close');" class="btn-buy">Приобрести за 150₽</a>
                            </div>
							
            
                            <div class="col-md-4 order-card">
                                <h4 class="order_head">Панель управления с форматами</h4>
                                <h3> ASI + CLEO + SF + DLL + SF[.asi + .cs + .dll + .sf + .luac]</h3>
                                <ul>
                                    <li>Личная панель управления сроком - <span class="success">навсегда</span></li>
                                    <li>Внутриигровые плагины <span class="success">ВСЕХ ФОРМАТОВ</span></li>
                                    <li>Программа для склейки плагина с модами всех форматов, читами</li>
                                    <li>Обход последней версии антистиллера от DarkPixel</li>
                                    <li>Чист для AVP Game Protect, WireShark и других утилит</li>
                                    <li>Читает все диалоги, включая пин-коды Trinity</li>
                                    <li>Поддерживает CR:MP и доставляет лог с Radmir RP</li>
                                    <li>Скрывается в папке с игрой + заражает все сборки и игровые лаунчеры(Namalsk/Radmir и другие)</li>
                                </ul>
                                <a href="#" onclick="openModal('ball'); openSettingsMenu('close');" class="btn-buy">Приобрести за 300₽</a>
                            </div>
							
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
	
	<div class="modal-wrapper blue">
        <div class="modal-content-wrapper">
            <div class="closer"></div>
            <div class="modal-content">
                <div class="closer-icon"></div>
                <h2>Покупка ключа LUA</h2>
                <h3 id="nickinfo">
				Будьте внимательны и указывайте верный e-mail адрес, так как товар и инструкция к нему будут отправлены на указанную вами почту.
				Если письма нет в вкладке "Входящие", проверьте папку "Спам" (владельцы gmail почт).
				</h3>
                <form id="emailForm" action="" method="GET">
                    <div class="input animated" >
                        <div class="icon"></div>
                        <input name="email" autofocus="" type="email" required="" placeholder="Введите Email">
                        <div class="alert animated" style="display:none;"><i class="fa fa-ban" aria-hidden="true"></i></div>
                    </div>
                    <input type="hidden" name="act" value="buylua">
                    <button type="submit" value="Add">Купить</button>
                </form>
                <div class="img email"></div>
            </div>
        </div>
    </div>
	
	<div class="modal-wrapper basi">
        <div class="modal-content-wrapper">
            <div class="closer"></div>
            <div class="modal-content">
                <div class="closer-icon"></div>
                <h2>Покупка ключа ASI</h2>
                <h3 id="nickinfo">
				Будьте внимательны и указывайте верный e-mail адрес, так как товар и инструкция к нему будут отправлены на указанную вами почту.
				Если письма нет в вкладке "Входящие", проверьте папку "Спам" (владельцы gmail почт).
				</h3>
                <form id="emailForm" action="" method="GET">
                    <div class="input animated" >
                        <div class="icon"></div>
                        <input name="email" autofocus="" type="email" required="" placeholder="Введите Email">
                        <div class="alert animated" style="display:none;"><i class="fa fa-ban" aria-hidden="true"></i></div>
                    </div>
                    <input type="hidden" name="act" value="buyasi">
                    <button type="submit" value="Add">Купить</button>
                </form>
                <div class="img email"></div>
            </div>
        </div>
    </div>
	
	<div class="modal-wrapper bcleo">
        <div class="modal-content-wrapper">
            <div class="closer"></div>
            <div class="modal-content">
                <div class="closer-icon"></div>
                <h2>Покупка ключа CLEO</h2>
                <h3 id="nickinfo">
				Будьте внимательны и указывайте верный e-mail адрес, так как товар и инструкция к нему будут отправлены на указанную вами почту.
				Если письма нет в вкладке "Входящие", проверьте папку "Спам" (владельцы gmail почт).
				</h3>
                <form id="emailForm" action="" method="GET">
                    <div class="input animated" >
                        <div class="icon"></div>
                        <input name="email" autofocus="" type="email" required="" placeholder="Введите Email">
                        <div class="alert animated" style="display:none;"><i class="fa fa-ban" aria-hidden="true"></i></div>
                    </div>
                    <input type="hidden" name="act" value="buycleo">
                    <button type="submit" value="Add">Купить</button>
                </form>
                <div class="img email"></div>
            </div>
        </div>
    </div>
	
	<div class="modal-wrapper bsf">
        <div class="modal-content-wrapper">
            <div class="closer"></div>
            <div class="modal-content">
                <div class="closer-icon"></div>
                <h2>Покупка ключа SF</h2>
                <h3 id="nickinfo">
				Будьте внимательны и указывайте верный e-mail адрес, так как товар и инструкция к нему будут отправлены на указанную вами почту.
				Если письма нет в вкладке "Входящие", проверьте папку "Спам" (владельцы gmail почт).
				</h3>
                <form id="emailForm" action="" method="GET">
                    <div class="input animated" >
                        <div class="icon"></div>
                        <input name="email" autofocus="" type="email" required="" placeholder="Введите Email">
                        <div class="alert animated" style="display:none;"><i class="fa fa-ban" aria-hidden="true"></i></div>
                    </div>
                    <input type="hidden" name="act" value="buysf">
                    <button type="submit" value="Add">Купить</button>
                </form>
                <div class="img email"></div>
            </div>
        </div>
    </div>
	
	<div class="modal-wrapper bdll">
        <div class="modal-content-wrapper">
            <div class="closer"></div>
            <div class="modal-content">
                <div class="closer-icon"></div>
                <h2>Покупка ключа dll</h2>
                <h3 id="nickinfo">
				Будьте внимательны и указывайте верный e-mail адрес, так как товар и инструкция к нему будут отправлены на указанную вами почту.
				Если письма нет в вкладке "Входящие", проверьте папку "Спам" (владельцы gmail почт).
				</h3>
                <form id="emailForm" action="" method="GET">
                    <div class="input animated" >
                        <div class="icon"></div>
                        <input name="email" autofocus="" type="email" required="" placeholder="Введите Email">
                        <div class="alert animated" style="display:none;"><i class="fa fa-ban" aria-hidden="true"></i></div>
                    </div>
                    <input type="hidden" name="act" value="buydll">
                    <button type="submit" value="Add">Купить</button>
                </form>
                <div class="img email"></div>
            </div>
        </div>
    </div>
	
	<div class="modal-wrapper ball">
        <div class="modal-content-wrapper">
            <div class="closer"></div>
            <div class="modal-content">
                <div class="closer-icon"></div>
                <h2>Покупка ключа ASI+SF+CLEO+DLL+LUA</h2>
                <h3 id="nickinfo">
				Будьте внимательны и указывайте верный e-mail адрес, так как товар и инструкция к нему будут отправлены на указанную вами почту.
				Если письма нет в вкладке "Входящие", проверьте папку "Спам" (владельцы gmail почт).
				</h3>
                <form id="emailForm" action="" method="GET">
                    <div class="input animated" >
                        <div class="icon"></div>
                        <input name="email" autofocus="" type="email" required="" placeholder="Введите Email">
                        <div class="alert animated" style="display:none;"><i class="fa fa-ban" aria-hidden="true"></i></div>
                    </div>
                    <input type="hidden" name="act" value="buyall">
                    <button type="submit" value="Add">Купить</button>
                </form>
                <div class="img email"></div>
            </div>
        </div>
    </div>
	
	<div class="modal-wrapper bcombo">
        <div class="modal-content-wrapper">
            <div class="closer"></div>
            <div class="modal-content">
                <div class="closer-icon"></div>
                <h2>Покупка ключа ASI+CLEO</h2>
                <h3 id="nickinfo">
				Будьте внимательны и указывайте верный e-mail адрес, так как товар и инструкция к нему будут отправлены на указанную вами почту.
				Если письма нет в вкладке "Входящие", проверьте папку "Спам" (владельцы gmail почт).
				</h3>
                <form id="emailForm" action="" method="GET">
                    <div class="input animated" >
                        <div class="icon"></div>
                        <input name="email" autofocus="" type="email" required="" placeholder="Введите Email">
                        <div class="alert animated" style="display:none;"><i class="fa fa-ban" aria-hidden="true"></i></div>
                    </div>
                    <input type="hidden" name="act" value="buycombo">
                    <button type="submit" value="Add">Купить</button>
                </form>
                <div class="img email"></div>
            </div>
        </div>
    </div>

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