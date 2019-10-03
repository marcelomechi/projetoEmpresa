<?php

class AjaxPerfilController extends Controller{


public function index(){
        
	if(isset($_FILES['foto']))
	{
		$foto = $_FILES['foto'];
                $idBackground = $_POST['backgroundMenu'];
		
              
                
		$usuarios = new Usuarios();
		$retorno = $usuarios -> enviaFotoPerfil($foto);

		if($retorno === true)
		{
			echo $testando;
		}else
		{
			echo "fail";
		}

	}
	else
	{
		return false;
	}

	
}



}

?>