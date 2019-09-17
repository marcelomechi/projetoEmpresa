<?php

class Core {
	public function start(){
		
		
		$url = "/";
		$params = array();
		
		if(isset($_GET['url'])){
			$url.= $_GET['url'];
		}

		if(!empty($url) && $url != '/'){
			$url = explode('/', $url);
			array_shift($url); //removendo o primeiro registro, no caso a /

			$currentController = $url[0].'Controller';
			array_shift($url);

			if(isset($url[0]) && !empty($url[0]) ){
				$currentAction = $url[0];
				array_shift($url);
			}else{
				$currentAction = 'index';
			}

			if(count($url) > 0){
				$params = $url;
			}

		}else{
			$currentController = 'homeController';
			$currentAction = 'index';
		}

		$controller = new $currentController();

		call_user_func_array(array($controller, $currentAction),$params);

		/*echo "<pre>";
		echo "controller ".$currentController."<br>";
		echo "action ".$currentAction."<br>";
		echo "params ".print_r($params,true)."<br>";*/
	}
}


?>