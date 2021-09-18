<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);


if (!isset($_REQUEST)) {
    return;
}

//Строка для подтверждения адреса сервера из настроек Callback API
$confirmationToken = '';

//Ключ доступа сообщества
$token = '';

// Secret key
$secretKey = 'Notipaystewat213wgt';

//Получаем и декодируем уведомление
$data = json_decode(file_get_contents('php://input'));

// проверяем secretKey
if(strcmp($data->secret, $secretKey) !== 0 && strcmp($data->type, 'confirmation') !== 0)
    return;

//Проверяем, что находится в поле "type"
switch ($data->type) {
    //Если это уведомление для подтверждения адреса сервера...
    case 'confirmation':
        //...отправляем строку для подтверждения адреса
        echo $confirmationToken;
        break;

    //Если это уведомление о новом сообщении...
    case 'message_new':
        //...получаем id его автора
        $userId = $data->object->user_id;
        //затем с помощью users.get получаем данные об авторе
        $userInfo = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids={$userId}&v=5.0"));

        //и извлекаем из ответа его имя
        $user_name = $userInfo->response[0]->first_name;

       // ответ на определенные сообщения
        $message = $data->object->body;
       if ($message == 'ЭЙ БЛЯ') {
        $request_params = array(
            'message' => 'ЧО НАДО СУУКАА',
            'user_id' => $userId,
            'access_token' => $token,
            'v' => '5.0'
        );

       

        $get_params = http_build_query($request_params);

        file_get_contents('https://api.vk.com/method/messages.send?' . $get_params);

        //Возвращаем "ok" серверу Callback API
        echo('ok');
       
}

        break;

   
}
?>