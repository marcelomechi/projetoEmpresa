<?php


class Usuarios extends Model {
	public function verificaLogin(){
		
		/* se não tiver setado ou se tiver setado e tiver vazio */

		if(!isset($_SESSION['usuario']) || (isset($_SESSION['usuario']) && !empty($_SESSION['usuario']))  ){

			header("Location: ".BASE_URL."login");
			exit;

		}
		
	}

	public function dadosUsuario($login){
			
				$dados = array(
					'id_usuario' => '',
					'nome' => ''
				);

				$sql =  "SELECT * FROM TB_WFM_USUARIO U ";
				$sql .= "JOIN TB_CAD_COLABORADOR C ON C.CPF = U.CPF ";
				$sql .= "WHERE U.CPF = :cpf ";

				$sql = $this-> db -> prepare($sql);
				$sql -> bindValue(':cpf',$login);
				$sql -> execute();

				if($sql -> rowCount() > 0){
					$sql = $sql -> fetch();					
					
					$pin = $sql['PIN'];
					$nome = $sql['NOME'];
					$id_perfil_acesso = $sql['ID_PERFIL_ACESSO'];

					$dados = array(
						'pin' => $pin,
						'nome' => $nome,
						'id_perfil_acesso' => $id_perfil_acesso
					); 

					return $dados;	
				}else{
					return false;
				}
		
	}

	public function autenticaUsuario($login, $senha){
				$dados = array(
					'status' => ''
				);

				$sql = "SELECT * FROM usuarios WHERE id_usuario = :id_usuario AND senha_inicial = md5(:senha_inicial)";
				$sql = $this-> db -> prepare($sql);
				$sql -> bindValue(':id_usuario',$login);
				$sql -> bindValue(':senha_inicial',$senha);
				$sql -> execute();

				if($sql -> rowCount() > 0){
					$sql = $sql -> fetch();
					
					$_SESSION['id_usuario'] = $sql['id_usuario'];	
					$_SESSION['senha_inicial'] = $sql['senha_inicial'];		

					$dados = array(
						'status' => 'logado'
					); 

					return $dados;	
				}else{
					return false;	
				}

	}
}


?>