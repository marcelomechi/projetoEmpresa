<?php

/*
* Classe que cuida dos acessos de usuários e dos menus
* Funcao verificaLogin faz a verificação no banco se existe o login a partir do ajax
* Funcao primeiroLogin faz a verificacao no banco se a senha e o login conferem a partir  do ajax assim carregando a index
* Funcao menu carrega o menu de acordo com as informações de permissão do usuário
*
*
*/


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
			
			$sql = "SELECT U.PIN, U.CPF, U.SENHA, U.ATIVO, P.ID_TEMA_PREFERIDO, P.EXIBIR_ANIVERSARIO, P.APELIDO, P.CAMINHO_FOTO, UP.ID_PERFIL FROM TB_WFM_USUARIO U ";
			$sql .= "JOIN TB_WFM_PERFIL_PESSOAL P ON P.CPF = U.CPF ";
			$sql .= "JOIN TB_WFM_USUARIO_PERFIL UP ON U.CPF = UP.CPF ";
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
				$_SESSION['CPF'] = $sql['CPF'];
				$_SESSION['permissao'] = $sql['ID_PERFIL'];	
	
					$dados = array(
						'status' => BASE_URL
					);

					return $dados;
				
			}else{

				$dados = array(
						'status' => false
					);

				return $dados;
			}

		}else{
			return false;
		}

					

	}

 public function menu(){
  
			  $sql = "SELECT DISTINCT ID_MODULO, ";
			  $sql.= "                TITULO_WEB, ";
			  $sql.= "                ID_WEB_MODULO,";
			  $sql.= "                CAMINHO_ICONE,";
			  $sql.= "                CAMINHO_LINK, ";
			  $sql.= "                ORDENACAO, ";
			  $sql.= "                NOME_MODULO ";
			  $sql.= "FROM TB_WFM_MODULO ";
			  $sql.= "WHERE ATIVO = 1 ";
			  $sql.= "AND (ID_MODULO IN ";
			  $sql.= "       (SELECT ID_MODULO ";
			  $sql.= "        FROM TB_WFM_MODULO_ACESSO_PERFIL ";
			  $sql.= "        WHERE ID_PERFIL IN ";
			  $sql.= "            (SELECT ID_PERFIL ";
			  $sql.= "             FROM TB_WFM_USUARIO_PERFIL ";
			  $sql.= "             WHERE CPF = :CPF ) ) ";
			  $sql.= "     OR ID_MODULO IN ";
			  $sql.= "       (SELECT ID_MODULO ";
			  $sql.= "        FROM TB_WFM_MODULO_ACESSO_INDIVIDUAL ";
			  $sql.= "        WHERE CPF = :CPF ";
			  $sql.= "          AND LIBERADO = 1 )) ";
			  $sql.= " AND ID_MODULO NOT IN ";
			  $sql.= "  (SELECT ID_MODULO ";
			  $sql.= "   FROM TB_WFM_MODULO_ACESSO_INDIVIDUAL ";
			  $sql.= "   WHERE CPF = :CPF ";
			  $sql.= "   AND BLOQUEADO = 1 )/* --PARA MENU PRINCIPAL-- */ ";
			  $sql.= "   AND ID_MODULO_REFERENCIA IS NULL /* --PARA SUBMENU-- */ ";
			  $sql.= "  /*AND ID_MODULO_REFERENCIA = VARIAVEL DO APP*/ ";
			  $sql.= "  ORDER BY ORDENACAO; ";

			  $sql = $this-> db -> prepare($sql);
			  $sql -> bindValue(':CPF',$_SESSION['CPF']);
			  $sql -> execute();

			    if($sql -> rowCount() > 0){
			          $sql = $sql -> fetchAll();

			          foreach ($sql as $key => $value) {
			            echo '<li>';
			            echo '<a href='.BASE_URL.$value['CAMINHO_LINK'].' class="collapsible-header"><i class="material icons"><img class="circle responsive-img iconeTemplate" src="'.BASE_URL.$value['CAMINHO_ICONE'].'"></i>'.$value['NOME_MODULO'].'</a>';
			            echo '</li>';
			          }

			    }else{
			      return false;
			    }
  
  }
	
}


?>