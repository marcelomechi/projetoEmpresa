<?php

class AjaxPerfilController extends Controller{

  

public function index(){
    
    $usuarios = new Usuarios();  
      
    if($_POST['tipo'] == 1){
        
        Usuarios::verificaLogin();
        
        $idBackground = $_POST['backgroundMenu'];        
        
        if(isset($_FILES['foto']) && !empty($_FILES['foto'])){
		$foto = $_FILES['foto'];              
                $retorno = $usuarios -> enviaFotoPerfil($foto,$idBackground);

		if($retorno === true)
		{
			echo "success";
		}else
		{
			echo "fail";
		}

	}elseif(!isset($_FILES['foto']))
	{
		$saveBackground = $usuarios -> gravaBackground($idBackground);
                    if($saveBackground === true){
                        echo "success";
                    }else{
                        echo "fail";
                    }
	}
        
    }elseif($_POST['tipo'] == 2){
        Usuarios::verificaLogin();
        
        
        $dadosPessoais = array(
         'tema' => $_POST['tema'],
         'apelido' => $_POST['apelido'],
         'email' => $_POST['email'],
         'telefoneFixo' => $_POST['telefoneFixo'],
         'telefoneCelular' => $_POST['telefoneCelular'],
         'telefoneRecado' => $_POST['telefoneRecado'],
         'aniversario' => $_POST['aniversario']
        );
        
        $gravaDadosPessoais = $usuarios -> gravaPreferenciasPessoais($dadosPessoais);
       
            
        if($gravaDadosPessoais === true)
		{
                    echo "success";
		}else
		{
		    echo "fail";
		}
                
    }elseif($_POST['tipo'] == 3){
        Usuarios::verificaLogin();
       
        if(isset($_POST['tema'])){
            $gravaTema = $usuarios -> gravaTema($_POST['tema']);
           
            if($gravaTema === true){
                echo "success";
            }else{
                echo "fail";
            }
        }else{
            return false;
        }
            
        
    }
    
    
	

	
}



}

?>