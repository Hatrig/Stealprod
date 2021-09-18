<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

// файл с константами для подключения к бд
require_once('safemysql.php'); 
require_once('vkbotstealprod.php');
$db = new safemysql();
    
if(isset($_POST['login__inp']) && isset($_POST['password__inp']) && isset($_POST['g-recaptcha-response']))
{
    $captcha=$_POST['g-recaptcha-response'];
    if(!$captcha) 
    {
       $error = "Ошибка ввода Google reCaptcha";
    }
    else {
            $ip = $_SERVER['REMOTE_ADDR'];
            $user_ip = (isset($_SERVER["HTTP_CF_CONNECTING_IP"])?$_SERVER["HTTP_CF_CONNECTING_IP"]:$_SERVER['REMOTE_ADDR']);
            $secretKey = ""; 
            $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
            $responseKeys = json_decode($response,true); 
            if($responseKeys['success']) 
            {   
    // запрос на получение хэша пароля из таблицы
    $id = htmlspecialchars($_POST['login__inp']);
    $sql = "SELECT `password` FROM `users` WHERE `id`=?s";
    $pass = $db->getOne($sql, $id);
    
    if($pass) {
    // сравнение с введенным юзером паролем
    if ($pass == md5($_POST['password__inp']))
    {
        session_start();
    	$_SESSION['login'] = $id;
        $sql = "SELECT `akey` FROM `users` WHERE `id`=?s";
        $vk = $db->getOne($sql, $id);
        if (!empty($vk)) {
            $request_params = array(
            'message' => "$nickname (id: $id), успешно авторизовались в ПУ STEALPROD с IP адресса: $user_ip!",           
            'user_id' => $idvk,
            'access_token' => $token,
            'v' => '5.0'
             );
             $get_params = http_build_query($request_params);
             file_get_contents('https://api.vk.com/method/messages.send?' . $get_params);
             //Возвращаем "ok" серверу Callback API
             echo('ok');
        }
        echo 'Авторизация прошла успешно';
    }
    else {
    	echo 'Пароль введен не верно';
    }
}
else {
	echo 'Указанный ID базы не найден';
}
}
else {
    echo "Ошибка ввода Google reCaptcha";
}
}
}	

?>