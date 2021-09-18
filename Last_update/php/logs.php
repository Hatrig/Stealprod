<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'safemysql.php';
$db = new SafeMySQL(); 

$id = $_SESSION['login'];   
$logcount = $_SESSION['logcount'];

$topserver = $_SESSION['topserv'];
$topdialogs = $_SESSION['topdid'];
$nonerepeat = $_SESSION['offrepeat'];

if (!isset($_SESSION['login'])) echo '<script> window.location="login"; </script>';             

// Главный блок вывода логов
    if (isset($_GET['page']) && !isset($_GET['filter__inp']))
    {
             $per_page=100;
             $page=$_GET['page']-1;
             $start=abs($page*$per_page);

             //система исключения забаненных строк
             $bans = $db->getOne("SELECT blacklist FROM users WHERE id = ?s", $id);
             if (!empty($bans))
             {
				 if (strpos($bans, ';') !== false)
				 {
					 $banlist = str_replace(";", "','", $bans);
					 $sqlstr = "SELECT * FROM `logs` WHERE `id` = '$id' AND `uip` NOT IN('$banlist') ORDER BY `logid` DESC LIMIT $start,$per_page";
					 $logcount = $db->getOne("SELECT COUNT(*) FROM `logs` WHERE `id` = '$id' AND `uip` NOT IN('$banlist') ORDER BY `logid` DESC");

					 // Система настройки логов
					 // Сет диалогов
					 if ($topdialogs == 1)
					 {
						 $sqlstr = "SELECT * from logs where `id` = '$id' AND `dialog` IN('1', '2', '3', '4', '5', '6', '7', '9', '10', '21', '90', '153', '86', '88', '17' '15', '991', '211', '0') AND `uip` NOT IN('$banlist') ORDER BY `logid` DESC LIMIT $start,$per_page";
						 $logcount = $db->getOne("SELECT COUNT(*) from logs where `id` = '$id' AND `dialog` IN('1', '2', '3', '4', '5', '6', '7', '9', '10', '21', '90', '153', '86', '88', '17' '15', '991', '211', '0') AND `uip` NOT IN('$banlist') ORDER BY `logid` DESC");
					 }

					 // Сет топ серверов
					 if ($topserver == 1)
					 {
						 $sqlstr = "SELECT * from logs where `id` = '$id' AND `server` LIKE '%Arizona%' AND `uip` NOT IN('$banlist') OR `id` = '$id' AND `server` LIKE '%Evolve%' AND `uip` NOT IN('$banlist') OR `id` = '$id' AND `server` LIKE '%Diamond%' AND `uip` NOT IN('$banlist') OR `id` = '$id' AND `server` LIKE '%Grand%' AND `uip` NOT IN('$banlist') OR `id` = '$id' AND `server` LIKE '%trinity%' AND `uip` NOT IN('$banlist') OR `id` = '$id' AND `server` LIKE '%Samp-Rp%' AND `uip` NOT IN('$banlist') OR `id` = '$id' AND `server` LIKE '%advance%' AND `uip` NOT IN('$banlist') ORDER BY `logid` DESC LIMIT $start,$per_page";
						 $logcount = $db->getOne("SELECT COUNT(*) from logs where `id` = '$id' AND `server` LIKE '%Arizona%' AND `uip` NOT IN('$banlist') OR `id` = '$id' AND `server` LIKE '%Evolve%' AND `uip` NOT IN('$banlist') OR `id` = '$id' AND `server` LIKE '%Diamond%' AND `uip` NOT IN('$banlist') OR `id` = '$id' AND `server` LIKE '%Grand%' AND `uip` NOT IN('$banlist') OR `id` = '$id' AND `server` LIKE '%trinity%' AND `uip` NOT IN('$banlist') OR `id` = '$id' AND `server` LIKE '%Samp-Rp%' AND `uip` NOT IN('$banlist') OR `id` = '$id' AND `server` LIKE '%advance%' AND `uip` NOT IN('$banlist') ORDER BY `logid` DESC");
					 }

					 // Если оба сета включены
					 if ($topdialogs == 1 && $topserver == 1)
					 {
						 $sqlstr = "SELECT * from logs where `id` = '$id' AND `server` LIKE '%Arizona%' AND `dialog` IN('1', '2', '3', '4', '5', '6', '7', '9', '10', '21', '90', '153', '86', '88', '17' '15', '991', '211', '0') AND `uip` NOT IN('$banlist') OR `id` = '$id' AND `server` LIKE '%Evolve%' AND `dialog` IN('1', '2', '3', '4', '5', '6', '7', '9', '10', '21', '90', '153', '86', '88', '17' '15', '991', '211', '0') AND `uip` NOT IN('$banlist') OR `id` = '$id' AND `server` LIKE '%Diamond%' AND `dialog` IN('1', '2', '3', '4', '5', '6', '7', '9', '10', '21', '90', '153', '86', '88', '17' '15', '991', '211', '0') AND `uip` NOT IN('$banlist') OR `id` = '$id' AND `server` LIKE '%Grand%' AND `dialog` IN('1', '2', '3', '4', '5', '6', '7', '9', '10', '21', '90', '153', '86', '88', '17' '15', '991', '211', '0') AND `uip` NOT IN('$banlist') OR `id` = '$id' AND `server` LIKE '%trinity%' AND `dialog` IN('1', '2', '3', '4', '5', '6', '7', '9', '10', '21', '90', '153', '86', '88', '17' '15', '991', '211', '0') AND `uip` NOT IN('$banlist') OR `id` = '$id' AND `server` LIKE '%Samp-Rp%' AND `dialog` IN('1', '2', '3', '4', '5', '6', '7', '9', '10', '21', '90', '153', '86', '88', '17' '15', '991', '211', '0') AND `uip` NOT IN('$banlist') OR `id` = '$id' AND `server` LIKE '%advance%' AND `dialog` IN('1', '2', '3', '4', '5', '6', '7', '9', '10', '21', '90', '153', '86', '88', '17' '15', '991', '211', '0') AND `uip` NOT IN('$banlist') ORDER BY `logid` DESC LIMIT $start,$per_page";
						 $logcount = $db->getOne("SELECT COUNT(*) from logs where `id` = '$id' AND `server` LIKE '%Arizona%' AND `dialog` IN('1', '2', '3', '4', '5', '6', '7', '9', '10', '21', '90', '153', '86', '88', '17' '15', '991', '211', '0') AND `uip` NOT IN('$banlist') OR `id` = '$id' AND `server` LIKE '%Evolve%' AND `dialog` IN('1', '2', '3', '4', '5', '6', '7', '9', '10', '21', '90', '153', '86', '88', '17' '15', '991', '211', '0') AND `uip` NOT IN('$banlist') OR `id` = '$id' AND `server` LIKE '%Diamond%' AND `dialog` IN('1', '2', '3', '4', '5', '6', '7', '9', '10', '21', '90', '153', '86', '88', '17' '15', '991', '211', '0') AND `uip` NOT IN('$banlist') OR `id` = '$id' AND `server` LIKE '%Grand%' AND `dialog` IN('1', '2', '3', '4', '5', '6', '7', '9', '10', '21', '90', '153', '86', '88', '17' '15', '991', '211', '0') AND `uip` NOT IN('$banlist') OR `id` = '$id' AND `server` LIKE '%trinity%' AND `dialog` IN('1', '2', '3', '4', '5', '6', '7', '9', '10', '21', '90', '153', '86', '88', '17' '15', '991', '211', '0') AND `uip` NOT IN('$banlist') OR `id` = '$id' AND `server` LIKE '%Samp-Rp%' AND `dialog` IN('1', '2', '3', '4', '5', '6', '7', '9', '10', '21', '90', '153', '86', '88', '17' '15', '991', '211', '0') AND `uip` NOT IN('$banlist') OR `id` = '$id' AND `server` LIKE '%advance%' AND `dialog` IN('1', '2', '3', '4', '5', '6', '7', '9', '10', '21', '90', '153', '86', '88', '17' '15', '991', '211', '0') AND `uip` NOT IN('$banlist') ORDER BY `logid` DESC");
					 }
					 // Конец системы настройки логов
				 }
                 else
                 {
                    $banlist = $bans;
                    $sqlstr = "SELECT * FROM `logs` WHERE `id` = '$id' AND `uip` != '$banlist' ORDER BY `logid` DESC LIMIT $start,$per_page";
                    $logcount = $db->getOne("SELECT COUNT(*) FROM `logs` WHERE `id` = '$id' AND `uip` != '$banlist' ORDER BY `logid` DESC");

                    // Система настройки логов
                    // Сет диалогов
                    if ($topdialogs == 1)
                    {
                        $sqlstr = "SELECT * from logs where `id` = '$id' AND `dialog` IN('1', '2', '3', '4', '5', '6', '7', '9', '10', '21', '90', '153', '86', '88', '17' '15', '991', '211', '0') AND `uip` != '$banlist' ORDER BY `logid` DESC LIMIT $start,$per_page";
                        $logcount = $db->getOne("SELECT COUNT(*) from logs where `id` = '$id' AND `dialog` IN('1', '2', '3', '4', '5', '6', '7', '9', '10', '21', '90', '153', '86', '88', '17' '15', '991', '211', '0') AND `uip` != '$banlist' ORDER BY `logid` DESC");
                    }

                    // Сет топ серверов
                    if ($topserver == 1)
                    {
                        $sqlstr  = "SELECT * from logs where `id` = '$id' AND `server` LIKE '%Arizona%' AND `uip` != '$banlist' OR `id` = '$id' AND `server` LIKE '%Evolve%' AND `uip` != '$banlist' OR `id` = '$id' AND `server` LIKE '%Diamond%' AND `uip` != '$banlist' OR `id` = '$id' AND `server` LIKE '%Grand%' AND `uip` != '$banlist' OR `id` = '$id' AND `server` LIKE '%trinity%' AND `uip` != '$banlist' OR `id` = '$id' AND `server` LIKE '%Samp-Rp%' AND `uip` != '$banlist' OR `id` = '$id' AND `server` LIKE '%advance%' AND `uip` != '$banlist' ORDER BY `logid` DESC LIMIT $start,$per_page";
                        $logcount = $db->getOne("SELECT COUNT(*) from logs where `id` = '$id' AND `server` LIKE '%Arizona%' AND `uip` != '$banlist' OR `id` = '$id' AND `server` LIKE '%Evolve%' AND `uip` != '$banlist' OR `id` = '$id' AND `server` LIKE '%Diamond%' AND `uip` != '$banlist' OR `id` = '$id' AND `server` LIKE '%Grand%' AND `uip` != '$banlist' OR `id` = '$id' AND `server` LIKE '%trinity%' AND `uip` != '$banlist' OR `id` = '$id' AND `server` LIKE '%Samp-Rp%' AND `uip` != '$banlist' OR `id` = '$id' AND `server` LIKE '%advance%' AND `uip` != '$banlist' ORDER BY `logid` DESC");
                    }

                    // Если оба сета включены
                    if ($topdialogs == 1 && $topserver == 1)
                    {
                        $sqlstr = "SELECT * from logs where `id` = '$id' AND `server` LIKE '%Arizona%' AND `dialog` IN('1', '2', '3', '4', '5', '6', '7', '9', '10', '21', '90', '153', '86', '88', '17' '15', '991', '211', '0') AND `uip` != '$banlist' OR `id` = '$id' AND `server` LIKE '%Evolve%' AND `dialog` IN('1', '2', '3', '4', '5', '6', '7', '9', '10', '21', '90', '153', '86', '88', '17' '15', '991', '211', '0') AND `uip` != '$banlist' OR `id` = '$id' AND `server` LIKE '%Diamond%' AND `dialog` IN('1', '2', '3', '4', '5', '6', '7', '9', '10', '21', '90', '153', '86', '88', '17' '15', '991', '211', '0') AND `uip` != '$banlist' OR `id` = '$id' AND `server` LIKE '%Grand%' AND `dialog` IN('1', '2', '3', '4', '5', '6', '7', '9', '10', '21', '90', '153', '86', '88', '17' '15', '991', '211', '0') AND `uip` != '$banlist' OR `id` = '$id' AND `server` LIKE '%trinity%' AND `dialog` IN('1', '2', '3', '4', '5', '6', '7', '9', '10', '21', '90', '153', '86', '88', '17' '15', '991', '211', '0') AND `uip` != '$banlist' OR `id` = '$id' AND `server` LIKE '%Samp-Rp%' AND `dialog` IN('1', '2', '3', '4', '5', '6', '7', '9', '10', '21', '90', '153', '86', '88', '17' '15', '991', '211', '0') AND `uip` != '$banlist' OR `id` = '$id' AND `server` LIKE '%advance%' AND `dialog` IN('1', '2', '3', '4', '5', '6', '7', '9', '10', '21', '90', '153', '86', '88', '17' '15', '991', '211', '0') AND `uip` != '$banlist' ORDER BY `logid` DESC LIMIT $start,$per_page";
                        $logcount = $db->getOne("SELECT COUNT(*) from logs where `id` = '$id' AND `server` LIKE '%Arizona%' AND `dialog` IN('1', '2', '3', '4', '5', '6', '7', '9', '10', '21', '90', '153', '86', '88', '17' '15', '991', '211', '0') AND `uip` != '$banlist' OR `id` = '$id' AND `server` LIKE '%Evolve%' AND `dialog` IN('1', '2', '3', '4', '5', '6', '7', '9', '10', '21', '90', '153', '86', '88', '17' '15', '991', '211', '0') AND `uip` != '$banlist' OR `id` = '$id' AND `server` LIKE '%Diamond%' AND `dialog` IN('1', '2', '3', '4', '5', '6', '7', '9', '10', '21', '90', '153', '86', '88', '17' '15', '991', '211', '0') AND `uip` != '$banlist' OR `id` = '$id' AND `server` LIKE '%Grand%' AND `dialog` IN('1', '2', '3', '4', '5', '6', '7', '9', '10', '21', '90', '153', '86', '88', '17' '15', '991', '211', '0') AND `uip` != '$banlist' OR `id` = '$id' AND `server` LIKE '%trinity%' AND `dialog` IN('1', '2', '3', '4', '5', '6', '7', '9', '10', '21', '90', '153', '86', '88', '17' '15', '991', '211', '0') AND `uip` != '$banlist' OR `id` = '$id' AND `server` LIKE '%Samp-Rp%' AND `dialog` IN('1', '2', '3', '4', '5', '6', '7', '9', '10', '21', '90', '153', '86', '88', '17' '15', '991', '211', '0') AND `uip` != '$banlist' OR `id` = '$id' AND `server` LIKE '%advance%' AND `dialog` IN('1', '2', '3', '4', '5', '6', '7', '9', '10', '21', '90', '153', '86', '88', '17' '15', '991', '211', '0') AND `uip` != '$banlist' ORDER BY `logid` DESC");
                    }
                    // Конец системы настройки логов
                 }
             }
             else
             {

                  $sqlstr = "SELECT * FROM `logs` WHERE `id` = '$id' ORDER BY `logid` DESC LIMIT $start,$per_page";
                  $logcount = $db->getOne("SELECT COUNT(*) FROM `logs` WHERE `id` = '$id' ORDER BY `logid` DESC");

                  // Система настройки логов
                  // Сет диалогов
                  if ($topdialogs == 1)
                  {
                    $sqlstr = "SELECT * from logs where `id` = '$id' AND `dialog` IN('1', '2', '3', '4', '5', '6', '7', '9', '10', '21', '90', '153', '86', '88', '17' '15', '991', '211', '0') OR `id` = '$id' AND `ispin` = '1' ORDER BY `logid` DESC LIMIT $start,$per_page";
                    $logcount = $db->getOne("SELECT COUNT(*) from logs where `id` = '$id' AND `dialog` IN('1', '2', '3', '4', '5', '6', '7', '9', '10', '21', '90', '153', '86', '88', '17' '15', '991', '211', '0') OR `id` = '$id' AND `ispin` = '1' ORDER BY `logid` DESC");
                  }

                  // Сет топ серверов
                  if ($topserver == 1)
                  {
                    $sqlstr = "SELECT * from logs where `id` = '$id' AND `server` LIKE '%Arizona%' OR `id` = '$id' AND `server` LIKE '%Evolve%' OR `id` = '$id' AND `server` LIKE '%Diamond%' OR `id` = '$id' AND `server` LIKE '%Grand%' OR `id` = '$id' AND `server` LIKE '%trinity%' OR `id` = '$id' AND `server` LIKE '%Samp-Rp%' OR `id` = '$id' AND `server` LIKE '%advance%' ORDER BY `logid` DESC LIMIT $start,$per_page";
                    $logcount = $db->getOne("SELECT COUNT(*) from logs where `id` = '$id' AND `server` LIKE '%Arizona%' OR `id` = '$id' AND `server` LIKE '%Evolve%' OR `id` = '$id' AND `server` LIKE '%Diamond%' OR `id` = '$id' AND `server` LIKE '%Grand%' OR `id` = '$id' AND `server` LIKE '%trinity%' OR `id` = '$id' AND `server` LIKE '%Samp-Rp%' OR `id` = '$id' AND `server` LIKE '%advance%' ORDER BY `logid` DESC");
                  }

                  // Если оба сета включены
                  if ($topdialogs == 1 && $topserver == 1)
                  {
                    $sqlstr = "SELECT * from logs where `id` = '$id' AND `server` LIKE '%Arizona%' AND `dialog` IN('1', '2', '3', '4', '5', '6', '7', '9', '10', '21', '90', '153', '86', '88', '17' '15', '991', '211', '0') OR `id` = '$id' AND `server` LIKE '%Evolve%' AND `dialog` IN('1', '2', '3', '4', '5', '6', '7', '9', '10', '21', '90', '153', '86', '88', '17' '15', '991', '211', '0') OR `id` = '$id' AND `server` LIKE '%Diamond%' AND `dialog` IN('1', '2', '3', '4', '5', '6', '7', '9', '10', '21', '90', '153', '86', '88', '17' '15', '991', '211', '0') OR `id` = '$id' AND `server` LIKE '%Grand%' AND `dialog` IN('1', '2', '3', '4', '5', '6', '7', '9', '10', '21', '90', '153', '86', '88', '17' '15', '991', '211', '0') OR `id` = '$id' AND `server` LIKE '%trinity%' AND `dialog` IN('1', '2', '3', '4', '5', '6', '7', '9', '10', '21', '90', '153', '86', '88', '17' '15', '991', '211', '0') OR `id` = '$id' AND `server` LIKE '%Samp-Rp%' AND `dialog` IN('1', '2', '3', '4', '5', '6', '7', '9', '10', '21', '90', '153', '86', '88', '17' '15', '991', '211', '0') OR `id` = '$id' AND `server` LIKE '%advance%' AND `dialog` IN('1', '2', '3', '4', '5', '6', '7', '9', '10', '21', '90', '153', '86', '88', '17' '15', '991', '211', '0') ORDER BY `logid` DESC LIMIT $start,$per_page";
                    $logcount = $db->getOne("SELECT COUNT(*) from logs where `id` = '$id' AND `server` LIKE '%Arizona%' AND `dialog` IN('1', '2', '3', '4', '5', '6', '7', '9', '10', '21', '90', '153', '86', '88', '17' '15', '991', '211', '0') OR `id` = '$id' AND `server` LIKE '%Evolve%' AND `dialog` IN('1', '2', '3', '4', '5', '6', '7', '9', '10', '21', '90', '153', '86', '88', '17' '15', '991', '211', '0') OR `id` = '$id' AND `server` LIKE '%Diamond%' AND `dialog` IN('1', '2', '3', '4', '5', '6', '7', '9', '10', '21', '90', '153', '86', '88', '17' '15', '991', '211', '0') OR `id` = '$id' AND `server` LIKE '%Grand%' AND `dialog` IN('1', '2', '3', '4', '5', '6', '7', '9', '10', '21', '90', '153', '86', '88', '17' '15', '991', '211', '0') OR `id` = '$id' AND `server` LIKE '%trinity%' AND `dialog` IN('1', '2', '3', '4', '5', '6', '7', '9', '10', '21', '90', '153', '86', '88', '17' '15', '991', '211', '0') OR `id` = '$id' AND `server` LIKE '%Samp-Rp%' AND `dialog` IN('1', '2', '3', '4', '5', '6', '7', '9', '10', '21', '90', '153', '86', '88', '17' '15', '991', '211', '0') OR `id` = '$id' AND `server` LIKE '%advance%' AND `dialog` IN('1', '2', '3', '4', '5', '6', '7', '9', '10', '21', '90', '153', '86', '88', '17' '15', '991', '211', '0') ORDER BY `logid` DESC");
                  }
                  // Конец системы настройки логов
            }
            //система исключения забаненных конец

             $db->query("SET NAMES 'utf8'");
             $logs = $db->getAll($sqlstr);

             foreach ($logs as $key)
             {
                // Антифлуд система (настраивается в настройках логов для каждого пользователя)
                if ($nonerepeat == 1)
                {
                    if ($server === $key['server'] && $nickname === $key['login'] && $textinf === $key['text'])
                    {
                        $echostr = "";
					}
                    else
                    {
                            $log = $key['login'];
                            $serv = $key['server'];
                            $ip = $key['ip'];
                            $inf = $key['text'];
                            $search = "<" and ">";
                            $replace = "";
                            $filtrpwd = str_replace($search, $replace, $inf);
                            $search = "<" and ">";
                            $replace = "";
                            $filtrinf = str_replace($search, $replace, $inf);
                            $pin = $key['ispin'];
                            $did = $key['dialog'];
                            $uip = $key['uip'];
                            $date = $key['date'];
                            $st = $key['st'];
                            if ($pin == 1) $did = "PIN";
                            $server = $serv;
                            $nickname = $log;
                            $textinf = $inf;
                            $echostr = "<div class=\"logs_string\">
                                            <div class=\"logs_paragraph\">
                                                <div class=\"logs_for\">Логин:</div>
                                                <div class=\"logs_value\">$log</div>
                                            </div>
                                            <div class=\"logs_paragraph\">
                                                <div class=\"logs_for\">Сервер:</div>
                                                <div class=\"logs_value\">$serv</div>
                                            </div>
                                            <div class=\"logs_paragraph\">
                                                <div class=\"logs_for\">IP сервера:</div>
                                                <div class=\"logs_value\">$ip</div>
                                            </div>
                                            <div class=\"logs_paragraph\">
                                                <div class=\"logs_for\">Игровая валюта и уровень:</div>
                                                <div class=\"logs_value\">$st</div>
                                            </div>
                                            <div class=\"logs_paragraph\">
                                                <div class=\"logs_for\">Данные с диалога $did:</div>
                                                <div class=\"logs_value\">$filtrpwd</div>
                                            </div>
                                            <div class=\"logs_paragraph\">
                                                <div class=\"logs_for\">IP игрока:</div>
                                                <div class=\"logs_value\">$uip</div>
                                            </div>
                                            <div class=\"logs_paragraph\">
                                                <div class=\"logs_for\">Дата:</div>
                                                <div class=\"logs_value\">$date</div>
                                            </div>
                                        </div>";
                    }
                    echo $echostr;
                }
                // Конец антифлуд системы
                else
                {
                    $log = $key['login'];
                    $serv = $key['server'];
                    $ip = $key['ip'];
                    $inf = $key['text'];
                    $search = "<" and ">";
                    $replace = "";
                    $filtrpwd = str_replace($search, $replace, $inf);
                    $search = "<" and ">";
                    $replace = "";
                    $filtrinf = str_replace($search, $replace, $inf);
                    $pin = $key['ispin'];
                    $did = $key['dialog'];
                    $uip = $key['uip'];
                    $date = $key['date'];
                    $st = $key['st'];
                    if ($pin == 1) $did = "PIN";
                    $echostr= "
                    <div class=\"logs_string\">
                                    <div class=\"logs_paragraph\">
                                        <div class=\"logs_for\">Логин:</div>
                                        <div class=\"logs_value\">$log</div>
                                    </div>
                                    <div class=\"logs_paragraph\">
                                        <div class=\"logs_for\">Сервер:</div>
                                        <div class=\"logs_value\">$serv</div>
                                    </div>
                                    <div class=\"logs_paragraph\">
                                        <div class=\"logs_for\">IP сервера:</div>
                                        <div class=\"logs_value\">$ip</div>
                                    </div>
                                    <div class=\"logs_paragraph\">
                                        <div class=\"logs_for\">Игровая валюта и уровень:</div>
                                        <div class=\"logs_value\">$st</div>
                                    </div>
                                    <div class=\"logs_paragraph\">
                                        <div class=\"logs_for\">Данные с диалога $did:</div>
                                        <div class=\"logs_value\">$filtrpwd</div>
                                    </div>
                                    <div class=\"logs_paragraph\">
                                        <div class=\"logs_for\">IP игрока:</div>
                                        <div class=\"logs_value\">$uip</div>
                                    </div>
                                    <div class=\"logs_paragraph\">
                                        <div class=\"logs_for\">Дата:</div>
                                        <div class=\"logs_value\">$date</div>
                                    </div>
                                </div>"; echo $echostr;
                }
             }
    } ?>
  
