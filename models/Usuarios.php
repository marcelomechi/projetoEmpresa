<?php


class Usuarios extends Model {
	public function verificaLogin(){
		
		/* se não tiver setado ou se tiver setado e tiver vazio */
	
		if(empty($_SESSION['usuario'])){
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
					$id_perfil_acesso = $sql['ATIVO'];

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

	public function primeiroLogin($login, $senha){
		$dados = array(
			'status' => ''
		);

				$_SESSION['usuario'] = '';	
				$_SESSION['senha'] = '';
				$_SESSION['CPF'] = '';
				$_SESSION['id_perfil_acesso'] = '';
				$_SESSION['id_tema_preferido'] = '';
				$_SESSION['exibir_aniversario'] = '';
				$_SESSION['foto'] = '';


		if($login == $senha){
			
			$sql = "SELECT U.PIN, U.CPF, U.SENHA, U.ATIVO, P.ID_TEMA_PREFERIDO, P.EXIBIR_ANIVERSARIO, P.APELIDO, P.CAMINHO_FOTO  FROM TB_WFM_USUARIO U ";
			$sql .= "JOIN TB_WFM_PERFIL_PESSOAL P ON P.CPF = U.CPF ";
			$sql .= "WHERE U.CPF = :senha_inicial ";
								
			$sql = $this-> db -> prepare($sql);
			$sql -> bindValue(':senha_inicial',$senha);
			$sql -> execute();

			if($sql -> rowCount() > 0){
				$sql = $sql -> fetch();
				
				/*$sqlUpdate = "UPDATE TB_WFM_USUARIO SET SENHA = :senha WHERE CPF = :senha";
				$sqlUpdate = $this -> db -> prepare($sqlUpdate);
				$sqlUpdate->bindValue(':senha',$senha);
				$sqlUpdate->execute();*/

				$_SESSION['usuario'] = $sql['CPF'];	
	
					$dados = array(
						'status' => BASE_URL
					);

					return $dados;
				
			}else{
				$dados = array(
					'status' => 'n_logado'
				);
				
				return $dados;
			}

		}else{
			return false;
		}

					

}

	
	
}


?>