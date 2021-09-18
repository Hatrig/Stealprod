<?
include './php/safemysql.php';
$db = new SafeMySQL();

if(!empty($_REQUEST['intid'])) {
$number_transaction = $_REQUEST['intid'];
$query = "SELECT `orderkey` FROM `freekassa_payments` WHERE `freekassaId` = ?s";
$key = $db->getOne($query, $number_transaction);
if (!empty($key)) {
	$key = $key;
}
else {
	echo '<script>window.location="index";</script>';
}
}
else {
	echo '<script>window.location="index";</script>';
}
?>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Stealprod - панель управления для добычи аккаунтов SA:MP, с помощью плагинов форматов - CLEO/ASI/SF/DLL. Наши плагины чистые для AVP GameProtect, обходят Antistealer от Darkpixel, а также регулярно обновляются.">
	<meta name="keywords" content="Стиллер для самп, sampsteal, samp steal, стиллер чистый для avp, avp game protect, avp, darkpixel, antistealer, blasthack, cheat-master, samp-store, stealprod, панель управления, купить самп стиллер, купить стиллер самп, самп стиллер, стиллер самп, стиллер самп чистый для avp, стиллер самп с обходом даркпикселя, обход антистиллера от darkpixel, лучший самп стиллер">
	<link rel="stylesheet" href="./jscss/font-awesome.min.css">
	<link rel="stylesheet" href="./jscss/animate.css">
	<link rel="stylesheet" href="./jscss/reset.css">
	<link rel="stylesheet" href="./jscss/style.css">
	
</head>
<body><div class="loader"></div>
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
				<a href=""><li name="" class="active">Главная</li></a>
				<a href="/shop"><li name="shop">Магазин</li></a>
				<a href="https://vk.me/stlprd" target="_blank"><li name="help">Группа Вконтакте</li></a>
				 
				<a href="/login"><li name="login">Вход</li></a>
				<a href="/shop"><li name="register">Купить доступ</li></a>
											</ul>
		</div>
	</div>
</div>
<div class="header">
	<div class="header-content">
		<ul class="menu">
			<a href=""><li name="" class="active">Главная</li></a>
			<a href="/shop">
				<li name="shop">Магазин</li>
							</a>
			<a href="https://vk.me/stlprd" target="_blank"><li name="help">Группа Вконтакте</li></a>
		</ul>
				<div class="control one">
			<a href="/shop"><button class="register active"><div class="icon"></div><p>Купить доступ</p></button></a>
			<a href="/login"><button class="log-in"><div class="icon"></div><p>Вход</p></button></a>
		</div>
					</div>
</div>
	<title>Stealprod - Начни свой путь самп продавца с нами!</title>
	<link rel="stylesheet" href="./jscss/successPayment.css">
	
		<div class="block successPayment">
			<div class="content">
				<h2><div class="icon"></div>УСПЕШНАЯ ОПЛАТА</h2>
                <h3>Благодарим Вас за покупку ключа активации</h3>
				
                        <div class="product-info">
                            
                            <h3>Ваш ключ:</h3>
                            <h2><? echo $key ?></h2>
                        </div>
                                    <div class="under">
                    <p>Оплата заказа <? echo $number_transaction ?> (платеж <? echo $number_transaction ?>) прошла успешно<br>Также ваш ключ и инструкция к нему были отправлены на ваш e-mail, указанный перед покупкой.</p>
                    <div class="buttons">
                        <a name="activate" href="/activate"><button><div class="icon"></div>Активировать ключ</button></a>
                        
                    </div>
                </div>
			</div>
			<div class="footer">
	<div class="links">
		<a href="https://vk.com/stlprd" target="_blank"><div class="icon vk"></div></a>
		<a href=""><div class="icon help"></div></a>
		<a href="mailto:admin@stealprod.ru"><div class="icon mail"></div></a>
		<!-- <a href='https://status.malinovka.org' target='_blank'><div class='icon status'></div></a> -->
	</div>
	<h4>USEC</h4>
	<h3>STEALPROD © 2018-2021</h3>
	<h4><a href="//showstreams.tv/"><img src="//www.free-kassa.ru/img/fk_btn/16.png" title="Бесплатный видеохостинг"></a></h4>
	<h3>При поддержке <a href="https://t.me/alligator9728">barspinOff</a></h3>
	<div class="age"></div>
</div>
		</div>
	
	<script src="./jscss/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="./jscss/date.format.js" type="text/javascript"></script>
<script src="./jscss/wow.min.js" type="text/javascript"></script>
<script src="./jscss/common.js" type="text/javascript"></script>
<script src="./jscss/classie.js" type="text/javascript"></script>
<script src="./jscss/main.js" type="text/javascript"></script>
</body></html>