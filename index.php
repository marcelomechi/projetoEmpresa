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
	$pasta = '';


	if(!isset($_GET['url']) && empty($_GET['url'])){
		$x = 'home';
	}else{
		$x = $_GET['url'];
	}
	
	$y = explode("ajax",$x);


	if(isset($y[0]) && !empty($y[0])){
		$pasta = explode("/", $y[0]);
		//print_r($teste);
		$folderController = strtolower($pasta[0]);
	}else{
		$pasta = explode("/", $y[1]);
		//print_r($teste);
		$folderController = strtolower($pasta[0]);
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