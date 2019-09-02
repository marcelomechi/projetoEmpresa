<?php

require('environment.php');

$config = array();

if (ENVIRONMENT == 'development'){
	define("BASE_URL","http://10.11.194.42/");
	$config['dbname'] = 'DB_WFM_HOMOLOGACAO';
	$config['host'] = '10.11.194.42';
	$config['dbuser'] = 'userAPI';
	$config['dbpass'] = 'MI$j4g9s6J7D6ik';
}else{
	$config['dbname'] = 'login';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '';
}

global $db;

try {
	$db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'],$config['dbuser'],$config['dbpass']);

}catch (PDOException $e) {
	echo "erro: ".$e -> getMessage();
	exit;
}


?>