<?php 
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
session_start();
include 'safemysql.php';
$db = new SafeMySQL(); 

$id = $_SESSION['login']; 
$balance = $_SESSION['balance'];
$pricechangepassword = 50;

// banlist
if (isset($_GET['banip__inp']))
    {
        $ip = $_GET['banip__inp'];
        $blacklist = $db->getRow("SELECT blacklist FROM users WHERE id = ?s", $id);
        if($blacklist['blacklist'] == '') 
            {
                $db->query("UPDATE users SET blacklist = ?s WHERE id = ?s", $ip, $id);
                $db->query("UPDATE users SET bans=bans + 1 WHERE id = ?s", $id);

                $result = "IP адрес ".$ip." успешно добавлен в черный список!";
                
            } 
            else
            {
                $add = $blacklist['blacklist'].';'.$ip;
                $db->query("UPDATE users SET blacklist = ?s WHERE id = ?s", $add, $id);
                $db->query("UPDATE users SET bans=bans + 1 WHERE id = ?s", $id);
                $result = "(IP адрес ".$ip." успешно добавлен в черный список!)";
            }
            if (!empty($result)) { echo $result; }
    } 
        
    
    if (isset($_GET['unbanip__inp']))
    {
        $blacklist = $db->getRow("SELECT blacklist FROM users WHERE id = ?s", $id);
        if($blacklist['blacklist'] == '') 
        {
            $result = "[Ошибка] Банлист пуст!";
        }
        else 
        {
        $newlist = "";
        $db->query("UPDATE users SET blacklist = ?s WHERE id = ?s", $newlist, $id);
        $db->query("UPDATE users SET bans=0 WHERE id = ?s", $id);
        $result = "Банлист успешно обнулён!";
        } 
        if (!empty($result)) { echo $result; }
    }

    if (isset($_GET['setrepeat']) && isset($_GET['setDid']) && isset($_GET['setTServ'])) {

        if($_GET['setrepeat'] == 1) {
            $db->query("UPDATE users SET repeatoff=1 WHERE id = ?s", $id);
            echo "Удаление повторов включено. ";
        }
        else {
            $db->query("UPDATE users SET repeatoff=0 WHERE id = ?s", $id);
            echo "Удаление повторов отключено. ";
        }

        if($_GET['setDid'] == 1) {
            $db->query("UPDATE users SET topdid=1 WHERE id = ?s", $id);
            echo "Режим только полезных диалогов. ";
        }
        else {
            $db->query("UPDATE users SET topdid=0 WHERE id = ?s", $id);
            echo "Режим всех диалогов. ";
        }

        if($_GET['setTServ'] == 1) {
            $db->query("UPDATE users SET topserv=1 WHERE id = ?s", $id);
            echo "Нубо-рп скрыты. ";
        }
        else {
            $db->query("UPDATE users SET topserv=0 WHERE id = ?s", $id);
            echo "Показываются все сервера. ";
        }
    }

    if(isset($_GET['oldpassword']) && isset($_GET['newpassword']) && isset($_GET['repeatnewpassword'])) {
        $oldpassword = $_GET['oldpassword'];
        $newpassword = $_GET['newpassword'];
        $repeatnewpassword = $_GET['repeatnewpassword'];
        if($balance>=$pricechangepassword) {
            $curpass = $db->getOne("SELECT `password` FROM `users` WHERE `id` = '$id'");
            if(md5($oldpassword) == $curpass) {
                if($newpassword == $repeatnewpassword) {
                    $balance = $balance-50;
                    $newpassword = md5($newpassword);
                    $datelog = date("d.m.Y");
                    $db->query("UPDATE `users` SET balance=?s WHERE id=?i",$balance,$id);
                    $db->query("UPDATE `users` SET password=?s WHERE id=?i",$newpassword,$id);
                    $db->query("INSERT INTO `notification`(`id`,`category`,`text`,`status`,`date`) VALUES ('$id','pass','Вы изменили пароль','yes','$datelog')");
                    $result = "Пароль успешно изменен.";
                }
                else {
                    $result = "Повторно введенный пароль указан неверно!";
                } 
            }
            else {
                $result = "Старый пароль указан неверно!";
            }
        }
        else {
            $result = "На балансе не достаточно средств!";
        }
        echo $result;
    }
    

    if(isset($_GET['nickname'])) {
        $datelog = date("d.m.Y");
        $nickname = $_GET['nickname'];
        $db->query("SET NAMES 'utf8'");
        $db->query("UPDATE `users` SET `nickname`=?s WHERE `id`='$id'", $nickname);
        $db->query("INSERT INTO `notification`(`id`,`category`,`text`,`status`,`date`) VALUES ('$id','nick','Вы изменили никнейм','no','$datelog')");
        $result = "Никнейм успешно изменен.";
        echo $result;
    }

    if(isset($_GET['vkout'])) {
        $datelog = date("d.m.Y");
        $akeys = $db->getOne("SELECT `akey` FROM `users` WHERE `id` = '$id'");
        $db->query("UPDATE `users` SET `vkkeys`=?s WHERE `id`='$id'", $akeys);
        $db->query("UPDATE `users` SET `akey`=' '  WHERE `id`='$id'");
        $db->query("INSERT INTO `notification`(`id`,`category`,`text`,`status`,`date`) VALUES ('$id','vk','Вы отвязали вк','no','$datelog')");
        $result = "Панель управления успешно отвязана от вк.";
        echo $result;
    }
    

 ?>