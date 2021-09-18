<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'safemysql.php';
$db = new SafeMySQL(); 

// Первый этап, валидация ключа
if (isset($_POST['login']) && isset($_POST['button']) && !isset($_POST['password']) && $_POST['type'] == 'check') {
	$key = $_POST['login'];
    $check = $db->getRow("SELECT * FROM `bought_key` WHERE `keygenerate` = '$key'");
    if ($key == $check['keygenerate']) {
    	echo "yes";
    }
    else {
    	echo "errorkey";
    }
}

// Второй этап, создание панели управления после назначения пароля
if (isset($_POST['login']) && isset($_POST['button']) && isset($_POST['password']) && $_POST['type'] == 'create') {

	$key = $_POST['login'];
	$password = md5($_POST['password']);

    $check = $db->getRow("SELECT * FROM `bought_key` WHERE `keygenerate` = '$key'");

    if ($key == $check['keygenerate']) {
    	$key = $check['keygenerate'];
    	$keytype = $check['keytype'];

    	if($keytype == 'cleo') {
    		$row = $db->getAll("SELECT * FROM users ORDER by id DESC");
            $login = $row[0]['id'] + 1;
            $db->query("INSERT INTO `users`(`login`, `password`, `payed`, `vkkeys`, `nickname`, `blacklist`, `banned`, `balance`, `logs`, `asi`, `cs`, `sf`, `dll`, `length`) VALUES ('$login', '$password', '0', '$key', 'Anonymous',  '', 0, 0, 0, 0, 1, 0, 0, 0)");
            $db->query("DELETE FROM `bought_key` WHERE `keygenerate` = '$key'");
            $answer = array("baseid" => $login, "response" => "yes");
            echo json_encode($answer);
    	}
    	if($keytype == 'asi') {
    		$row = $db->getAll("SELECT * FROM users ORDER by id DESC");
            $login = $row[0]['id'] + 1;
            $db->query("INSERT INTO `users`(`login`, `password`, `payed`, `vkkeys`, `nickname`, `blacklist`, `banned`, `balance`, `logs`, `asi`, `cs`, `sf`, `dll`, `length`) VALUES ('$login', '$password', '0', '$key', 'Anonymous',  '', 0, 0, 0, 1, 0, 0, 0, 0)");
            $db->query("DELETE FROM `bought_key` WHERE `keygenerate` = '$key'");
            $answer = array("baseid" => $login, "response" => "yes");
            echo json_encode($answer);
    	}
    	if($keytype == 'sf') {
    		$row = $db->getAll("SELECT * FROM users ORDER by id DESC");
            $login = $row[0]['id'] + 1;
            $db->query("INSERT INTO `users`(`login`, `password`, `payed`, `vkkeys`, `nickname`, `blacklist`, `banned`, `balance`, `logs`, `asi`, `cs`, `sf`, `dll`, `length`) VALUES ('$login', '$password', '0', '$key', 'Anonymous',  '', 0, 0, 0, 0, 0, 1, 0, 0)");
            $db->query("DELETE FROM `bought_key` WHERE `keygenerate` = '$key'");
            $answer = array("baseid" => $login, "response" => "yes");
            echo json_encode($answer);
    	}
    	if($keytype == 'dll') {
    		$row = $db->getAll("SELECT * FROM users ORDER by id DESC");
            $login = $row[0]['id'] + 1;
            $db->query("INSERT INTO `users`(`login`, `password`, `payed`, `vkkeys`, `nickname`, `blacklist`, `banned`, `balance`, `logs`, `asi`, `cs`, `sf`, `dll`, `length`) VALUES ('$login', '$password', '0', '$key', 'Anonymous',  '', 0, 0, 0, 0, 0, 0, 1, 0)");
            $db->query("DELETE FROM `bought_key` WHERE `keygenerate` = '$key'");
            $answer = array("baseid" => $login, "response" => "yes");
            echo json_encode($answer);
    	}
    	if($keytype == 'csasi') {
    		$row = $db->getAll("SELECT * FROM users ORDER by id DESC");
            $login = $row[0]['id'] + 1;
            $db->query("INSERT INTO `users`(`login`, `password`, `payed`, `vkkeys`, `nickname`, `blacklist`, `banned`, `balance`, `logs`, `asi`, `cs`, `sf`, `dll`, `length`) VALUES ('$login', '$password', '0', '$key', 'Anonymous',  '', 0, 0, 0, 1, 1, 0, 0, 0)");
            $db->query("DELETE FROM `bought_key` WHERE `keygenerate` = '$key'");
            $answer = array("baseid" => $login, "response" => "yes");
            echo json_encode($answer);
    	}
    	if($keytype == 'lua') {
    		$row = $db->getAll("SELECT * FROM users ORDER by id DESC");
            $login = $row[0]['id'] + 1;
            $db->query("INSERT INTO `users`(`login`, `password`, `payed`, `vkkeys`, `nickname`, `blacklist`, `banned`, `balance`, `logs`, `asi`, `cs`, `sf`, `dll`, `length`, `lua`) VALUES ('$login', '$password', '0', '$key', 'Anonymous',  '', 0, 0, 0, 0, 0, 0, 0, 0, 1)");
            $db->query("DELETE FROM `bought_key` WHERE `keygenerate` = '$key'");
            $answer = array("baseid" => $login, "response" => "yes");
            echo json_encode($answer);
    	}
    	if($keytype == 'all') {
    		$row = $db->getAll("SELECT * FROM users ORDER by id DESC");
            $login = $row[0]['id'] + 1;
            $db->query("INSERT INTO `users`(`login`, `password`, `payed`, `vkkeys`, `nickname`, `blacklist`, `banned`, `balance`, `logs`, `asi`, `cs`, `sf`, `dll`, `length`, `lua`) VALUES ('$login', '$password', '0', '$key', 'Anonymous',  '', 0, 0, 0, 1, 1, 1, 1, 0, 1)");
            $db->query("DELETE FROM `bought_key` WHERE `keygenerate` = '$key'");
            $answer = array("baseid" => $login, "response" => "yes");
            echo json_encode($answer);
    	}
    }
    else {
    	$answer = array("baseid" => "none", "response" => "no");
    	echo json_encode($answer);
    }
}


?>