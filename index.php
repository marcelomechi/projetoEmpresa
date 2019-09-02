<?php
session_start();

require 'config.php';


spl_autoload_register(function($classe){
	/* sempre que uma classe for instanciada temos que procurar em tres lugares diferentes:		
		controllers
		models
		core
	*/
	if(file_exists('controllers/'.$classe.'.php')){
		require 'controllers/'.$classe.'.php';			
	}else if (file_exists('models/'.$classe.'.php')){
		require 'models/'.$classe.'.php';		
	}else if (file_exists('core/'.$classe.'.php')){
		require 'core/'.$classe.'.php';	
	}
});

$core = new Core();
$core->start();

?>