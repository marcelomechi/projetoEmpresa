<?php
session_start();

require 'config.php';


spl_autoload_register(function($classe){
	/* sempre que uma classe for instanciada temos que procurar em tres lugares diferentes:		
		controllers
		models
		core
	*/



	$x = '';
	$y = '';
	$folderController = '';



	if(!isset($_GET['url']) && empty($_GET['url'])){
		$x = 'home';
	}else{
		$x = $_GET['url'];
	}
	
	$y = explode("ajax",$x);


	if(isset($y[0]) && !empty($y[0])){
		$folderController = strtolower($y[0]);
	}else{
		$folderController = strtolower($y[1]);
	}


	if(file_exists('controllers/'.$folderController.'/'.$classe.'.php')){
		require 'controllers/'.$folderController.'/'.$classe.'.php';
	}else if (file_exists('models/'.$classe.'.php')){
		require 'models/'.$classe.'.php';		
	}else if (file_exists('core/'.$classe.'.php')){
		require 'core/'.$classe.'.php';	
	}
});

$core = new Core();
$core->start();

?>