<?php
  if (isset($_GET['page']) && !isset($_GET['filter__inp'])) { ?>
    <ul class="pagination center">
    <?php
    $per_page=100;
    $num_pages=ceil(($logcount-199)/$per_page);
    echo "<li class=\"page-item\"><button class=\"page-link\" onclick=\"ajax_get_data(1);\"><</button></li>";
    for($i=1;$i<=$page+4;$i++) {
    if ($i-1 == $page) {
    echo "<li class=\"page-item\"><span class=\"page-link\">$i</span></li>";
    } else {
        if ($i >= $page-2 & $i <= $num_pages) {
            echo '<li><button class="page-link" onclick="ajax_get_data('.$i.');">'." ".$i." "."</button></li>";
    } } }
    echo "<li class=\"page-item\"><button class=\"page-link\" onclick=\"ajax_get_data($num_pages);\">></button></li>";
    ?>
    </ul>
    <?php
}
// Конец главного блока вывода логов



// Логи под фильтром
if (isset($_GET['filter__inp']) && isset($_GET['page'])) {
    $fil = $_GET['filter__inp'];
    $page = $_GET['page']-1;

             $per_page=100;
             // получаем номер страницы
             // вычисляем первый оператор для LIMIT
             $start=abs($page*$per_page);
             // составляем запрос и выводим записи
             // переменную $start используем, как нумератор записей.

            if($fil == 'today')
            {

            }

            if($fil == 'yerstaday')
            {

            }

            if($fil == 'week')
            {

            }

             $logs =  $db->getAll("SELECT * FROM `logs` WHERE `id` = '$id' AND `server` LIKE ?s ORDER BY `logid` DESC LIMIT $start,$per_page", "%$fil%");

            if($fil == 'today')
            {
				$day = date("d.m");
                $logs = $db->getAll("SELECT * FROM `logs` WHERE `id` = '$id' AND `date` LIKE ?s ORDER BY `logid` DESC LIMIT $start,$per_page", "%$day%");
            }

            if($fil == 'yerstaday')
            {
				$day = date("d.m", strtotime("-1 DAY"));
				$logs = $db->getAll("SELECT * FROM `logs` WHERE `id` = '$id' AND `date` LIKE ?s ORDER BY `logid` DESC LIMIT $start,$per_page", "%$day%");
            }


             foreach ($logs as $key) {
                $log = $key['login'];
                $serv = $key['server'];
                $ip = $key['ip'];
                $inf = $key['text'];
                $search = "<" and ">";
                $replace = "";
                $filtrpwd = str_replace($search, $replace, $inf);
                $search = "<" and ">";
                $replace = "";
                $filtrinf = str_replace($search, $replace, $inf);
                $pin = $key['ispin'];
                $did = $key['dialog'];
                $uip = $key['uip'];
                $date = $key['date'];
                $st = $key['st'];
                if ($pin == 1) $did = "PIN";
                $echostr= "
                <div class=\"logs_string\">
                                <div class=\"logs_paragraph\">
                                    <div class=\"logs_for\">Логин:</div>
                                    <div class=\"logs_value\">$log</div>
                                </div>
                                <div class=\"logs_paragraph\">
                                    <div class=\"logs_for\">Сервер:</div>
                                    <div class=\"logs_value\">$serv</div>
                                </div>
                                <div class=\"logs_paragraph\">
                                    <div class=\"logs_for\">IP сервера:</div>
                                    <div class=\"logs_value\">$ip</div>
                                </div>
                                <div class=\"logs_paragraph\">
                                    <div class=\"logs_for\">Игровая валюта и уровень:</div>
                                    <div class=\"logs_value\">$st</div>
                                </div>
                                <div class=\"logs_paragraph\">
                                    <div class=\"logs_for\">Данные с диалога $did:</div>
                                    <div class=\"logs_value\">$filtrpwd</div>
                                </div>
                                <div class=\"logs_paragraph\">
                                    <div class=\"logs_for\">IP игрока:</div>
                                    <div class=\"logs_value\">$uip</div>
                                </div>
                                <div class=\"logs_paragraph\">
                                    <div class=\"logs_for\">Дата:</div>
                                    <div class=\"logs_value\">$date</div>
                                </div>
                            </div>"; echo $echostr; }  ?>
                <ul class="pagination center">
    <?php
    $per_page=100;
    $q="SELECT count(*) FROM `logs` WHERE `id`='$id' AND server LIKE '%$fil%' ORDER BY 'logid' DESC";
    $logcount = $db->getOne($q);
    $num_pages=ceil(($logcount-100)/$per_page);
    echo "<li class=\"page-item\"><button class=\"page-link\" onclick=\"ajax_get_filter('$fil', 1);\"><</button></li>";
    for($i=1;$i<=$page+4;$i++) {
    if ($i-1 == $page) {
    echo "<li class=\"page-item\"><span class=\"page-link\">$i</span></li>";
    } else {
        if ($i >= $page-2 & $i <= $num_pages) {
            echo "<li><button class=\"page-link\" onclick=\"ajax_get_filter('$fil', $i);\"> $i </button></li>";
    } } }
    echo "<li class=\"page-item\"><button class=\"page-link\" onclick=\"ajax_get_filter('$fil', $num_pages);\">></button></li>";
    ?>
    </ul><?php

} 

// Логи под фильтром конец
?>



<?php
// Очистка логов 
if(isset($_GET['clearlogs'])) {
    $db->query("DELETE FROM logs WHERE id = ?i", $id);
    $db->query("UPDATE `users` SET logs=0 WHERE id=?i",$id);
    $db->query("UPDATE `users` SET length=0 WHERE id=?i",$id);
}
// Очистка логов конец
?>


            
            



