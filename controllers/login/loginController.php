<?php

// o parent só vai funcionar se a classe pai, nesse caso o Controller tiver um __construct, senão não funciona, pode deixar sem */


class LoginController extends Controller{
	
	public function __construct() {
		
	}

	public function index(){
		$dados = array();
		$this -> loadView('login',$dados);
	}

	public function registro(){
		$dados = array();
		$this -> loadView('registro',$dados,'login');
	}

	public function cadastraConvidado(){
	
		if(   isset($_POST['nomeConvidado']) && !empty($_POST['nomeConvidado']) 
		   && isset($_POST['cpfConvidado']) && !empty($_POST['cpfConvidado'])  
		   && isset($_POST['emailConvidado']) && !empty($_POST['emailConvidado']) 
		   && isset($_POST['cargoConvidado']) && !empty($_POST['cargoConvidado']) 
		   && isset($_POST['sexoConvidado']) && !empty($_POST['sexoConvidado']) 
		   && isset($_POST['cepConvidado']) && !empty($_POST['cepConvidado']) 
		   && isset($_POST['ruaConvidado']) && !empty($_POST['ruaConvidado']) 
		   && isset($_POST['bairroConvidado']) && !empty($_POST['bairroConvidado']) 
		   && isset($_POST['cidadeConvidado']) && !empty($_POST['cidadeConvidado']) 
		   /*&& isset($_POST['estadoConvidado']) && !empty($_POST['estadoConvidado'])*/ )
		   
	    {
			$nome = addslashes($_POST['nomeConvidado']);
			$cpf = preg_replace("/[^0-9]/", "", $_POST['cpfConvidado']);
			$email = addslashes($_POST['emailConvidado']);
			$cargo = addslashes($_POST['cargoConvidado']);
			$sexo = addslashes($_POST['sexoConvidado']);
			$cep = addslashes($_POST['cepConvidado']);
			$rua = addslashes($_POST['ruaConvidado']);
			$bairro = addslashes($_POST['bairroConvidado']);
			$cidade = addslashes($_POST['cidadeConvidado']);
		//	$estado = addslashes($_POST['estadoConvidado']);
			$numero = isset($_POST['numeroConvidado']) ? addslashes($_POST['numeroConvidado']) : null;
		//	$complemento = isset($_POST['complementoConvidado']) ? addslashes($_POST['complementoConvidado']) : null;
		
		
			$arrayConvidado = array(
				'nome' => $nome,
				'cpf' => $cpf,
				'email' => $email,
				'cargo' => $cargo,
				'sexo' => $sexo,
				'cep' => $cep,
				'rua' => $rua,
				'bairro' => $bairro,
				'cidade' => $cidade,
				//'estado' => $estado,
				'numero' => $numero,
				//'complemento' => $complemento

			);

			$classe= new Autenticacao;

			$retorno = $classe -> gravaUsuarioConvidado($arrayConvidado);


		}else{
			echo 'ops';
		}

		/*if($_POST['nomeConvidado'])
		$_POST['cpfConvidado']
		$_POST['emailConvidado']
		$_POST['cargoConvidado']
		$_POST['sexoConvidado']
		$_POST['cepConvidado']
		$_POST['ruaConvidado']
		$_POST['numeroConvidado']
		$_POST['complementoConvidado']
		$_POST['bairroConvidado']
		$_POST['cidadeConvidado']
		$_POST['estadoConvidado']*/

	}

}




?>