<?php
require('environment.php');
require('core/Controller.php');
$config = array();
$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',
    PDO::MYSQL_ATTR_FOUND_ROWS => true
);
if (ENVIRONMENT == 'development'){
	define("BASE_URL","http://10.11.194.42/");
	$config['dbname'] = 'DB_WFM';
	$config['host'] = '10.11.194.42';
	$config['dbuser'] = 'userAPI';
	$config['dbpass'] = 'MI$j4g9s6J7D6ik';
}else{
	define("BASE_URL","http://10.11.194.50/");
	$config['dbname'] = 'login';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '';
}
global $db;
try {
	$db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'],$config['dbuser'],$config['dbpass'],$options);
}catch (PDOException $e) {
        $data = array(
            'erro' => $e -> getMessage()
        );
        
        $classe = new Controller();
        $classe ->loadView("503",$data);
	exit;
}
?>