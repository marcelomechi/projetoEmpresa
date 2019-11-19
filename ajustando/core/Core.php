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

			//$currentFolder = $url[0].'/';
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
                
                $pasta = explode("Controller", $currentController);
                $pasta2 = explode("ajax",$pasta[0]);
                
                if(empty($pasta2[0])){
                    /* tratamento quando tiver a palavra ajax */
                    $pasta3 = explode("ajax",$pasta2[1]);
                }else{
                     $pasta3 = explode("ajax",$pasta2[0]);
                }
                
                $pasta4 = strtolower($pasta3[0]);
                              
                if(!file_exists("controllers/".$pasta4.'/'.$currentController.'.php') || !method_exists($currentController, $currentAction)){
                                          
                        $currentController = 'notfoundController';
			$currentAction = 'index';
                }
                
		$controller = new $currentController();

		call_user_func_array(array($controller, $currentAction),$params);

                /*
		echo "<pre>";
		echo "pasta ".$currentFolder."<br>";
		echo "controller ".$currentController."<br>";
		echo "action ".$currentAction."<br>";
		echo "params ".print_r($params,true)."<br>";
		echo "pasta ".$_GET['url']."<br>";
                 */
	}
}


?>