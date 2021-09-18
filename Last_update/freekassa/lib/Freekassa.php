<?php

class Freekassa
{
    private $event;

    public function __construct(FreekassaEvent $event)
    {
        $this->event = $event;
    }

    public function getResult()
    {
        $request = $_REQUEST;
        
        if (!empty($request['email']) AND !empty($request['price']) AND !empty($request['order']) AND $request['action'] == 'fk_go') {
            if ($request['order'] == 'cleo' AND $request['price'] == '70') {
            return $this->GoTofreekassa($request);
            }
            if ($request['order'] == 'asi' AND $request['price'] == '80') {
            return $this->GoTofreekassa($request);
            }
            if ($request['order'] == 'sf' AND $request['price'] == '70') {
            return $this->GoTofreekassa($request);
            }
            if ($request['order'] == 'dll' AND $request['price'] == '80') {
            return $this->GoTofreekassa($request);
            }
            if ($request['order'] == 'csasi' AND $request['price'] == '150') {
            return $this->GoTofreekassa($request);
            }
            if ($request['order'] == 'all' AND $request['price'] == '300') {
            return $this->GoTofreekassa($request);
            }
            if ($request['order'] == 'lua' AND $request['price'] == '100') {
            return $this->GoTofreekassa($request);
            }
        } 

        if (empty($request['MERCHANT_ID'])
            || empty($request['us_email'])
            || empty($request['SIGN'])
            || empty($request['AMOUNT'])
            || empty($request['intid'])
        )
        {
            return $this->getResponseError('Invalid request');
        }

        if ($request['SIGN'] != md5(Config::MERCHANT_ID.':'.$request['AMOUNT'].':'.Config::SECRET_KEY_2.':'.$request['MERCHANT_ORDER_ID']))        
        {
            return $this->getResponseError('Incorrect digital signature');
        }

        $freekassaModel = FreekassaModel::getInstance();
        
        if ($freekassaModel->getPaymentByFreekassaId($request['intid']))
        {
            // Ïëàòåæ óæå ñóùåñòâóåò
            return $this->getResponseSuccess('Payment already exists');
        }
       
        if (!$freekassaModel->createPayment(
            $request['intid'],
            $request['us_email'],
            $request['AMOUNT'],
            $request['us_order']
        ))
        {
            return $this->getResponseError('Unable to create payment database');
        }
        
        /* проверка аккаунта на существование, не надо 
        $checkResult = $this->event->check($request);
        if ($checkResult !== true)
        {
            return $this->getResponseError($checkResult);
        } */
        
        $payment = $freekassaModel->getPaymentByFreekassaId($request['intid']);
        
        if ($payment && $payment->status == 1)
        {
            return $this->getResponseSuccess('Payment has already been paid');
        }

        if (!$freekassaModel->confirmPaymentByFreekassaId($request['intid']))
        {
            return $this->getResponseError('Unable to confirm payment database');
        }

        $this->event->pay($request);

        return $this->getResponseSuccess('YES');
    }
    
    private function GoTofreekassa($request)
    {
        $m = Config::MERCHANT_ID;
        $oa = $request['price'];
        $o = $request['desc'];
        $us_email = $request['email'];
        $us_order = $request['order'];
        $s = md5(implode(':', array($m, $oa, Config::SECRET_KEY_1, $o)));

        header("Location: //www.free-kassa.ru/merchant/cash.php?m={$m}&oa={$oa}&o={$o}&s={$s}&us_email={$us_email}&us_order={$us_order}");
        return;
    }

    private function getResponseSuccess($message)
    {
        return $message;
    }

    private function getResponseError($message)
    {
        return $message;
    }
}
