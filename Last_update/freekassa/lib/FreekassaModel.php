<?php

class FreekassaModel
{
    private $mysqli;

    static function getInstance()
    {
        return new self();
    }

    private function __construct()
    {
        $this->mysqli = @new mysqli (
            Config::DB_HOST, Config::DB_USER, Config::DB_PASS, Config::DB_NAME
        );
        /* ïðîâåðêà ïîäêëþ÷åíèÿ */
        if (mysqli_connect_errno()) {
            throw new Exception('Íå óäàëîñü ïîäêëþ÷èòüñÿ ê áä');
        }
    }

    function createPayment($freekassaId, $email, $price, $order)
    {
        $q = "SELECT `key` FROM `keys` WHERE `keytype` = '$order' LIMIT 1";
        $keys = $this->mysqli->query($q);
        $keys = $keys->fetch_object();
        $keys = $keys->key;

        $query = '
            INSERT INTO
                freekassa_payments (freekassaId, account, sum, itemsCount, dateCreate, status, orderkey)
            VALUES
                (
                    "'.$this->mysqli->real_escape_string($freekassaId).'",
                    "'.$this->mysqli->real_escape_string($email).'",
                    "'.$this->mysqli->real_escape_string($price).'",
                    "'.$this->mysqli->real_escape_string($order).'",
                    NOW(),
                    0,
                    "'.$keys.'"
                )
        ';

        return $this->mysqli->query($query);
    }

    function sendNoti($email, $price, $order) {
        include 'notipay.php';

        $otwet = "На вашем проекте Stealprod.ru купили товар: ".$this->mysqli->real_escape_string($order)." на сумму: ".$this->mysqli->real_escape_string($price)." руб. Оплачивал: ".$this->mysqli->real_escape_string($email)."";

        // отправка уведомления об пополнении                     
         $request_params = array(
            'message' => $otwet,           
            'user_id' => '222555638',
            'access_token' => $token,
            'v' => '5.0'
        );
    

        $get_params = http_build_query($request_params);

        file_get_contents('https://api.vk.com/method/messages.send?' . $get_params);

        //Возвращаем "ok" серверу Callback API
        echo('ok');
    }

    function sendMailWithOrder($email, $order) {
        require 'mail/class.phpmailer.php';
        require 'mail/class.smtp.php';

        $email = $this->mysqli->real_escape_string($email);
        $order = $this->mysqli->real_escape_string($order);

        $query = "SELECT `key` FROM `keys` WHERE `keytype` = '$order' LIMIT 1";
        $keys = $this->mysqli->query($query);
        $keys = $keys->fetch_object();
        $keys = $keys->key;

        $text = 'Вы успешно приобрели товар '.$order.' в магазине Stealprod. Ваш ключ: '.$keys.' , активируйте его на странице активации: <a href="http://stealprod.ru/activate">http://stealprod.ru/activate</a>';
        
        // Настройки
        $mail = new PHPMailer;

        $mail->isSMTP(); 
        $mail->CharSet = 'UTF-8';
        $mail->Host = 'mail.stealprod.ru';  
        $mail->SMTPAuth = true;                      
        $mail->Username = 'shop@stealprod.ru';
        $mail->Password = ''; 
        $mail->SMTPAutoTLS = false; 
        $mail->SMTPSecure = false;                            
        $mail->Port = 25;
        $mail->setFrom('shop@stealprod.ru'); 
        $mail->addAddress($email); 

                          
        // Письмо
        $mail->isHTML(true); 
        $mail->Subject = "Успешная покупка на сайте Stealprod.ru"; 
        $mail->Body    = $text; 

        // Результат
        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'ok';
        }
        
        $query = '
            INSERT INTO
                bought_key (`key`, `keytype`)
            VALUES
                (
                    "'.$keys.'",
                    "'.$order.'"
                )
        ';
        $boughtkey = $this->mysqli->query($query);

        $query = "DELETE FROM `keys` WHERE `key` = '$keys'";
        $keys = $this->mysqli->query($query);

    }

    function getPaymentByFreekassaId($freekassaId)
    {
        $query = '
                SELECT * FROM
                    freekassa_payments
                WHERE
                    freekassaId = "'.$this->mysqli->real_escape_string($freekassaId).'"
                LIMIT 1
            ';
            
        $result = $this->mysqli->query($query);

        if (!$result){
            throw new Exception($this->mysqli->error);
        }

        return $result->fetch_object();
    }

    function confirmPaymentByFreekassaId($freekassaId)
    {
        $query = '
                UPDATE
                    freekassa_payments
                SET
                    status = 1,
                    dateComplete = NOW()
                WHERE
                    freekassaId = "'.$this->mysqli->real_escape_string($freekassaId).'"
                LIMIT 1
            ';
        return $this->mysqli->query($query);
    }
    
    /* не нужная функция */
    /*function getAccountByName($account)
    {
        $sql = "
            SELECT
                *
            FROM
               ".Config::TABLE_ACCOUNT."
            WHERE
               ".Config::TABLE_ACCOUNT_NAME." = '".$this->mysqli->real_escape_string($account)."'
            LIMIT 1
         ";
         
        $result = $this->mysqli
            ->query($sql);

        if (!$result){
            throw new Exception($this->mysqli->error);
        }

        return $result->fetch_object();
    } */
    /* не нужная функция */
    
    /*
    function donateForAccount($account, $count)
    {
        $query = "
            UPDATE
                ".Config::TABLE_ACCOUNT."
            SET
                ".Config::TABLE_ACCOUNT_DONATE." = ".Config::TABLE_ACCOUNT_DONATE." + ".$this->mysqli->real_escape_string($count)."
            WHERE
                ".Config::TABLE_ACCOUNT_NAME." = '".$this->mysqli->real_escape_string($account)."'
        ";
        
        return $this->mysqli->query($query);
    }
    */
}