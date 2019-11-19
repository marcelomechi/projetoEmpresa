<?php

/* define o limitador de cache para 'private'
session_cache_limiter('private');
$cache_limiter = session_cache_limiter();
 */
/* define o prazo do cache em 1440 minutos (1hr) 
session_cache_expire(1440);
$cache_expire = session_cache_expire();
*/
/* inicia a sessão */


/* SALVANDO EM UMA PASTA A PARTE O ARQUIVO DE SESSION E DEFININDO EM 8 HORAS O TEMPO DE EXPIRAR, FUNCIONANDO ATÉ O MOMENTO */
session_save_path('teste');
ini_set('session.gc_maxlifetime', '28800');

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
        }else if(!file_exists('controllers/'.$folderController.'/'.$classe.'.php')){
            require 'controllers/notfound/notfoundController.php';
        }
});

$core = new Core();
$core->start();

?>