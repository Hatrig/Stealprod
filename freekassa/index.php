<?php

error_reporting(E_ALL);

include 'config.php';
include 'lib/FreekassaModel.php';
include 'lib/Freekassa.php';

class FreekassaEvent
{
    /* Функция проверки существования аккаунта на который идет донат (не нужна она)
    public function check($params)
    {
        try {
            $freekassaModel = FreekassaModel::getInstance();

            if ($freekassaModel->getAccountByName($params['us_account'])) {
                return true;
            }
            return 'Character not found';
        } catch(Exception $e) {
            return $e->getMessage();
        }
    } */

    public function pay($params)
    {
         $freekassaModel = FreekassaModel::getInstance();
         $freekassaModel->sendNoti($params['us_email'], $params['AMOUNT'], $params['us_order']);
         $freekassaModel->sendMailWithOrder($params['us_email'], $params['us_order']);
         //$countItems = floor($params['AMOUNT']);
         //$freekassaModel->donateForAccount($params['us_account'], $countItems);
    }
}

$payment = new Freekassa (
    new FreekassaEvent()
);

echo $payment->getResult();
