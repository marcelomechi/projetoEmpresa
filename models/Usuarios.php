<?php

/*
* Classe que cuida dos acessos de usuários e dos menus
* Funcao verificaLogin faz a verificação no banco se existe o login a partir do ajax
* Funcao primeiroLogin faz a verificacao no banco se a senha e o login conferem a partir  do ajax assim carregando a index
* Funcao menu carrega o menu de acordo com as informações de permissão do usuário, o menu pode ter até 10 níveis de submenus
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


	public function getPreferencias($cpf){

		$sql = "SELECT * FROM TB_WFM_PERFIL_PESSOAL ";
		$sql.= "WHERE CPF = :CPF ";

		$sql = $this-> db -> prepare($sql);
		$sql -> bindValue(':CPF',$cpf);
		$sql -> execute();

		if($sql -> rowCount() > 0){
			$sql = $sql -> fetch();
			$nome = ucfirst(strtolower($sql['APELIDO']));			
			
			$dados = array(
				'cpf' => $sql['CPF'],
				'telefone1' => $sql['TEL1'],
				'telefone2' => $sql['TEL2'],
				'telefone3' => $sql['TEL3'],
				'email' => $sql['EMAIL'],
				'id_tema_preferido' => $sql['ID_TEMA_PREFERIDO'],
				'exibir_aniversario' => $sql['EXIBIR_ANIVERSARIO'],
				'apelido' => $nome,
				'caminhoFoto' => $sql['CAMINHO_FOTO']
			);

			return $dados;

		}else{
			return false;
		}





	}


 public function menu(){
  
			  $sql = "SELECT DISTINCT M.ID_MODULO, ";
              $sql.= "M.ID_MODULO_REFERENCIA, ";
              $sql.= "M.TITULO_WEB, ";
              $sql.= "M.ID_WEB_MODULO, ";
              $sql.= "M.CAMINHO_ICONE, ";
              $sql.= "M.CAMINHO_LINK, ";
              $sql.= "COUNT(MSUB.ID_MODULO) AS QTDESUB, ";
              $sql.= "M.ORDENACAO ";
			  $sql.= "FROM TB_WFM_MODULO M ";
			  $sql.= "LEFT JOIN TB_WFM_MODULO MSUB ON MSUB.ID_MODULO_REFERENCIA = M.ID_MODULO ";
			  $sql.= "WHERE M.ATIVO = 1 ";
			  $sql.= "AND (M.ID_MODULO IN ";
			  $sql.=         "(SELECT ID_MODULO "; 
			  $sql.=	          "FROM TB_WFM_MODULO_ACESSO_PERFIL ";
			  $sql.=          "WHERE ID_PERFIL IN ";
			  $sql.=	              "(SELECT ID_PERFIL ";
			  $sql.=	              "FROM TB_WFM_USUARIO_PERFIL ";
			  $sql.=	              "WHERE CPF = :CPF ) ) ";
			  $sql.=       "OR M.ID_MODULO IN ";
			  $sql.= 	         "(SELECT ID_MODULO ";
			  $sql.=	          "FROM TB_WFM_MODULO_ACESSO_INDIVIDUAL ";
			  $sql.=          "WHERE CPF = :CPF ";
			  $sql.=	            "AND LIBERADO = 1 )) ";
			  $sql.=  "AND M.ID_MODULO NOT IN ";
			  $sql.=    "(SELECT ID_MODULO ";
			  $sql.=     "FROM TB_WFM_MODULO_ACESSO_INDIVIDUAL ";
			  $sql.=     "WHERE CPF = :CPF ";
			  $sql.=	       "AND BLOQUEADO = 1 ) ";
			  $sql.= "GROUP BY M.ID_MODULO, M.TITULO_WEB, M.ID_WEB_MODULO, M.CAMINHO_ICONE, M.CAMINHO_LINK, M.ORDENACAO
				ORDER BY M.ORDENACAO; ";

			  $sql = $this-> db -> prepare($sql);
			  $sql -> bindValue(':CPF',$_SESSION['CPF']);
			  $sql -> execute();


			  if($sql -> rowCount() > 0){	
                   $sql = $sql -> fetchAll();

				   foreach ($sql as $menuPrincipal):
					if ($menuPrincipal['QTDESUB'] == 0 && $menuPrincipal['ID_MODULO_REFERENCIA'] == NULL):
						if($menuPrincipal['ID_MODULO'] == 1):
							echo '<li><a href="'.BASE_URL.$menuPrincipal['CAMINHO_LINK'].'" class="collapsible-header"><i class="material icons"><img class="circle responsive-img iconeTemplate" src="'.BASE_URL.$menuPrincipal['CAMINHO_ICONE'].'"></i>'.$menuPrincipal['TITULO_WEB'].'</a></li>';
							echo '<li><div class="divider"></div></li>';
						else:
							echo '<li><a href="'.BASE_URL.$menuPrincipal['CAMINHO_LINK'].'" class="collapsible-header"><i class="material icons"><img class="circle responsive-img iconeTemplate" src="'.BASE_URL.$menuPrincipal['CAMINHO_ICONE'].'"></i>'.$menuPrincipal['TITULO_WEB'].'</a></li>';
						endif;
						
					elseif($menuPrincipal['QTDESUB'] > 0 && $menuPrincipal['ID_MODULO_REFERENCIA'] == NULL):
					  echo '<li>';
						   echo '<a class="collapsible-header"><i class="material icons"><img class="circle responsive-img iconeTemplate" src="'.BASE_URL.$menuPrincipal['CAMINHO_ICONE'].'"></i>'.$menuPrincipal['TITULO_WEB'].'<i class="material icons small right"><i class="fas fa-angle-down"></i></i></a>';
						   echo '<div class="collapsible-body">';
						   echo '<ul>';
							  foreach ($sql as $submenu):
								  if ($submenu['QTDESUB'] == 0 && $submenu['ID_MODULO_REFERENCIA'] != NULL && $submenu['ID_MODULO_REFERENCIA'] == $menuPrincipal['ID_MODULO']):
									  echo '<li><a href="'.BASE_URL.$submenu['CAMINHO_LINK'].'">'.$submenu['TITULO_WEB'].'</a></li>';
								  elseif($submenu['QTDESUB'] > 0 && $submenu['ID_MODULO_REFERENCIA'] != NULL && $submenu['ID_MODULO_REFERENCIA'] == $menuPrincipal['ID_MODULO'] ):
									  echo '<ul class="collapsible">';
									  echo '<li>';
									  echo '<a class="collapsible-header"><i class="material icons small right"><i class="fas fa-angle-down"></i></i>'.$submenu['TITULO_WEB'].'</a>';
									  echo '<div class="collapsible-body">';
									  echo '<ul>';
										  foreach ($sql as $submenuNivel1):
											if ($submenuNivel1['QTDESUB'] == 0 && $submenuNivel1['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel1['ID_MODULO_REFERENCIA'] == $submenu['ID_MODULO']):
												echo '<li><a href="'.BASE_URL.$submenuNivel1['CAMINHO_LINK'].'">'.$submenuNivel1['TITULO_WEB'].'</a></li>';
											elseif($submenuNivel1['QTDESUB'] > 0 && $submenuNivel1['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel1['ID_MODULO_REFERENCIA'] == $submenu['ID_MODULO'] ):
												echo '<ul class="collapsible">';
												echo '<li>';
												echo '<a class="collapsible-header"><i class="material icons small right"><i class="fas fa-angle-down"></i></i>'.$submenuNivel1['TITULO_WEB'].'</a>';
												echo '<div class="collapsible-body">';
												echo '<ul>';
													foreach ($sql as $submenuNivel2):
														if ($submenuNivel2['QTDESUB'] == 0 && $submenuNivel2['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel2['ID_MODULO_REFERENCIA'] == $submenuNivel1['ID_MODULO']):
															echo '<li><a href="'.BASE_URL.$submenuNivel2['CAMINHO_LINK'].'">'.$submenuNivel2['TITULO_WEB'].'</a></li>';
														elseif($submenuNivel2['QTDESUB'] > 0 && $submenuNivel2['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel2['ID_MODULO_REFERENCIA'] == $submenuNivel1['ID_MODULO'] ):
															echo '<ul class="collapsible">';
															echo '<li>';
															echo '<a class="collapsible-header"><i class="material icons small right"><i class="fas fa-angle-down"></i></i>'.$submenuNivel2['TITULO_WEB'].'</a>';
															echo '<div class="collapsible-body">';
															echo '<ul>';
																foreach ($sql as $submenuNivel3):
																	if ($submenuNivel3['QTDESUB'] == 0 && $submenuNivel3['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel3['ID_MODULO_REFERENCIA'] == $submenuNivel2['ID_MODULO']):
																		echo '<li><a href="'.BASE_URL.$submenuNivel3['CAMINHO_LINK'].'">'.$submenuNivel3['TITULO_WEB'].'</a></li>';
																	elseif($submenuNivel3['QTDESUB'] > 0 && $submenuNivel3['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel3['ID_MODULO_REFERENCIA'] == $submenuNivel2['ID_MODULO'] ):
																		echo '<ul class="collapsible">';
																		echo '<li>';
																		echo '<a class="collapsible-header"><i class="material icons small right"><i class="fas fa-angle-down"></i></i>'.$submenuNivel3['TITULO_WEB'].'</a>';
																		echo '<div class="collapsible-body">';
																		echo '<ul>';
																			foreach ($sql as $submenuNivel4):
																				if ($submenuNivel4['QTDESUB'] == 0 && $submenuNivel4['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel4['ID_MODULO_REFERENCIA'] == $submenuNivel3['ID_MODULO']):
																					echo '<li><a href="'.BASE_URL.$submenuNivel4['CAMINHO_LINK'].'">'.$submenuNivel4['TITULO_WEB'].'</a></li>';
																				elseif($submenuNivel4['QTDESUB'] > 0 && $submenuNivel4['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel4['ID_MODULO_REFERENCIA'] == $submenuNivel3['ID_MODULO'] ):
																					echo '<ul class="collapsible">';
																					echo '<li>';
																					echo '<a class="collapsible-header"><i class="material icons small right"><i class="fas fa-angle-down"></i></i>'.$submenuNivel4['TITULO_WEB'].'</a>';
																					echo '<div class="collapsible-body">';
																					echo '<ul>';
																						foreach ($sql as $submenuNivel5):
																							if ($submenuNivel5['QTDESUB'] == 0 && $submenuNivel5['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel5['ID_MODULO_REFERENCIA'] == $submenuNivel4['ID_MODULO']):
																								echo '<li><a href="'.BASE_URL.$submenuNivel5['CAMINHO_LINK'].'">'.$submenuNivel5['TITULO_WEB'].'</a></li>';
																							elseif($submenuNivel5['QTDESUB'] > 0 && $submenuNivel5['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel5['ID_MODULO_REFERENCIA'] == $submenuNivel4['ID_MODULO'] ):
																								echo '<ul class="collapsible">';
																								echo '<li>';
																								echo '<a class="collapsible-header"><i class="material icons small right"><i class="fas fa-angle-down"></i></i>'.$submenuNivel5['TITULO_WEB'].'</a>';
																								echo '<div class="collapsible-body">';
																								echo '<ul>';
																									foreach ($sql as $submenuNivel6):
																										if ($submenuNivel6['QTDESUB'] == 0 && $submenuNivel6['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel6['ID_MODULO_REFERENCIA'] == $submenuNivel5['ID_MODULO']):
																											echo '<li><a href="'.BASE_URL.$submenuNivel6['CAMINHO_LINK'].'">'.$submenuNivel6['TITULO_WEB'].'</a></li>';
																										elseif($submenuNivel6['QTDESUB'] > 0 && $submenuNivel6['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel6['ID_MODULO_REFERENCIA'] == $submenuNivel5['ID_MODULO'] ):
																											echo '<ul class="collapsible">';
																											echo '<li>';
																											echo '<a class="collapsible-header"><i class="material icons small right"><i class="fas fa-angle-down"></i></i>'.$submenuNivel6['TITULO_WEB'].'</a>';
																											echo '<div class="collapsible-body">';
																											echo '<ul>';
																												foreach ($sql as $submenuNivel7):
																													if ($submenuNivel7['QTDESUB'] == 0 && $submenuNivel7['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel7['ID_MODULO_REFERENCIA'] == $submenuNivel6['ID_MODULO']):
																														echo '<li><a href="'.BASE_URL.$submenuNivel7['CAMINHO_LINK'].'">'.$submenuNivel7['TITULO_WEB'].'</a></li>';
																													elseif($submenuNivel7['QTDESUB'] > 0 && $submenuNivel7['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel7['ID_MODULO_REFERENCIA'] == $submenuNivel6['ID_MODULO'] ):
																														echo '<ul class="collapsible">';
																														echo '<li>';
																														echo '<a class="collapsible-header"><i class="material icons small right"><i class="fas fa-angle-down"></i></i>'.$submenuNivel7['TITULO_WEB'].'</a>';
																														echo '<div class="collapsible-body">';
																														echo '<ul>';
																															foreach ($sql as $submenuNivel8):
																																if ($submenuNivel8['QTDESUB'] == 0 && $submenuNivel8['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel8['ID_MODULO_REFERENCIA'] == $submenuNivel7['ID_MODULO']):
																																	echo '<li><a href="'.BASE_URL.$submenuNivel8['CAMINHO_LINK'].'">'.$submenuNivel8['TITULO_WEB'].'</a></li>';
																																elseif($submenuNivel8['QTDESUB'] > 0 && $submenuNivel8['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel8['ID_MODULO_REFERENCIA'] == $submenuNivel7['ID_MODULO'] ):
																																	echo '<ul class="collapsible">';
																																	echo '<li>';
																																	echo '<a class="collapsible-header"><i class="material icons small right"><i class="fas fa-angle-down"></i></i>'.$submenuNivel8['TITULO_WEB'].'</a>';
																																	echo '<div class="collapsible-body">';
																																	echo '<ul>';
																																		foreach ($sql as $submenuNivel9):
																																			if ($submenuNivel9['QTDESUB'] == 0 && $submenuNivel9['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel9['ID_MODULO_REFERENCIA'] == $submenuNivel8['ID_MODULO']):
																																				echo '<li><a href="'.BASE_URL.$submenuNivel9['CAMINHO_LINK'].'">'.$submenuNivel9['TITULO_WEB'].'</a></li>';
																																			elseif($submenuNivel9['QTDESUB'] > 0 && $submenuNivel9['ID_MODULO_REFERENCIA'] != NULL && $submenuNivel9['ID_MODULO_REFERENCIA'] == $submenuNivel8['ID_MODULO'] ):
																																				echo '<ul class="collapsible">';
																																				echo '<li>';
																																				echo '<a class="collapsible-header"><i class="material icons small right"><i class="fas fa-angle-down"></i></i>'.$submenuNivel9['TITULO_WEB'].'</a>';
																																				echo '<div class="collapsible-body">';
																																				echo '<ul>';
																																					foreach ($sql as $submenuNivel10):
																																					   if($submenuNivel10['ID_MODULO_REFERENCIA'] == $submenuNivel9['ID_MODULO']):
																																						 echo '<li><a href="'.BASE_URL.$submenuNivel10['CAMINHO_LINK'].'">'.$submenuNivel10['TITULO_WEB'].'</a></li>';
																																					   endif;
																																					endforeach;
																																				echo '</ul>';
																																				echo '</div>';
																																				echo '</li>';
																																				echo '</ul>';
																																			endif;
																																		endforeach;
																																	echo '</ul>';
																																	echo '</div>';
																																	echo '</li>';
																																	echo '</ul>';
																																endif;
																															endforeach;
																														echo '</ul>';
																														echo '</div>';
																														echo '</li>';
																														echo '</ul>';
																													endif;
																												endforeach;
																											echo '</ul>';
																											echo '</div>';
																											echo '</li>';
																											echo '</ul>';
																										endif;
																									endforeach;
																								echo '</ul>';
																								echo '</div>';
																								echo '</li>';
																								echo '</ul>';
																							endif;
																						endforeach;
																					echo '</ul>';
																					echo '</div>';
																					echo '</li>';
																					echo '</ul>';
																				endif;
																			endforeach;
																		echo '</ul>';
																		echo '</div>';
																		echo '</li>';
																		echo '</ul>';
																	endif;
																endforeach;
															echo '</ul>';
															echo '</div>';
															echo '</li>';
															echo '</ul>';
														endif;
													endforeach;
												echo '</ul>';
												echo '</div>';
												echo '</li>';
												echo '</ul>';
											endif;
										  endforeach;
									  echo '</ul>';
									  echo '</div>';
									  echo '</li>';
									  echo '</ul>';
								  endif;
							  endforeach;
						   echo '</ul>';
						  echo '</div>';
					  echo ('</li>');
					endif;
				endforeach;
    			
    			}else{
      				return false;
    			}

 }
			        
	
}


?>