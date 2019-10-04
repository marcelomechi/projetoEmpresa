<?php

class AjaxPerfilController extends Controller{

  

public function index(){
    
    $usuarios = new Usuarios();  
      
    if($_POST['tipo'] == 1){
        
        if(isset($_FILES['foto']))
	{
		$foto = $_FILES['foto'];
                $idBackground = $_POST['backgroundMenu'];     
                		
		$retorno = $usuarios -> enviaFotoPerfil($foto,$idBackground);

		if($retorno === true)
		{
			echo "success";
		}else
		{
			echo "fail";
		}

	}
	else
	{
		return false;
	}
        
    }else{
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
                
    }
	

	
}



}

?>